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
    if ($this->session->userdata('username')) {
      $data['page_heading'] = "Master User";

      $this->theme->panel("master/user/v_index", $data);
    } else {
      redirect(base_url('login'));
    }
  }
}
