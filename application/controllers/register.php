<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('auth') === true) {
            redirect(site_url('main'));
        }
    }

    public function index()
    {
        $post = $this->input->post();

        if($post) {
            $data['status'] = 0;

            if($this->form_validation->run('signup') == FALSE) {

                $data['errors'] = $this->form_validation->errors();

            } else {

                $pet = $this->pets->get($post['pet']);
                $avatar = $this->avatars->get($post['avatar']);

                if(!$pet) {

                    $data['errors']['pet']= 'You chose and invalid pet';

                } elseif(!$avatar) {

                    $data['errors']['avatar'] = 'You chose an invalid character';

                } else {

                    $user_atk = $pet->pet_attack + $avatar->avatar_attack;
                    $user_def = $pet->pet_defense + $avatar->avatar_defense;
                    $user_hp = $pet->pet_hp + $avatar->avatar_hp;
                    $user_lvl = $this->users->get_userlevel(0);

                    $arr = array(
                        'name' => $post['username'],
                        'password' => md5($post['password']),
                        'email' => $post['email'],
                        'attack' => $user_atk,
                        'defense' => $user_def,
                        'hp' => $user_hp,
                        'level' => $user_lvl,
                        'aid' => $avatar->avatar_id,
                        'pid' => $pet->pet_id
                    );

                    $user = $this->users->add_user($arr);

                    if($user) {
                        $data['status'] = 1;
                        $data['success'] = true;
                        $data['message'] = 'Registration successful! Redirecting';
                        $data['location'] = site_url('login');
                    } else {
                        $data['status'] = 1;
                        $data['success'] = false;
                        $data['message'] = 'Unable to add user!';
                    }

                }
            }

            echo json_encode($data);

        } else {
            $avatars = $this->avatars->get();
            $pets = $this->pets->get();

            $data['avatars'] = null;
            $data['pets'] = null;

            if($avatars) {
                $data['avatars'] = $avatars;
            }

            if($pets) {
                $data['pets'] = $pets;
            }

            $this->load->view('headers');
            $this->load->view('register/index',$data);
        }

    }

    function _pet_required($pet_id) {

        if(!$pet_id) {
            $this->form_validation->set_message('_pet_required', 'You did not choose a pet');
            return FALSE;
        } else {
            return TRUE;
        }

    }

    function _avatar_required($avatar_id)
    {

        if(!$avatar_id) {
            $this->form_validation->set_message('_avatar_required', 'You did not choose a character');
            return FALSE;
        } else {
            return TRUE;
        }

    }

}