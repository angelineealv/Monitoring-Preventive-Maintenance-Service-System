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
    $this->db->select("a.userid, a.username, a.name");
    $this->db->from("msuser a");
  }

  public function findUser($user, $pass)
  {
    $this->complete_query();
    $this->db->where("a.isactive", "t");
    $this->db->where("a.username", $user);
    $this->db->where("a.pswrd", $pass);
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
