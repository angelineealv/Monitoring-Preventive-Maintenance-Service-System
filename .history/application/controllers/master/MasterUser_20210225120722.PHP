<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MasterUser extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if ($this->session->userdata('username')) {
      $data['page_heading'] = "Master User";

      $this->theme->panel("master/user/v_index", $data);
    } else {
      redirect(base_url('login'));
    }
  }

  public function datatables()
  {
    $list = $this->User_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $field->user_nama;
      $row[] = $field->user_email;
      $row[] = $field->user_alamat;

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->User_model->count_all(),
      "recordsFiltered" => $this->User_model->count_filtered(),
      "data" => $data,
    );
    //output dalam format JSON
    echo json_encode($output);
  }
}
