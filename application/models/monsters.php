<?php


class Monsters extends CI_Model {


    public function getByLevel($where = null)
    {
       $monsterByLevel = $this->db
            ->where($where)
            ->limit(3)
            ->get('monsters')
            ->result();

        return $monsterByLevel ? $monsterByLevel : false;
    }
}