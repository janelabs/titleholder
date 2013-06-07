<?php


class Logs extends CI_Model {

    public function getLogs($user_id, $log_type = 1)
    {

        $logs = $this->db
            ->where('user_id',$user_id)
            ->where('log_type',$log_type)
            ->get('logs')
            ->result();

        return ($logs) ? $logs : false;

    }

    public function addLogs($result, $user_id, $enemy_id, $enemy_type = 2, $log_type = 1)
    {

        $arr = array(
            'user_id' => $user_id,
            'log_type' => $log_type,
            'enemy_type' => $enemy_type,
            'enemy_id' => $enemy_id,
            'result' => $result
        );

        $this->db->insert('logs',$arr);

        return ($this->db->affected_rows()) ? true : false;

    }

}