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
        $events = array();
        $user_id = $this->session->userdata('userid');
        $user_data = $this->users->get_userdata($user_id);

        // get monsters / enemies
        if ($user_data) {
            $user = $user_data;

            $where = "monster_level BETWEEN {$user_data->level} AND {$user_data->level} + 5";

            // commented out for viewing purpose
            //$monsters = $this->monsters->getByLevel($where);

//            if ($monsters && count($monsters) > 0) {
//                $events = $this->generateEnemyEvents($monsters);
//            } else {
//                $events = $this->generateDefaultEvent();
//            }

        }

//        if (count($events) > 0) {
//            $data['events'] = $events;
//        } else {
//            $data['events'] = array('null');
//        }

        $data['user'] = $user;
        $data['header'] = $this->load->view('headers', null, true);
        $this->load->view('arena', $data);
	}

    private function generateEnemyEvents($monsters = array())
    {
        $events = array();
        $file_path =  getcwd() . '/assets/Data/Events/MAP001/'; //will be changed, used in prod
        $file_name = "EV00";
        $ctr = 4; // 4 start of the count for there are default 4 events.
        $dataOptions = array();
        $directions = array('top', 'bottom', 'left', 'right');

        $msg = array(
            "You dared to challenge me? Prepare to die!",
            "Want my title? Say hello first to your ancestors!",
            "Do you think you can defeat me? Let's get this over with",
            "You will never be the Title Holder!"
        );

        if (count($monsters) > 0) {
            // generating battle event for each monster
            foreach ($monsters as $m_info) {
                $ctr++;
                $f_name = $file_name.$ctr;

                $events[] = $f_name;

                $dataOptions['m_id'] = $m_info->monster_id;
                $dataOptions['name'] = $f_name;
                $dataOptions['avatar'] = $m_info->monster_avatar;
                $dataOptions['msg'] = $msg[array_rand($msg)];
                $dataOptions['direction'] = $directions[array_rand($directions)];

                // set the X and Y position of characters
                switch ($ctr) {
                    case 5:
                        $dataOptions['x_pos'] = 25;
                        $dataOptions['y_pos'] = 32;
                        break;
                    case 6:
                        $dataOptions['x_pos'] = 22;
                        $dataOptions['y_pos'] = 43;
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
        return $events;
    }

    private function generateDefaultEvent()
    {
        $events = array();
        $file_path =  getcwd() . '/assets/Data/Events/MAP001/'; //will be changed, used in prod
        $file_name = "EV00";
        $dataOptions = array();
        $directions = array('top', 'bottom', 'left', 'right');

        $msg1 = array(
            'Hello!? Get all the titles!',
            'I am busy',
            'Are you the title holder?',
            'Red Moon Kingdom is in North of this town'
        );

        for ($ctr = 5 ; $ctr < 8 ; $ctr++) {
            $f_name = $file_name.$ctr;
            $events[] = $f_name;

            $msg_key_1 = array_rand($msg1);

            $direction_key1 = array_rand($directions);
            $direction_key2 = array_rand($directions);

            $dataOptions['m_id'] = $ctr;
            $dataOptions['name'] = $f_name;
            $dataOptions['avatar'] = "s_0" . $ctr . ".png";
            $dataOptions['msg1'] = $msg1[$msg_key_1];
            $dataOptions['directions_1'] = $directions[$direction_key1];
            $dataOptions['directions_2'] = $directions[$direction_key2];

            // set the X and Y position of characters
            switch ($ctr) {
                case 5:
                    $dataOptions['x_pos'] = 25;
                    $dataOptions['y_pos'] = 32;
                    break;
                case 6:
                    $dataOptions['x_pos'] = 22;
                    $dataOptions['y_pos'] = 43;
                    break;
                case 7:
                    $dataOptions['x_pos'] = 38;
                    $dataOptions['y_pos'] = 17;
                    break;
            }

            $event = $this->load->view('default_event_format', $dataOptions, true);

            $fp = fopen($file_path . $f_name . '.json', 'w+');
            if (!fwrite($fp,json_encode($event))) {
                echo "File not written \n";
            }
            fclose($fp);
        }
        return $events;
    }

    public function generateEventReplacement()
    {
        $id = $this->input->post('id', true);
        $user_id = $this->session->userdata('userid');
        $user_data = $this->users->get_userdata($user_id);

        $file_path =  getcwd() . '/assets/Data/Events/MAP001/EVREP/';
        $f_name = "EV_REP_" . $id;
        $dataOptions = array();
        $directions = array('top', 'bottom', 'left', 'right');

        $msg = array(
            "You dared to challenge me? Prepare to die!",
            "Want my title? Say hello first to your ancestors!",
            "Do you think you can defeat me? Let's get this over with",
            "You will never be the Title Holder!"
        );

        // get monsters / enemies
        if ($user_data) {
            $where = "monster_level BETWEEN {$user_data->level} AND {$user_data->level} + 5";
            $monsters = $this->monsters->getByLevel($where);

            if (count($monsters) > 0) {
                $dataOptions['m_id'] = '0'.$monsters[0]->monster_id;
                $dataOptions['name'] = $f_name;
                $dataOptions['avatar'] = $monsters[0]->monster_avatar;
                $dataOptions['msg'] = $msg[array_rand($msg)];
                $dataOptions['direction'] = $directions[array_rand($directions)];

                $coordinates = array(
                    array('x' => 24, 'y' => 19),
                    array('x' => 4, 'y' => 19)
                );

                $position = array_rand($coordinates);

                // set the X and Y position of characters
                $dataOptions['x_pos'] = $coordinates[$position]['x'];
                $dataOptions['y_pos'] = $coordinates[$position]['y'];

                $event = $this->load->view('battle_event_format', $dataOptions, true);

                $fp = fopen($file_path . $f_name . '.json', 'w+');
                if (!fwrite($fp, json_encode($event))) {
                    echo "File not written \n";
                }
                fclose($fp);
                echo $event;
            }
        }
    }
}

/* End of file arena.php */
/* Location: ./application/controllers/arena.php */