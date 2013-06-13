<?php

class Super_model extends CI_Model {

    /**
     * Get the count of records in a table
     *
     * @param null $tbl_name
     * @return int
     */
    public function countRecords($tbl_name = null)
    {
        $totalRecord = 0;

        if (!empty($tbl_name)) {
            $totalRecord = $this->db->count_all($tbl_name);
        }

        return $totalRecord;
    }

    /**
     * Fetch all the records in a table
     *
     * @param null $tbl_name
     * @return bool
     */
    public function getAllRecords($tbl_name = null, $paramArr = array())
    {
        $start = isset($paramArr['start']) ? $paramArr['start'] : NULL;
        $limit = isset($paramArr['limit']) ? $paramArr['start'] : NULL;
        $sortField = isset($paramArr['sortField']) ? $paramArr['sortField'] : 'name';
        $sortOrder = isset($paramArr['sortOrder']) ? $paramArr['sortOrder'] : 'asc';
        $whereParam = isset($paramArr['whereParam']) ? $paramArr['whereParam'] : NULL;

        if(!empty($start) && !empty($limit)) {
            $optLimit = "limit $start,$limit";
        } else {
            $optLimit = NULL;
        }

        $whereClause = null;
        $orderByClause = null;

        if(!empty($whereParam)) {
            $whereParam = "and ($whereParam)";
            $whereClause = "where true $whereParam";
        }

        $SQL = "SELECT * FROM $tbl_name $whereClause order by $sortField $sortOrder $optLimit";

        $result = $this->db->query($SQL);

        if($result->num_rows() > 0) {
            $list = $result->result();
            return $list;
        } else {
            return null;
        }
    }
}