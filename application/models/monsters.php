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

    public function getMonsterData($monster_id){
        $monster = $this->db
            ->select("monster_name as name", false)
            ->select("monster_attack as attack", false)
            ->select("monster_defense as defese", false)
            ->select("monster_hp as hp", false)
            ->select("monster_exp_give", false)
            ->get_where('monsters',array('monster_id' => $monster_id))
            ->row();

        return ($monster) ? $monster : false;
    }


}