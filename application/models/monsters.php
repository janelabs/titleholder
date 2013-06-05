<?php


class Monsters extends CI_Model {

    public function getByLevel($level = 0)
    {
        $monsterByLevel = $this->db->get();
    }
}