<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class SystemAuth extends CI_Model
{

    protected function complete_query()
    {
        $this->db->select("a.userid, a.username, a.name");
        $this->db->from("msuser a");
    }

    public function findUser($username)
    {
        return $this->db->get_where('msuser', ['username' => $username])->row_array();
    }

    public function logout($id)
    {
        date_default_timezone_set("ASIA/JAKARTA");

        $this->db->where('userid', $id);
        $this->db->set('lastactive', date("Y-m-d H:i:s"));
        $this->db->set('activeduration', timespan('lastlogin', 'lastactive', 3));
        $this->db->update('msuserlog');
    }
}
