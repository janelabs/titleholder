<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rankings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

//        if ($this->session->userdata('auth') !== true) {
//            redirect(site_url('login'));
//        }

        $this->load->helper('file');
    }

	public function index()
	{

        $rankings = new Ranks();

        $this->load->view('headers');
        $this->load->view('ranks',$rankings);
        $this->load->view('footers');
	}
}

/* End of file ranks.php */
/* Location: ./application/controllers/arena.php */