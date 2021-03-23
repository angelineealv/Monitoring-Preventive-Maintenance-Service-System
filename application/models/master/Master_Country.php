<?php

class Master_Country extends CI_Model
{
    protected $table = 'mscountry'; //nama tabel dari database


    public $columnSelect = array(
        'ctr.countryid',
        'ctr.countryname',
        'ctr.createdby',
        'ctr.createddate',
        'ctr.updatedby',
        'ctr.updateddate',
        'ctr.isactive'
    );

    public $columnSearch = array(
        'c.countryname'
    );

    public function complete_query()
    {
        $this->db->select('c.countryid, c.countryname, u.username as createdby, c.createddate, uu.username as updatedby, c.updateddate, c.isactive');
        $this->db->from('mscountry as c');
        $this->db->join('msuser as u', 'c.createdby = u.userid');
        $this->db->join('msuser as uu', 'c.updatedby = uu.userid');

        // $this->db->select($this->columnSelect);
        //$this->db->from($this->table . ' ctr');
        //$this->db->where('createdby', $this->session->userdata('userid'));
    }

    public function QueryDatatable()
    {
        $this->complete_query();
        return $this->db;
    }

    public function get_data($id)
    {
        $this->db->select('c.countryid, c.countryname, u.username as createdby, c.createddate, uu.username as updatedby, c.updateddate, c.isactive');
        $this->db->from('mscountry as c');
        $this->db->join('msuser as u', 'c.createdby = u.userid');
        $this->db->join('msuser as uu', 'c.updatedby = uu.userid');
        $this->db->where('c.countryid', $id);
        return $this->db->get()->row();
    }

    public function get_dataadd()
    {
        $this->db->select('c.countryid, c.countryname, u.username as createdby, c.createddate, uu.username as updatedby, c.updateddate, c.isactive');
        $this->db->from('mscountry as c');
        $this->db->join('msuser as u', 'c.createdby = u.userid');
        $this->db->join('msuser as uu', 'c.updatedby = uu.userid');
        return $this->db->get()->row();
    }


    public function tampil_data()
    {
        $this->db->select('c.countryid, c.countryname, u.username as createdby, c.createddate, uu.username as updatedby, c.updateddate, c.isactive');
        $this->db->from('mscountry as c');
        $this->db->join('msuser as u', 'c.createdby = u.userid');
        $this->db->join('msuser as uu', 'c.updatedby = uu.userid');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        }
    }



    public function Insert($param)
    {
        return $this->db->insert($this->table, $param);
    }

    public function Update($param, $id)
    {
        $this->db->where('countryid', $id);
        return $this->db->update($this->table, $param);
    }

    public function Delete($id)
    {
        $this->db->where('countryid', $id);
        return $this->db->delete($this->table);
    }
}
