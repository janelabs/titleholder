<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Battle extends CI_Controller {

    const AT = 5;       // attack multiplier
    const DF = 5;       // defense multiplier
    const HP = 10;      // hp multiplier
    const AP = 5;       // default attribute points to gain per level up

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('auth') !== true) {
            redirect(site_url('login'));
        }
    }

    public function view()
    {
        $post = $this->input->post();

        if(!$post) {
            $response = array('status' => 0,'error' => 'Wrong Method');

            echo json_encode($response);
            exit;
        }

        $is_killed = false;
        $is_dead = false;
        $exp_gain = 0;
        $player_return_hp = 0;
        $enemy_id = $post['enemy_id'];
        $enemy_hp = $post['enemy_hp'];
        $player_id = $this->session->userdata('userid');
        $player_hp = $post['player_hp'];
        $player_level = 0;
        $has_rank = false;
        $rank_name = null;
        $result = null;
        $has_levelup = false;
        $attr_points = 0;

        $enemy_data = $this->monsters->getMonsterData($enemy_id);
        $player_data = $this->users->get_userdata($player_id);

        if(!$enemy_data || !$player_data) {
            $response = array('status' => 0,'error' => 'Invalid Data');

            echo json_encode($response);
            exit;
        }

        // start battle
        $enemy_attack = $enemy_data->attack;
        $enemy_defense = $enemy_data->defense;

        $player_attack = $player_data->attack;
        $player_defense = $player_data->defense;

        $enemy_dmg_rcv = $player_attack - $enemy_defense;
        if ($enemy_dmg_rcv <= 0) {
            $enemy_dmg_rcv = 1;
        }

        $player_dmg_rcv = $enemy_attack - $player_defense;
        if ($player_dmg_rcv <= 0) {
            $player_dmg_rcv = 1;
        }

        $enemy_return_hp = $enemy_hp - $enemy_dmg_rcv;
        $player_return_hp = $player_hp - $player_dmg_rcv;

        // if enemy is killed
        if ($enemy_return_hp <= 0) {
            $enemy_return_hp = 0;
            $exp_gain = $this->users->getLevelExp($player_data->level);
            $is_killed = true;
        } else {
            // enemy will fight back now
            if ($player_return_hp <=0 ) {
                $player_return_hp = 0;
                $is_dead = true;
            }
        }

        // if player won
        if($exp_gain && $is_killed) {
            $result = "You won the battle";

            // pet boost on exp, other attribute boost are given upon sign up
            $xp_boost = ($player_data->pet_xp / 100) * $exp_gain->reward_xp;

            $player_xp = $player_data->xp + $exp_gain->reward_xp + $xp_boost;

            $player_level = $this->users->get_userlevel($player_xp);

            // if player has level up
            if($player_level > $player_data->level) {
                $has_levelup = true;
                $attr_points = $player_data->points + self::AP;
                $data['points'] =$attr_points;
            }

            // for testing
            // $has_levelup = true;
            // $has_rank = true;
            // $rank_name = 'Something';
            // $attr_points = $player_data->points + self::AP;

            $data['xp'] = $player_xp;
            $data['level'] = $player_level;
            $data['points'] = $attr_points;

            // update level and experience
            $this->users->updateUser($data,$player_data->id);

            // add to battle history
            $this->logs->addLogs(1, $player_data->id, $enemy_data->id);

            // add user ranks if rank title is not owned yet
            $rank_is_owned = $this->ranks->isRankOwned($player_data->id,$enemy_data->rank);

            if(!$rank_is_owned) {
                $has_rank = true;
                $this->ranks->addUserRanks($player_data->id,$enemy_data->rank);

                // get rank detail
                $rank = $this->ranks->getRanks($enemy_data->rank);
                $rank_name = $rank->rank_name;
            }


        }

        // if player lost
        if($is_dead) {
            $this->logs->addLogs(2, $player_data->id, $enemy_data->id);
            $result = "You were killed!";
        }

        $player_percentage = $this->users->xp_percentage($player_return_hp,$player_data->hp,0);
        $enemy_percentage = $this->users->xp_percentage($enemy_return_hp,$enemy_data->hp,0);

        $response['status'] = 1;
        $response['enemy']['hp'] = $enemy_return_hp;
        $response['enemy']['is_dead'] = $is_killed;
        $response['enemy']['damage'] = $enemy_dmg_rcv;
        $response['enemy']['hp_percent'] = $enemy_percentage;
        $response['player']['hp'] = $player_return_hp;
        $response['player']['is_dead'] = $is_dead;
        $response['player']['damage'] = $player_dmg_rcv;
        $response['player']['hp_percent'] = $player_percentage;
        $response['has_rank'] = $has_rank;
        $response['rank_name'] = $rank_name;
        $response['has_levelup'] = $has_levelup;
        $response['result'] = $result;
        $response['ap'] = $attr_points;

        echo json_encode($response);
        exit;
    }

    public function index()
    {

        $post = $this->input->post();
        if($post) {
            $enemy_id = $post['id'];
            $enemy_data = $this->monsters->getMonsterData($enemy_id);

            $player_id = $this->session->userdata('userid');
            $player_data = $this->users->get_userdata($player_id);

            if ($enemy_data && $player_data) {

                $data['p_current_hp'] = $player_data->hp;
                $data['e_current_hp'] = $enemy_data->hp;
                $data['enemy'] = $enemy_data;
                $data['player'] = $player_data;

                $this->load->view('headers');
                $this->load->view('battle', $data);
            }
        }
    }

    public function allocate()
    {
        $post = $this->input->post();

        if(!$post) {
            $response['message'] = 'Wrong Method';

            echo json_encode($response);
            exit;
        }

        // if there is no at least 1 attribute input
        if(!$post['attk'] && !$post['def'] && !$post['hp']) {
            $response['message'] = 'You did not assign points to any attribute';

            echo json_encode($response);
            exit;
        }

        // if any of the attribute has invalid value
        if(!is_numeric($post['attk']) || !is_numeric($post['def']) || !is_numeric($post['hp'])) {
            $response['message'] = 'Invalid Input';

            echo json_encode($response);
            exit;
        }

        $total = $post['attk'] + $post['def'] + $post['hp'];

        $player_id = $this->session->userdata('userid');
        $player_data = $this->users->get_userdata($player_id);

        if(!$player_data) {
            $response['message'] = 'User not found';

            echo json_encode($response);
            exit;
        }

        if(!$player_data->points) {
            $response['message'] = 'You do not have AP to allocate';

            echo json_encode($response);
            exit;
        }

        if($total > $player_data->points) {
            $response['message'] = 'Input values exceeded total AP';

            echo json_encode($response);
            exit;
        }


        if($player_data) {

            $atk_increase = self::AT * $post['attk'];
            $def_increase = self::DF * $post['def'];
            $hp_increase = self::HP * $post['hp'];

            $data['attack'] = $player_data->attack + $atk_increase;
            $data['defense'] = $player_data->defense + $def_increase;
            $data['hp'] = $player_data->hp + $hp_increase;
            $data['points'] = $player_data->points - $total;

            $is_updated = $this->users->updateUser($data, $player_id);

            if($is_updated) {
                $response['message'] = 'AP allocation successful';
                echo json_encode($response);
            }
        }


    }
}
