<?php

namespace app\model;

class LoggingModel {

    private $db;

    public function __construct()
    {
        $this->db = \MysqliDb::getInstance();
    }

    public function count()
    {
        $this->db->get('logs');
        return $this->db->count;
    }

    public function getList($filter = false)
    {
        $this->db->orderBy('created_at', 'desc');

        if(isset($filter['limit'])) $res = $this->db->get('logs', $filter['limit']);
        else $res = $this->db->get('logs');

        if($this->db->count == 0) return false;
        return $res;
    }

    public function save($data)
    {
        $id = $this->db->insert('logs', $data);

        if($id) return true;
        return false;
    }

}