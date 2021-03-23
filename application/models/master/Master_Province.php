<?php

class Master_Province extends CI_Model
{
    protected $table = 'msprovince'; //nama tabel dari database
    public $columnSelect = array(
        'pvr.provinceid',
        'pvr.provincename',
        'pvr.countryid',
        'pvr.createdby',
        'pvr.createddate',
        'pvr.updatedby',
        'pvr.updateddate',
        'pvr.isactive'
    );
    // public function getcountry()
    //  {
    //$query = $this->db->query('SELECT * FROM mscountry');
    //  return $query->result();
    //}

    public function getuser()
    {
        $query = $this->db->query('SELECT * FROM msuser');
        return $query->result();
    }

    public function getcountry($searchTerm = "")
    {
        $status = array('t');
        $this->db->select('countryid,countryname');
        $this->db->where_in('isactive', $status);
        $this->db->where("countryname like '%" . $searchTerm . "%'");
        $fetched_records = $this->db->get('mscountry');
        $countries = $fetched_records->result_array();

        $data = array();
        foreach ($countries as $country) {
            $data[] = array("id" => $country['countryid'], "text" => $country['countryname']);
        }
        return $data;
    }





    public function tampil_data()
    {
        $this->db->select('p.provinceid, p.provincename, c.countryid,c.countryname, u.username as createdby, p.createddate, uu.username as updatedby, p.updateddate, p.isactive');
        $this->db->from('msprovince as p');
        $this->db->join('mscountry as c', 'p.countryid = c.countryid');
        $this->db->join('msuser as u', 'p.createdby = u.userid');
        $this->db->join('msuser as uu', 'p.updatedby = uu.userid');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        }
    }

    public function get_id()
    {
        $query = $this->db->get('mscountry');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public $columnSearch = array(
        'p.provincename',
        'c.countryname'
    );

    public function complete_query()
    {
        $this->db->select('p.provinceid, p.provincename, c.countryname, u.username as createdby, p.createddate, uu.username as updatedby, p.updateddate, p.isactive');
        $this->db->from('msprovince as p');
        $this->db->join('mscountry as c', 'p.countryid = c.countryid');
        $this->db->join('msuser as u', 'p.createdby = u.userid');
        $this->db->join('msuser as uu', 'p.updatedby = uu.userid');
        //$this->db->select($this->columnSelect);
        //$this->db->from($this->table . ' pvr'); 
    }

    public function QueryDatatable()
    {
        $this->complete_query();
        return $this->db;
    }

    public function get_data($id)
    {
        $this->db->select('p.provinceid, p.provincename, c.countryid,c.countryname, u.username as createdby, p.createddate, uu.username as updatedby, p.updateddate, p.isactive');
        $this->db->from('msprovince as p');
        $this->db->join('mscountry as c', 'p.countryid = c.countryid');
        $this->db->join('msuser as u', 'p.createdby = u.userid');
        $this->db->join('msuser as uu', 'p.updatedby = uu.userid');
        $this->db->where('p.provinceid', $id);
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


    public function Insert($param)
    {
        return $this->db->insert($this->table, $param);
    }

    public function Update($param, $id)
    {
        $this->db->where('provinceid', $id);
        return $this->db->update($this->table, $param);
    }

    public function Delete($id)
    {
        $this->db->where('provinceid', $id);
        return $this->db->delete($this->table);
    }
}
