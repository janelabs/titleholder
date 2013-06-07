<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Acer
 * Date: 6/5/13
 * Time: 6:40 PM
 * To change this template use File | Settings | File Templates.
 */


class Battle extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

//        if ($this->session->userdata('auth') !== true) {
//            redirect(site_url('login'));
//        }
    }

    public function view()
    {
        $post = $this->input->post();

        if(!$post) {
            $response = array("error" => "Wrong Method");
        } else {
            $isUser = false;

            $enemy_id = $post['id'];
            $player_id = $this->session->userdata('id')->id;

            $player_id = 1;

            $is_killed = false;
            $is_dead = false;
            $exp_gain = 0;
            $player_return_hp = 0;

            // first attack, player:
            $enemy_data = $this->users->get_userdata($enemy_id);
            //$enemy_data = $this->monsters->getMonsterData($enemy_id)
            $enemy_hp = $enemy_data->hp;
            $enemy_defense = $enemy_data->defense;

            $player_data = $this->users->get_userdata($player_id);
            $player_attack = $player_data->attack;

            $enemy_dmg_rcv = $player_attack - $enemy_defense;
            if ($enemy_dmg_rcv==0){
                $enemy_dmg_rcv = 1;
            }
            $enemy_return_hp = $enemy_hp - $enemy_dmg_rcv;
            if($enemy_return_hp<0){
                $enemy_return_hp = 0;
                if (!$isUser){
                    $exp_gain = 5;
                }
                $is_killed = true;
            } else {
                // enemy will fight back now
                $player_hp = $player_data->hp;
                $player_defense = $player_data->defense;

                $enemy_attack = $enemy_data->attack;
                $player_dmg_rcv = $enemy_attack - $player_defense;

                if ($player_dmg_rcv==0){
                    $player_dmg_rcv = 1;
                }

                $player_return_hp = $player_hp - $player_dmg_rcv;
                if($player_return_hp<0){
                    $player_return_hp = 0;
                    $is_dead = true;
                }
            }

            // update user

            $data = array(
                'xp' => $player_data->xp + $exp_gain,
                'hp' => $player_return_hp
                // TODO: place this ->  'level' => $date
            );

            $this->db->where('id', $player_id);
            $this->db->update('users', $data);

            // update enemy

            $data = array(
                'hp' => $enemy_return_hp
            );

            $this->db->where('id', $enemy_id);
            $this->db->update('users', $data);

            $response = array(
                "enemy" => array(
                    "name" => $enemy_data->name,
                    "hp" => $enemy_return_hp,
                    "is_killed" => $is_killed
                ),
                "player" => array(
                    "name" =>$player_data->name,
                    "hp" =>$player_return_hp,
                    "is_dead" =>$is_dead,
                    "skill_code" => '',
                    "exp_gain" => $exp_gain
                ),
                "timestamp" => 10,
                "error" => ""
            );


    }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function index(){
        $data['header'] = $this->load->view('headers', null, true);

        $this->load->view('battle', $data);
    }
}
