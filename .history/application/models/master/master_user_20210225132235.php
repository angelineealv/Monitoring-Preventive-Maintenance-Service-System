<?php

class Master_User extends CI_Model
{
  var $table = 'msuser'; //nama tabel dari database
  var $selectData = array(
    'usr.userid',
    'usr.username',
    'usr.name',
    'usr.isactive'
  );

  var $searchData = array(
    'usr.username',
    'usr.name'
  );

  var $order = array(
    'usr.userid' => 'asc'
  );

  private function _get_datatables_query()
  {

    $this->db->from($this->table);

    $i = 0;

    foreach ($this->searchData as $item) // looping awal
    {
      if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
      {

        if ($i === 0) // looping awal
        {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search) - 1 == $i)
          $this->db->group_end();
      }
      $i++;
    }

    if (isset($_POST['order'])) {
      $this->db->order_by($this->selectData[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function get_data($id)
  {
    $this->db->select($this->selectData);
    $this->db->from($this->table . ' p');
    $this->db->join('msuser mu', 'mu.userid = p.createdby', 'left');
    $this->db->join('msuser mt', 'mt.userid = p.updatedby', 'left');
  }

  public function Insert($param)
  {
    return $this->db->insert($this->table, $param);
  }
}
