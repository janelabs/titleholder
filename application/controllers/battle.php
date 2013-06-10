<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Battle extends CI_Controller {

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

        $enemy_data = $this->monsters->getMonsterData($enemy_id);
        $player_data = $this->users->get_userdata($player_id);

        if(!$enemy_data || !$player_data) {
            $response = array('status' => 0,'error' => 'Invalid Data');

            echo json_encode($response);
            exit;
        }

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
        if($exp_gain) {
            $player_xp = $player_data->xp + $exp_gain->reward_xp;

            $data = array(
                'xp' => $player_xp,
                'level' => $this->users->get_userlevel($player_xp),
            );

            // update level and experience
            $this->users->updateUser($data,$player_data->id);

            // add to battle history
            $this->logs->addLogs(1, $player_data->id, $enemy_data->id);
        }

        // if player lost
        if($is_dead) {
            $this->logs->addLogs(2, $player_data->id, $enemy_data->id);
        }

        $response = array(
            'enemy' => array(
                'hp' => $enemy_return_hp,
                'is_dead' => $is_killed,
            ),
            'player' => array(
                'hp' => $player_return_hp,
                'is_dead' =>$is_dead,
            ),
            'status' => 1
        );

        echo json_encode($response);
        exit;
    }

    public function index(){

        $post = $this->input->post();
        $post = true;

        if($post) {
            $enemy_id = 1;
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
}
