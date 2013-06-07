<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {

    private $user_id;
    const ENEMY_PLAYER = 1;
    const ENEMY_MONSTER = 2;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('userid');
    }

    public function index()
    {
        if ($this->session->userdata('auth') !== true) {
            redirect(site_url('login'));
        }

        $user = $this->users->get_userdata($this->user_id);

        if(!$user) {
            show_404();
        }

        $this->load->view('headers');
        $this->load->view('logs/index');
    }

    public function monsters()
    {
        sleep(3);
        $logs = $this->logs->getLogs($this->user_id,self::ENEMY_MONSTER);

        $data['logs'] = null;

        if($logs) {
            foreach($logs as $log) {
                $data['logs'][] = array(
                    'name' => $log->monster_name,
                    'avatar' => $log->monster_avatar,
                    'result' => ($log->result == 2) ? 'L' : 'W',
                );
            }
        }

        $this->load->view('logs/monsters',$data);
    }

    public function players()
    {
        sleep(3);
        $data['logs'] = null;

        $logs = $this->logs->getLogs($this->user_id,self::ENEMY_PLAYER);

        if($logs) {
            foreach($logs as $log) {
                $data['logs'][] = array(
                    'name' => $log->name,
                    'level' => $log->level,
                    'result' => ($log->result == 2) ? 'L' : 'W',
                );
            }
        }

        $this->load->view('logs/players',$data);
    }



}
