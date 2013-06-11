<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Battle extends CI_Controller {

    const AT = 5;
    const DF = 5;
    const HP = 10;

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

            $player_xp = $player_data->xp + $exp_gain->reward_xp;

            $player_level = $this->users->get_userlevel($player_xp);

            // if player has level up
            if($player_level > $player_data->level) {
                $has_levelup = true;
            }
            $has_levelup = true;

            $data = array(
                'xp' => $player_xp,
                'level' => $player_level,
            );

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

        $response['status'] = 1;
        $response['enemy']['hp'] = $enemy_return_hp;
        $response['enemy']['is_dead'] = $is_killed;
        $response['player']['hp'] = $player_return_hp;
        $response['player']['is_dead'] = $is_dead;
        $response['has_rank'] = $has_rank;
        $response['rank_name'] = $rank_name;
        $response['has_levelup'] = $has_levelup;
        $response['result'] = $result;

        echo json_encode($response);
        exit;
    }

    public function index()
    {

        $post = $this->input->post();
        $post = true; // delete after testing
        if($post) {
            $enemy_id = $post['id'];
            $enemy_id = 3; // delete after testing
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
            $response = array('status' => 0,'error' => 'Wrong Method');

            echo json_encode($response);
            exit;
        }

        $total = $post['atk'] + $post['def'] + $post['hp'];

        if($total  5) {
            $response = array('status' => 0,'error' => 'Assigned points exceeded available AP.');
        }
    }
}
