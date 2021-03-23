<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Userlog extends CI_Model
{
    private $table = 'msuserlog';
    //select
    //delete

    public function CheckUserLog($userid)
    {
        return $this->db->get_where('msuserlog', ['userid' => $userid])->row_array();
    }

    public function insertdata($data)
    {
        $this->db->insert('msuserlog', $data);
    }

    public function updatedata($data)
    {
        $this->db->update('msuserlog', $data);
    }
}
