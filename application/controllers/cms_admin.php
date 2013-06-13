<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_admin extends CI_Controller {

    public $header;
    public $footer;

    public function __construct()
    {
        parent::__construct();

        $header_option = array('active' => 'admin');
        $this->header = $this->load->view('cms/headers', $header_option, true);
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

/* End of file cms_admin.php */
/* Location: ./application/controllers/cms_admin.php */