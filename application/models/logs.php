<?php


class Logs extends CI_Model {

    public function getLogs($user_id, $enemy_type, $log_type = 1)
    {

        $this->db
            ->where('user_id',$user_id)
            ->where('log_type',$log_type)
            ->where('enemy_type',$enemy_type)
            ->limit(10)
            ->order_by('log_id','desc');

        if($enemy_type == 1) {
            $this->db->join('users','users.id = logs.enemy_id');
        } elseif ($enemy_type == 2) {
            $this->db->join('monsters','monsters.monster_id = logs.enemy_id');
        }

        $logs = $this->db->get('logs')->result();

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