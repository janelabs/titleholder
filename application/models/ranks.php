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

}