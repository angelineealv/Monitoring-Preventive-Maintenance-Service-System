<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class System_User extends CI_Model
{

  protected function complete_query()
  {
    $this->db->select("a.userid, b.groupid, b.compid, c.compnm, c.companyid, d.contactnm, d.typeid, d.contactid, type.typenm, c.typeid as grouptypeid");
    $this->db->from("msuser a");
    $this->db->join("msuserdt b", "a.userid = b.userid");
    $this->db->join("mscompany c", "b.compid = c.companyid");
    $this->db->join("mscontact d", "a.contactid = d.contactid");
    $this->db->join("mstype type", "c.typeid = type.typeid");
  }

  public function findUserPass($user, $pass, $where = '')
  {
    $this->complete_query();
    if ($where == 'access') {
      $this->db->join("msgroup gr", "b.groupid = gr.groupid");
      $this->db->where("gr.groupaccess", "web");
      $this->db->or_where("gr.groupaccess", "121");
    } elseif ($where == 'active') {
      $this->db->where("a.isactive", "t");
    }
    $this->db->where("a.username", $user);
    $this->db->where("a.pswrd", $pass);
    $this->db->where("b.isdefault", 1);
    $this->db->limit(1);
    return $this->db->get();
  }

  public function find($id)
  {
    $this->complete_query();
    $this->db->where("a.userid", $id);
    return $this->db->get();
  }

  public function getRelation($param)
  {
    $query = "  SELECT
                        rel.distributorid,
                        dis.compnm distributornm,
                        rel.supplierid,
                        sup.compnm suppliernm,
                        rel.pelaksanaid,
                        pel.compnm pelaksananm
                    FROM msrelation rel
                        JOIN mscompany dis ON rel.distributorid = dis.companyid
                        JOIN mscompany sup ON rel.supplierid = sup.companyid
                        JOIN mscompany pel ON rel.pelaksanaid = pel.companyid
                    WHERE rel.distributorid = $param
                        OR rel.supplierid = $param
                        OR rel.pelaksanaid = $param";
    return $this->db->query($query);
  }
}
