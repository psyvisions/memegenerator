<?php
class ContactModel extends ME_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'contacts';
  }
  public function insert($params)
  {
    $this->db->insert($this->table, $params);
    return $this->db->insert_id();
  }
}