<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_login extends CI_Controller {

    public $header;
    public $footer;

    public function __construct()
    {
        parent::__construct();

        $this->header = $this->load->view('cms/headers', null, true);
        $this->footer = $this->load->view('cms/footers', null, true);
    }

    public function index()
    {
        $data = array();
        $data['header'] = $this->header;
        $data['footer'] = $this->footer;
        $this->load->view('cms/login', $data);
    }

}

/* End of file cms_login.php */
/* Location: ./application/controllers/cms_login.php */