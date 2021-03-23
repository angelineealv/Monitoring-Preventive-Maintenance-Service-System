<?php

class Master_City extends CI_Model
{
    protected $table = 'mscity'; //nama tabel dari database
    public $columnSelect = array(
        'city.cityid',
        'city.cityname',
        'provincename',
        'create.username as create',
        'city.createddate',
        'update.username as update',
        'city.updateddate',
        'city.isactive'
    );


    public $columnSearch = array(

        'city.cityname',
        'provincename',
        'city.createdby',
        'city.createddate',
        'city.updatedby',
        'city.updateddate',
        'city.isactive'
    );


    public function complete_query()
    {
        $this->db->select($this->columnSelect);
        $this->db->from($this->table . ' city');
        $this->db->join('msprovince as province', 'city.provinceid = province.provinceid');
        $this->db->join('msuser as create', 'city.createdby = create.userid');
        $this->db->join('msuser as update', 'city.updatedby = update.userid');
    }
    /** 
    public function complete_query()
    {
        $this->db->select('c.cityid, c.cityname, p.provinceid, u.username as createdby, c.createddate, uu.username as updatedby, 
        c.updateddate, c.isactive');
        $this->db->from('mscity as c');
        $this->db->join('msprovince as p', 'p.provinceid = c.provinceid');
        $this->db->join('msuser as u', 'c.createdby = u.userid');
        $this->db->join('msuser as uu', 'c.updatedby = uu.userid');

    }*/

    public function QueryDatatable()
    {
        $this->complete_query();
        return $this->db;
    }

    /**
     public function get_data($id)
    {
        $this->db->select($this->columnSearch);
        $this->db->from($this->table);
        $this->db->where('mscity.cityid', $id);
        // $this->db->join('msprovince', 'msprovince.provinceid = city.provinceid', 'left');
        return $this->db->get()->row();
    } */

    public function get_data($id)
    {
        $this->db->select('city.cityid, city.cityname, province.provinceid, province.provincename, create.username as createdby, city.createddate, update.username as updatedby, 
        city.updateddate, city.isactive');
        $this->db->from('mscity as city');
        $this->db->join('msprovince as province', 'city.provinceid = province.provinceid');
        $this->db->join('msuser as create', 'city.createdby = create.userid');
        $this->db->join('msuser as update', 'city.updatedby = update.userid');
        $this->db->where('city.cityid', $id);
        return $this->db->get()->row();
    }

    public function get_dataadd()
    {
        $this->db->select('city.cityid, city.cityname, province.provincename, create.username as createdby, city.createddate, update.username as updatedby, 
    city.updateddate, city.isactive');
        $this->db->from('mscity as city');
        $this->db->join('msprovince as province', 'city.provinceid = province.provinceid');
        $this->db->join('msuser as create', 'city.createdby = create.userid');
        $this->db->join('msuser as update', 'city.updatedby = update.userid');

        return $this->db->get()->row();
    }



    public function Insert($param)
    {
        return $this->db->insert($this->table, $param);
    }

    public function Update($param, $id)
    {
        $this->db->where('cityid', $id);
        return $this->db->update($this->table, $param);
    }

    public function Delete($id)
    {
        $this->db->where('cityid', $id);
        return $this->db->delete($this->table);
    }


    function getProvince($searchTerm = "")
    {

        $this->db->select('provinceid, provincename');
        $this->db->where("provincename like '%" . $searchTerm . "%' ");
        $fetched_records = $this->db->get('msprovince');
        $provinces = $fetched_records->result_array();

        $data = array();
        foreach ($provinces as $province) {
            $data[] = array("id" => $province['provinceid'], "text" => $province['provincename']);
        }
        return $data;
    }

    public function tampil_data()
    {

        $this->db->select('city.cityid, city.cityname, province.provincename, create.username as createdby, city.createddate, update.username as updatedby, 
        city.updateddate, city.isactive');
        $this->db->from($this->table . ' city');
        $this->db->join('msprovince as province', 'city.provinceid = province.provinceid');
        $this->db->join('msuser as create', 'city.createdby = create.userid');
        $this->db->join('msuser as update', 'city.updatedby = update.userid');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        }
    }
}
