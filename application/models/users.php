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
            ->join('pets', 'pets.pet_id = users.pet_id')
            ->get_where('users',array('id' => $userid))
            ->row();

        return ($user) ? $user : false;
    }

}