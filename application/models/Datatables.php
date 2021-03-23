<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Datatables extends CI_Model {

     function _get_datatables_query($kueri) {
        $cari = strtolower($_REQUEST['search']['value']);
//     
        
        $i = 0;
        if($cari){
            $this->db->group_start();
        }
        foreach ($kueri as $item) {
            if (strpos($item, "AS") > 0 ) {
                $item = substr($item, 0, strpos($item, "AS"));
            } else {
                $item = $item;
            }
            if ($cari)
                ($i === 0) ? $this->db->like('LOWER(cast( ' . $item . ' as text))', $cari)->or_like('cast( ' . $item . ' as text)', $cari) : $this->db->or_like('LOWER( cast( ' . $item . ' as text))', $cari)->or_like('cast( ' . $item . ' as text)', $cari);
            $column[$i] = $item;
            $i++;
        }
        
        if($cari){
            $this->db->group_end();
        }

        if (isset($_REQUEST['order'])) {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($kueri) {
        
        $this->_get_datatables_query($kueri);
        if ($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        $query = $this->db->get();
       // echo $this->db->last_query();die();
        return $query->result();
    }

    function get_datatables_string($kueri) {
        $this->_get_datatables_query($kueri);
        if ($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        return $this->db->get_compiled_select();
    }
    
    function get_query_string($kueri) {
        $this->_get_datatables_query($kueri);
        return $this->db->get_compiled_select();
    }
   
    

}