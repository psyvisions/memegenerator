<?php
class UsersModel extends ME_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'users';
  }

  public function search($usuario, $password)
  {
    $query = $this->db->get_where($this->table, array('password' => $password, 'username' => $usuario));
    $row = $query->result_array();
    return $row[0];
  }
  public function insert($params)
  {
    $this->db->insert($this->table, $params);
    return $this->db->insert_id();
  }
}
