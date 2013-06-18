<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Startup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        if ($this->session->userdata('auth') === true) {
            redirect(site_url() . 'main');
        }

        $data['header'] = $this->load->view('headers.php', null, true);
        $this->load->view('splash', $data);
	}
}

/* End of file startup.php */
/* Location: ./application/controllers/startup.php */