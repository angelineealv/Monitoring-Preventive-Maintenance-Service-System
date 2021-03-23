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

      $btnEdit = "<a href='" . base_url("master/user/edit/$field->userid") . "' class='btn btn-xs btn-primary' style='color: #fff;'><i class='fas fa-edit'></i></a>";
      $btnDelete = "<a href='" . base_url("master/user/delete/$field->userid") . "' class='btn btn-xs btn-danger' style='color: #fff;'><i class='fas fa-trash'></i></a>";

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

  public function add()
  {
    if ($this->session->userdata('username')) {
      $data['page_heading'] = "Add Master User";
      $data['form_type'] = "add";
      $this->theme->panel("master/user/v_form", $data);
    } else {
      redirect(base_url('login'));
    }
  }

  public function insertData()
  {
    $this->db->trans_begin();
    $insert['username'] = $this->input->post('username');
    $insert['password'] = md5($this->input->post('username'));
    $insert['name'] = $this->input->post('name');
    $insert['isactive'] = 't';

    $this->user->Insert($insert);
    $json = array();
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $data["result"] = '1';
      $data["message"] = 'Insert Data Failed! Please try again!';
    } else {
      $this->db->trans_commit();
      $data["result"] = '1';
      $data["message"] = 'Insert Data Failed! Please try again!';
    }
  }

  public function edit()
  {
    if ($this->session->userdata('username')) {
      $data['page_heading'] = "Edit Master User";
      $data['form_type'] = "edit";
      $this->theme->panel("master/user/v_form", $data);
    } else {
      redirect(base_url('login'));
    }
  }
}
