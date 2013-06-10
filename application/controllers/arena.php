<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arena extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('auth') !== true) {
            redirect(site_url('login'));
        }

        $this->load->helper('file');
    }

	public function index()
	{
        $data = array();
        $monsters = null;
        $user = null;
        $user_id = $this->session->userdata('userid');
        $user_data = $this->users->get_userdata($user_id);

        // get monsters / enemies
        if ($user_data) {
            $user = $user_data;

            $where = "monster_level BETWEEN {$user_data->level} AND {$user_data->level} + 5";

            if ($user_data->level >= 5) {
                $where = "monster_level BETWEEN {$user_data->level} - 5 AND {$user_data->level} + 5";
            }

            $monsters = $this->monsters->getByLevel($where);

            $this->generateEvents($monsters);
        }

        $data['user'] = $user;
        $data['header'] = $this->load->view('headers', null, true);
        $this->load->view('arena', $data);
	}

    private function generateEvents($monsters = array())
    {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . 'assets/Data/Events/MAP001/'; //will be changed, used in prod
        $file_name = "EV00";
        $ctr = 4; // 4 start of the count for there are default 4 events.
        $dataOptions = array();

        $msg1 = array(
            'You dared to challenge me?',
            'Want my title huh?!?',
            'Let\'s get this over with',
            'Escape now while you have the time!'
        );

        $msg2 = array(
            'Do you think you can defeat me?',
            'Ha!! Prepare to die!',
            'You will never be the Title Holder!!',
            'Say hello to your ancestors!'
        );

        if (count($monsters) > 0) {
            // generating battle event for each monster
            foreach ($monsters as $m_info) {
                $ctr++;
                $f_name = $file_name.$ctr;

                $msg_key_1 = array_rand($msg1);
                $msg_key_2 = array_rand($msg2);

                $dataOptions['m_id'] = $m_info->monster_id;
                $dataOptions['name'] = $f_name;
                $dataOptions['avatar'] = $m_info->monster_avatar;
                $dataOptions['msg1'] = $msg1[$msg_key_1];
                $dataOptions['msg2'] = $msg2[$msg_key_2];

                // set the X and Y position of characters
                switch ($ctr) {
                    case 5:
                        $dataOptions['x_pos'] = 29;
                        $dataOptions['y_pos'] = 31;
                        break;
                    case 6:
                        $dataOptions['x_pos'] = 19;
                        $dataOptions['y_pos'] = 41;
                        break;
                    case 7:
                        $dataOptions['x_pos'] = 38;
                        $dataOptions['y_pos'] = 17;
                        break;
                }

                $event = $this->load->view('battle_event_format', $dataOptions, true);

                $fp = fopen($file_path . $f_name . '.json', 'w+');
                if (!fwrite($fp, $event)) {
                    echo "File not written \n";
                }
                fclose($fp);
            }
        }
    }
}

/* End of file arena.php */
/* Location: ./application/controllers/arena.php */