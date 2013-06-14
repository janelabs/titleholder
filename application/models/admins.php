<?php

class Admins extends CI_Model {

    public function getAdminByUsername($username = null)
    {
        $where = array('admin_username' => $username);

        $adminInfo = $this->db->get_where('admins', $where)->row();

        return $adminInfo ? $adminInfo : false;
    }
}