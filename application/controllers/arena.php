<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arena extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('auth') !== true) {
            redirect(site_url('login'));
        }
    }

	public function index()
	{
        $data = array();
        $user_id = $this->session->userdata('userid');
        $user_data = $this->users->get_userdata($user_id);

        // get monsters / enemies
        if ($user_data) {

        }

        $data['user'] = $user_data;
        $this->load->view('arena');
	}
}

/* End of file arena.php */
/* Location: ./application/controllers/arena.php */