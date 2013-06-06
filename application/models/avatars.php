<?php


class Avatars extends CI_Model {

    public function get($id = null)
    {
        if($id) {
            $avatars = $this->db->get_where('avatar',array('avatar_id' => $id))->row();
            return $avatars;
        }

        $avatars = $this->db
            ->get('avatar')
            ->result();

        return $avatars;
    }



}