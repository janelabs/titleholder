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
    public function getAllRecords($tbl_name = null, $paramArr = array(), $joinArr = array() )
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

        $SQL = "SELECT * FROM $tbl_name";
        $JOIN = null;
        if (count($joinArr) > 0) {
            $JOIN = " LEFT JOIN {$joinArr['tbl']} {$joinArr['on']}";
        }
        $WHERE = " $whereClause order by $sortField $sortOrder $optLimit";

        $result = $this->db->query($SQL . $JOIN . $WHERE);

        if($result->num_rows() > 0) {
            $list = $result->result();
            return $list;
        } else {
            return null;
        }
    }

    /**
     * Delete specific row
     *
     * @param null $tbl_name
     * @param array $where
     * @return bool
     */
    public function deleteRow($tbl_name = null, $where = array())
    {
        $query = false;

        if ($tbl_name && count($where) > 0) {
            $query = $this->db->delete($tbl_name, $where);
        }

        return $query;
    }

    /**
     * Update specific row
     *
     * @param null $tbl_name
     * @param array $where
     * @param array $data
     * @return bool
     */
    public function editRow($tbl_name = null, $where = array(), $data = array())
    {
        $query = false;

        if ($tbl_name && count($where) > 0 && count($data) > 0) {
            $query = $this->db->where($where)
                ->update($tbl_name, $data);
        }

        return $query;
    }
}