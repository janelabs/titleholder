<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('auth') !== true) {
            redirect(site_url('login'));
        }
    }

	public function index()
    {
        $userid = $this->session->userdata('userid');
        $user = $this->users->get_userdata($userid);

        if ($user) {

            $required_xp = $this->users->needed_xp($user->level);
            foreach($required_xp as $required) {
                if($required->level_id == $user->level) {
                    $prev_xp = $required->needed_xp;
                } else {
                    $needed_xp = $required->needed_xp;
                }
            }

            $xp_percent = $this->users->xp_percentage($user->xp,$needed_xp,$prev_xp);

            $data['user'] = array(
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_xp' => $user->xp,
                'user_hp' => $user->hp,
                'user_atk' => $user->attack,
                'user_def' => $user->defense,
                'user_lvl' => $user->level,
                'needed_xp' => $needed_xp,
                'prev_xp' => $prev_xp,
                'pet_id' => $user->pet_id,
                'pet_name' => $user->pet_name,
                'pet_image' => $user->pet_image,
                'pet_desc' => $user->pet_description,
                'avatar_image' => $user->avatar_filename,
                'percentage' => $xp_percent
            );

            $this->load->view('headers.php');
            $this->load->view('main/index',$data);

        } else {
            echo "User not found";
            exit;
        }
    }
}
