<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if ($this->session->userdata('username')) {
      $data['title'] = "HDS II";
      $data['link'] = '';
      $data['pagetitle'] = "";
      $data['content'] = "";

      $this->theme->panel("_index", $data);
    } else {
      redirect(base_url('login'));
    }
  }
}
