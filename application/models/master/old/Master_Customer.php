<?php

class Master_Customer extends CI_Model
{
  protected $table = 'mscustomer'; //nama tabel dari database
  public $columnSelect = array(
    'cus.customerid',
    'cus.customername',
    'cus.customerprefix',
    'cus.customerphone',
    'cus.customeraddress',
    'cus.customeremail',
    'cus.customertypeid',
    'cus.customerprovinceid',
    'cus.customercityid',
    'cus.customersubdisid',
    'cus.customeruvid',
    'cus.customerpostalcode',
    'cus.customerlatitude',
    'cus.customerlongtitude',
    'cus.createdby',
    'cus.createddate',
    'cus.updatedby',
    'cus.updateddate',
    'cus.isactive'
  );

  public function complete_query()
  {
    $this->db->select($this->columnSelect);
    $this->db->from($this->table . 'customer');
  }

  public function QueryDatatable()
  {
    $this->complete_query();
    return $this->db;
  }

  public function get_data($id)
  {
    $this->db->select($this->columnSelect);
    $this->db->from($this->table . 'customer');
    $this->db->where('customer.customerid', $id);
    return $this->db->get()->row();
  }

  public function Insert($param)
  {
    return $this->db->insert($this->table, $param);
  }

  public function Update($param, $id)
  {
    $this->db->where('customerid', $id);
    return $this->db->update($this->table, $param);
  }

  public function Delete($id)
  {
    $this->db->where('customerid', $id);
    return $this->db->delete($this->table);
  }
}
