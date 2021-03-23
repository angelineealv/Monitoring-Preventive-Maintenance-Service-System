<?php

defined('BASEPATH') or exit('No direct script access allowed');

use vendor\database\Datatables;

class MasterUserLog extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('master/Master_UserLog', 'user');
        $this->load->helper('date');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Master UserLog";

            $this->theme->panel("master/userlog/v_indexlog", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function datatables()
    {
        $json = array();
        $datatables = new Datatables('Master_UserLog', 'QueryDatatable', 'columnSearch');
        $datatables->execute();


        foreach ($datatables->getData() as $key => $value) {

            $data = array();


            $data[] = $datatables->getNumber();
            $data[] = $value->username;
            $data[] = $value->firstlogin;
            $data[] = $value->lastlogin;
            $data[] = $value->lastactive;

            $activeDuration = date((strtotime($value->lastactive) - strtotime($value->lastlogin)));


            $dtF = new \DateTime('@0');
            $dtT = new \DateTime("@$activeDuration");
            $data[] = $dtF->diff($dtT)->format('%y tahun, %m bulan, %a hari, %h jam, %i menit dan %s detik');


            $data[] = $value->lastlocation;
            $data[] = $value->lastpasswordchange;
            $json[] = $data;
        }

        echo json_encode(array(
            'draw' => $datatables->draw,
            'data' => $json,
            'recordsTotal' => $datatables->getCountData(),
            'recordsFiltered' => $datatables->getCountFiltered()
        ));
    }
}
