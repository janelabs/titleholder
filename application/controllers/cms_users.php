<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_users extends CI_Controller {

    const TABLE_NAME = 'users';

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged') == false) {
            redirect(site_url('cms/login'));
        }

        $header_option = array('active' => 'user');
        $this->header = $this->load->view('cms/headers', $header_option, true);
        $this->footer = $this->load->view('cms/footers', null, true);

        $this->load->helper('jqgrid');
        $this->load->library('email');
    }

    public function index()
    {
        $data = array();

        $data['header'] = $this->header;
        $data['footer'] = $this->footer;

        $aData = array(
            'set_columns' => array(
                array(
                    'label' => 'User ID',
                    'name' => 'id',
                    'width' => 100,
                    'size' => 10
                ),
                array(
                    'label' => 'Name',
                    'name' => 'name',
                    'width' => 300,
                    'size' => 10
                ),
                array(
                    'label' => 'Email Address',
                    'name' => 'email',
                    'width' => 300,
                    'size' => 10
                ),
                array(
                    'label' => 'Level',
                    'name' => 'level',
                    'width' => 100,
                    'size' => 10
                ),
                array(
                    'label' => 'Pet Name',
                    'name' => 'pet_name',
                    'width' => 100,
                    'size' => 10
                )
            ),
            'div_name' => 'u_list',
            'source' => 'cms/users/all',
            'sort_name' => 'name',
            'add_url' => '#',
            'edit_url' => '#',
            'delete_url' => '#',
            'caption' => '',
            'primary_key' => 'id',
            'grid_height' => 300
        );

        $data['user_list'] = buildGrid($aData);

        $this->load->view('cms/users', $data);
    }

    public function fetchUsers()
    {
        buildGridData(
            array(
                'model' => 'super_model',
                'method' => 'getAllRecords',
                'pkid' => 'id',
                'columns' => array( 'id','name','email', 'level', 'pet_name')
            ),
            self::TABLE_NAME,
            array(
                'tbl' => 'pets',
                'on' => "ON " . self::TABLE_NAME . ".pid = pets.pet_id"
            )
        );

    }

    public function deleteUser($uid = 0)
    {
        if ($this->session->userdata('logged') == false) {
            redirect(site_url('cms/login'));
        }

        if ($uid > 0) {
            $where = array('id' => $uid);
            $info = $this->super_model->deleteRow(self::TABLE_NAME, $where);

            if (!$info) {
                $this->session->set_flashdata('error', 'Something went wrong while deleting user\'s account. Please try again');
            }
        }
        redirect(site_url('cms/users'));
    }

    private function generateNewPassword()
    {
        $chars = 'zyxwabcdefghijklmnABCDEFGHIJKLMN0987654321ZYXW';

        $randomChar = '';
        for ($i = 0 ; $i <= 10 ; $i++ ) {
            $randomChar .= $chars[rand(1, strlen($chars) - 1)];
        }

        return $randomChar;
    }

    private function emailPassword($email = null, $password = null)
    {
        if ($this->session->userdata('logged') == false) {
            redirect(site_url('cms/login'));
        }

        if ($email) {
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('no-reply@titleholder.com', 'TitleHolder Admin');
            $this->email->to($email);

            $this->email->subject('Notification of NEW Password');
            $this->email->message('Hello dear user! TitleHolder Team would like to inform you that we have changed your password.
             <br> Your new password is: ' . $password . ' <br>Thank you and keep supporting our game.');

            $this->email->send();
        }
    }

    public function editUser()
    {
        if ($this->session->userdata('logged') == false) {
            redirect(site_url('cms/login'));
        }

        $name = $this->input->post('uname', true);
        $password = $this->input->post('password', true);
        $uid = $this->input->post('uid', true);
        $email = urldecode($this->input->post('email', true));

        if ($password) {
            $new_password = $this->generateNewPassword();
            $data["password"] = md5($new_password);
            $this->emailPassword($email, $new_password); //notify user of change password
        }

        $data["name"] = $name;

        $where = array('id' => $uid);

        $info = $this->super_model->editRow(self::TABLE_NAME, $where, $data);

        if (!$info) {
            $this->session->set_flashdata('error', 'Something went wrong while deleting user\'s account. Please try again');
        }
    }
}

/* End of file cms_users.php */
/* Location: ./application/controllers/cms_users.php */