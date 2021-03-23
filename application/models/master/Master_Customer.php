<?php

class Master_Customer extends CI_Model
{
    protected $table = 'mscustomer'; //nama tabel dari database
    public $columnSelect = array(
        'cust.customerid',
        'cust.customername',
        'cust.customerprefix',
        'cust.customerphone',
        'cust.customeraddress',
        'cust.customeremail',
        'cust.customertypeid',
        'cust.customerprovinceid',
        'cust.customercityid',
        'cust.customersubdisid',
        'cust.customeruvid',
        'cust.customerpostalcode',
        'cust.customerlatitude',
        'cust.customerlongtitude',
        'cust.createdby',
        'cust.createddate',
        'cust.updatedby',
        'cust.updateddate',
        'cust.isactive'
    );

    public $columnSearch = array(
        'cust.customerid',
        'cust.customername',
        'cust.customerprefix',
        'cust.customerphone',
        'cust.customeraddress',
        'cust.customeremail',
        'type.typename',
        'prov.provincename',
        'city.cityname',
        'cust.customersubdisid',
        'cust.customeruvid',
        'cust.customerpostalcode',
        'cust.customerlatitude',
        'cust.customerlongtitude',

        'cust.createdby',
        'cust.createddate',

        'cust.updatedby',
        'cust.updateddate',
        'cust.isactive'
    );

    public function complete_query()
    {
        $this->db->select($this->columnSelect);
        $this->db->from($this->table . ' cust');
    }

    public function QueryDatatable()
    {
        $this->db->select($this->columnSearch);
        $this->db->from($this->table . ' cust');
        $this->db->join('mstype as type', 'cust.customertypeid = type.typeid');
        $this->db->join('msprovince as prov', 'cust.customerprovinceid = prov.provinceid');
        $this->db->join('mscity as city', 'cust.customercityid = city.cityid');
        return $this->db;
    }

    public function get_data($id)
    {

        $this->db->select($this->columnSelect);
        $this->db->from($this->table . ' cust');
        $this->db->where('cust.customerid', $id);
        return $this->db->get()->row_object();
    }

    function Cityname($id)
    {
        $this->db->select('cityname');
        $this->db->where("cityid", $id);
        return $this->db->get('mscity')->row_object();
    }

    function Provname($id)
    {
        $this->db->select('provincename');
        $this->db->where("provinceid", $id);
        return $this->db->get('msprovince')->row_object();
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


    function getCity($searchTerm = "")
    {

        $this->db->select('cityid, cityname');
        $this->db->where("cityname like '%" . $searchTerm . "%' ");
        $fetched_records = $this->db->get('mscity');
        $cities = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach ($cities as $city) {
            $data[] = array("id" => $city['cityid'], "text" => $city['cityname']);
        }
        return $data;
    }

    public function Insert($param)
    {
        return $this->db->insert($this->table, $param);
    }

    public function Update($param, $id)
    {
        $this->db->where('customerid', $id);
        $this->db->update($this->table, $param);
    }

    public function Delete($id)
    {
        $this->db->where('customerid', $id);
        return $this->db->delete($this->table);
    }
    public function tampil_data()
    {
        $this->db->select($this->columnSearch);
        $this->db->from($this->table . ' cust');
        $this->db->join('mstype as type', 'cust.customertypeid = type.typeid');
        $this->db->join('msprovince as prov', 'cust.customerprovinceid = prov.provinceid');
        $this->db->join('mscity as city', 'cust.customercityid = city.cityid');
        return $this->db->get();
        // return $this->db->get('mscustomer');
    }
}
