<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        if ($this->session->userdata('auth') === true) {
            redirect(site_url() . 'main');
        }

        $post = $this->input->post();

        if(!$post) {

            $this->load->view('headers');
            $this->load->view('login/index');

        } else {

            $data['status'] = 0;

            if($this->form_validation->run('login') == FALSE) {

                $data['errors'] = $this->form_validation->errors();

            } else {

                $user = $this->users->check_login($post['email'],$post['password']);

                if ($user) {

                    $auth = array(
                        'userid'       => $user->id,
                        'username' => $user->name,
                        'auth'         => true,
                    );

                    $this->session->set_userdata($auth);

                    redirect(base_url() . 'main');

                } else {

                    $data['status'] = 1;
                    $data['message'] = 'Login failed';

                }

            }

            echo json_encode($data);

        }
	}

    public function logout()
    {
        $auth = array('userid' => '','username' => '','auth' => '');
        $this->session->unset_userdata($auth);
        redirect(site_url() . 'login');
    }
}
