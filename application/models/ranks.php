<?php


class Ranks extends CI_Model {

    // FIXME: repeating code, enhance
    public function getRankingsByTitle(){
        $rankings = $this->db->query('SELECT user_data.name, user_data.avatar_filename, count( rank_id ) r
FROM `user_ranks`
INNER JOIN user_data ON user_data.id = user_ranks.user_id
GROUP BY user_id
ORDER BY r DESC');
        if ($rankings->num_rows() > 0){
            return $rankings->result();
        }
        else {
            return false;
        }

    }

    public function getRankingsByLevel(){
        $rankings = $this->db->query('SELECT name, level, avatar_filename
FROM `user_data`
ORDER BY `user_data`.`level` DESC');
        if ($rankings->num_rows() > 0){
            return $rankings->result();
        }
        else {
            return false;
        }

    }

    public function getTop($int){

    }
}