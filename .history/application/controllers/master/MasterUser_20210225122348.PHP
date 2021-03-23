<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MasterUser extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('master/Master_User', 'user');
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
    $list = $this->user->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {
      $no++;
      $row = array();

      $btnEdit = "<a href='" . base_url() . "' class='btn btn-xs btn-primary' style='color: #fff;'><i class='fas fa-edit'></i></a>";
      $btnDelete = "<a href='' class='btn btn-xs btn-danger' style='color: #fff;'><i class='fas fa-trash'></i></a>";

      $row[] = $no;
      $row[] = $field->username;
      $row[] = $field->name;
      $row[] = $field->isactive;
      $row[] = $btnEdit . " " . $btnDelete;

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->user->count_all(),
      "recordsFiltered" => $this->user->count_filtered(),
      "data" => $data,
    );
    //output dalam format JSON
    echo json_encode($output);
  }
}
