<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arena extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->load->view('arena');
	}
}

/* End of file arena.php */
/* Location: ./application/controllers/arena.php */