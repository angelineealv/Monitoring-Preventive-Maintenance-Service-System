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
}
