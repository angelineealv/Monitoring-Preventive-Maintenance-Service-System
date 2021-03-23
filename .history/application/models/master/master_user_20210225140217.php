<?php

class Master_User extends CI_Model
{
  protected $table = 'msuser'; //nama tabel dari database
  public $selectData = array(
    'usr.userid',
    'usr.username',
    'usr.name',
    'usr.password',
    'usr.isactive'
  );

  public $searchData = array(
    'usr.username',
    'usr.name'
  );

  public function complete_query()
  {
    $this->db->select($this->selectData);
    $this->db->from($this->table . ' usr');
  }

  public function QueryDatatable()
  {
    $this->complete_query();
    return $this->db;
  }

  public function get_data($id)
  {
    $this->db->select($this->selectData);
    $this->db->from($this->table . ' usr');
    $this->db->where('usr.userid', $id);
    return $this->db->get()->row();
  }

  public function Insert($param)
  {
    return $this->db->insert($this->table, $param);
  }

  public function Update($param, $id)
  {
    $this->db->where('userid', $id);
    return $this->db->update($this->table, $param);
  }

  public function Delete($id)
  {
    $this->db->where('userid', $id);
    return $this->db->delete($this->table);
  }
}
