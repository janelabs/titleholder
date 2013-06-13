<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_main extends CI_Controller {

    public $header;
    public $footer;

    public function __construct()
    {
        parent::__construct();

        $this->header = $this->load->view('cms/headers', null, true);
        $this->footer = $this->load->view('cms/footers', null, true);

        if (!$this->session->userdata('logged')) {
            redirect(site_url('cms/login'));
        }
    }

    public function index()
    {
        $data = array();
        $data['header'] = $this->header;
        $data['footer'] = $this->footer;
        $this->load->view('cms/main', $data);
    }

}

/* End of file cms_login.php */
/* Location: ./application/controllers/cms_login.php */