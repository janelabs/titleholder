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
                    'label' => 'Action',
                    'name' => 'action',
                    'width' => 100,
                    'size' => 10
                )
            ),
            'div_name' => 'u_list',
            'source' => site_url('cms/users/all'),
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
                'columns' => array( 'id','name','email', 'level' )
            ),
            self::TABLE_NAME
        );

    }
}

/* End of file cms_users.php */
/* Location: ./application/controllers/cms_users.php */