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
            ->select("users.*", false)
            ->select('pets.*', false)
            ->join('pets', 'pets.pet_id = users.pid')
            ->get_where('users',array('id' => $userid))
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

    public function required_xp($current_level)
    {
        $base = 10;
        $ratio = 3;

        $previous_xp = ($base * $ratio * ($current_level - 1));
        $required_xp = ($base * $ratio * $current_level) + $previous_xp;

        return $required_xp;
    }

}