<?php

class Master_User extends CI_Model
{
    protected $table = 'msuser'; //nama tabel dari database
    public $columnSelect = array(
        'usr.userid',
        'usr.username',
        'usr.userpassword',
        'usr.createdby',
        'usr.createddate',
        'usr.updatedby',
        'usr.updateddate',
        'usr.isactive'
    );

    public $columnSearch = array(
        'usr.username'
    );

    public function complete_query()
    {
        $this->db->select($this->columnSelect);
        $this->db->from($this->table . ' usr');
    }

    public function QueryDatatable()
    {
        $this->complete_query();
        return $this->db;
    }

    public function get_name($id)
    {
        $this->db->select('create.username as create, update.username as update');
        $this->db->from('mscustomer as cust');
        $this->db->join($this->table . ' create', 'cust.createdby = create.userid');
        $this->db->join($this->table . ' update', 'cust.updatedby = update.userid');
        $this->db->where('cust.customerid', $id);
        return $this->db->get()->row_object();
    }

    public function getDataById($id)
    {
        $this->complete_query();
        $this->db->where('usr.userid', $id);
        return $this->db->get()->row();
    }

    public function getDataByName($username)
    {
        $this->complete_query();
        $this->db->where('usr.username', $username);
        return $this->db->get()->row();
    }

    public function ChangePass($username, $password1)
    {
        $this->db->where('username', $username);
        $this->db->set('userpassword', password_hash($password1, PASSWORD_DEFAULT));
        $this->db->update('msuser');
    }

    public function Insert($param)
    {
        $this->db->insert($this->table, $param);
    }

    public function Update($param, $id)
    {
        $this->db->where('userid', $id);
        $this->db->update($this->table, $param);
    }

    public function Delete($id)
    {
        $this->db->where('userid', $id);
        $this->db->delete($this->table);
    }
}
