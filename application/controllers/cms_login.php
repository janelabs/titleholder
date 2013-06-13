<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_login extends CI_Controller {

    public $header;
    public $footer;
    private $key;

    public function __construct()
    {
        parent::__construct();

        $this->header = $this->load->view('cms/headers', null, true);
        $this->footer = $this->load->view('cms/footers', null, true);

        if ($this->session->userdata('logged')) {
            redirect(site_url('cms/main'));
        }

        $this->key = $this->config->item('encryption_key');
    }

    public function index()
    {
        $data = array();
        $data['header'] = $this->header;
        $data['footer'] = $this->footer;
        $this->load->view('cms/login', $data);
    }

    public function authenticate()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        if (!empty($username) && !empty($password)) {
            $admin_info = $this->admins->getAdminByUsername($username);

            // check if admin is existing
            if ($admin_info) {
                // password matching
                if ($admin_info->admin_password != md5($this->key . $password)) {
                    $this->session->set_flashdata('login_error', "Incorrect password/email.");
                    redirect(site_url('cms/login'));
                }

                $this->setLoggedAccount($admin_info->admin_id);
                redirect(site_url('cms/main'));
            } else {
                $this->session->set_flashdata('login_error', "Incorrect password/email.");
                redirect(site_url('cms/login'));
            }
        } else {
            $this->session->set_flashdata('login_error', "You must provide necessary information in order to login");
            redirect(site_url('cms/login'));
        }
    }

    private function setLoggedAccount($admin_id = 0)
    {
        if ($admin_id > 0) {
            $logged_account = array(
                'aid' => $admin_id,
                'logged' => true
            );
            $this->session->set_userdata($logged_account);
        }
    }
}

/* End of file cms_login.php */
/* Location: ./application/controllers/cms_login.php */