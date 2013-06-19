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

        $user_id = $this->session->userdata('userid');
        $data['ranks'] = $this->ranks->getRankingsByTitle();
        $data['r_level'] = $this->ranks->getRankingsByLevel();
        $data['titles'] = $this->ranks->getUserRanks($user_id);

        $this->load->view('headers');
        $this->load->view('ranks',$data);
	}


}

/* End of file ranks.php */
/* Location: ./application/controllers/arena.php */