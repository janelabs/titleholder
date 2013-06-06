<?php


class Users extends CI_Model {

    public function check_login($email,$pass) {
        $data['email'] = $email;
        $data['password'] = md5($pass);

        $user = $this->db->get_where('users',$data)->row();

        return ($user) ? $user : false;
    }

    public function get_userdata($userid)
    {
        $user = $this->db
            ->get_where('user_data',array('id' => $userid))
            ->row();

        return ($user) ? $user : false;
    }

    public function get_userlevel($exp)
    {
        $level = $this->db
            ->where('needed_xp <=', $exp)
            ->order_by('level_id','desc')
            ->limit(1)
            ->get('levels')
            ->row();

         return ($level) ? $level->level_id : 0;
    }

    public function needed_xp($current_level)
    {
        $this->output->enable_profiler(true);
        $required_xp = $this->db
            ->where('level_id >=',$current_level)
            ->order_by('level_id','asc')
            ->limit(2)
            ->get('levels')
            ->result();

        return $required_xp;
    }

    public function xp_percentage($user_xp,$needed_xp,$prev_xp)
    {
        $to_gain = $needed_xp - $prev_xp;
        $progress = $user_xp - $prev_xp;
        $percentage = floor($progress / $to_gain * 100);

        return $percentage;
    }

}