<?php

class Pets extends CI_Model {

    public function get($id = null)
    {
        if($id) {
            $pets = $this->db->get_where('pets',array('pet_id' => $id))->row();
            return $pets;
        }

        $pets = $this->db
            ->get('pets')
            ->result();

        return $pets;
    }


}