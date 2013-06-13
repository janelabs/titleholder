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
            'source' => site_url('cms/users/all'),
            'sort_name' => 'name',
            'add_url' => '#',
            'edit_url' => '#',
            'delete_url' => site_url('cms/users/delGridRow'),
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
        if ($uid > 0) {
            $where = array('id' => $uid);
            $info = $this->super_model->deleteRow(self::TABLE_NAME, $where);

            if (!$info) {
                $this->session->set_flashdata('error', 'Something went wrong while deleting user\'s account. Please try again');
            }
        }
        redirect(site_url('cms/users'));
    }
}

/* End of file cms_users.php */
/* Location: ./application/controllers/cms_users.php */