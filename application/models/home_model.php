<?php
class home_model extends CI_Model
{
    function tampil_country()
    {
        return $this->db->query("SELECT count(countryid) as total FROM mscountry");
    }
    function tampil_prov()
    {
        return $this->db->query("SELECT count(provinceid) as totalprov FROM msprovince");
    }

    function tampil_city()
    {
        return $this->db->query("SELECT count(cityid) as totalcity FROM mscity");
    }

    function tampil_branch()
    {
        return $this->db->query("SELECT count(branchid) as totalbranch FROM msbranch");
    }

    function tampil_type()
    {
        return $this->db->query("SELECT count(typeid) as totaltype FROM mstype");
    }

    function tampil_customer()
    {
        return $this->db->query("SELECT count(customerid) as totalcustomer FROM mscustomer");
    }

    public function graph()
    {
        return $this->db->query("SELECT *  FROM msbranch")->result();
    }

    public function graph2()
    {
        return $this->db->query("SELECT * FROM mscity")->result();
    }

    function graph3()

    {
        $this->db->select('*');
        $this->db->from('mscountry');
        $this->db->join('msprovince', 'msprovince.countryid = mscountry.countryid');
        $this->db->join('mscity', 'msprovince.provinceid = mscity.provinceid');
        $this->db->join('msbranch', 'msbranch.cityid = mscity.cityid');
        return $this->db->get()->result();
    }

    public function graph4()
    {

        return $this->db->query("SELECT * FROM msprovince")->result();
    }
    public function graph5()
    {

        return $this->db->query("SELECT * FROM mscustomer")->result();

        // return $this->db->query("SELECT c.provinceid, c.provincename, count(p.provinceid) AS no_pro FROM msprovince p join msbranch c on p.provinceid = c.provinceid GROUP BY c.provinceid");
    }

    public function GetPie()
    {

        return $this->db->query("SELECT c.countryid, c.countryname, count(p.countryid) AS no_province FROM msprovince p join mscountry c on p.countryid = c.countryid GROUP BY c.countryid");

        /**
        $this->db->select('a.countryid')
            ->distinct('a.countryname, ', 'as Countryname')
            ->distinct('t.provincename, ', 'as Provincename')
            ->from('mscountry a')
            ->join('msprovince t', 'a.countryid = t.countryid')
            ->group_by('a.countryid');
        return $this->db->get()->result();

         */
    }

    public function GetPie1()
    {
        return $this->db->query("SELECT p.cityid, p.cityname, count(m.cityid) AS no_pro FROM msbranch m
         join mscity p on p.cityid = m.cityid GROUP BY p.cityid");
    }


    public function graphh()
    {

        return $this->db->query("SELECT * FROM msprovince")->result();
    }

    /** 
    public function isNotLogin()
    {
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($username)
    {
        $sql = "UPDATE {$this->_table} SET lastlogin=now() WHERE username={$username}";
        $this->db->query($sql);
    }
     */
    public function userdata()
    {
        return $this->db->query("SELECT * FROM msuser")->result();
    }
}
