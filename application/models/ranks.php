<?php


class Ranks extends CI_Model
{

    public function isRankOwned($user_id, $rank_id)
    {
        $rank_title = $this->db
            ->where('user_id',$user_id)
            ->where('rank_id',$rank_id)
            ->get('user_ranks')
            ->row();

        return ($rank_title) ? $rank_title : false;
    }

    public function addUserRanks($user_id,$rank_id)
    {
        $data = array(
            'user_id' => $user_id,
            'rank_id' => $rank_id
        );

        $this->db->insert('user_ranks', $data);

        return ($this->db->affected_rows()) ? true : false;
    }

    public function getRanks($rank_id = null)
    {
        if($rank_id) {
            $ranks = $this->db->get_where('ranks',array('rank_id' => $rank_id))->row();
            return $ranks;
        }

        $ranks = $this->db
            ->get('ranks')
            ->result();

        return ($ranks) ? $ranks : false;
    }

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
ORDER BY `user_data`.`level` DESC LIMIT 5');
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