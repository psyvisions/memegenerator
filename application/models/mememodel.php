<?php
class MemeModel extends ME_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'memes';
  }
  public function insert($params)
  {
    $this->db->insert($this->table, $params);
    return $this->db->insert_id();
  }
  
  public function getAll()
  {
    $query = $this->db->get($this->table);
    return $query->result_array();
  }
}