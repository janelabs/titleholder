<?php


class Ranks extends CI_Model {
    public function getRankings(){
        $rankings = $this->db->query('SELECT user_id, count( rank_id ) r FROM `user_ranks` group by user_id order by r DESC');
        if ($rankings->num_rows() > 0){
            return $rankings;
        }
        else {
            return false;
        }

    }

    public function getTop($int){

    }
}