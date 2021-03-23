<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Output $output
 * */
class AppController extends MY_Controller
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

      $this->load->view("index", $data);
    } else {
      redirect(base_url('login'));
    }
  }
}
