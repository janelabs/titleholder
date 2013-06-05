<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('auth') !== true) {
            redirect(base_url() . 'login');
        }
    }


    public function index()
    {
        $userid = $this->session->userdata('userid');
        $user = $this->users->get_userdata($userid);

        if ($user) {

            // calculate level based on experience
            $level = 0;

            $data = array(
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_xp' => $user->xp,
                'user_hp' => $user->hp + $user->pet_hp,
                'user_atk' => $user->attack + $user->pet_attack,
                'user_def' => $user->defense + $user->pet_defense,
                'user_lvl' => $level,
                'pet_id' => $user->pet_id,
                'pet_img' => $user->pet_name
            );

        } else {
            echo "User not found";
            exit;
        }

        echo "<pre>";
        print_r($data);

    }
}
