<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    //  $this->load->model('home_model');
  }

  public function index()
  {
    if ($this->session->userdata('username')) {
      $data['title'] = "HDS II";
      $data['link'] = '';
      $data['pagetitle'] = "";
      $data['content'] = "";

      $this->theme->panel("dashboard/v_index", $data);
    } else {
      redirect(base_url('login'));
    }
  }
  /** 
  public function dashboard()
  {
    $data['totcountry'] = $this->home_model->tampil_country()->row();
    $data['totprov'] =  $this->home_model->tampil_prov()->row();
    $data['totcity'] =  $this->home_model->tampil_city()->row();
    $data['totbranch'] =  $this->home_model->tampil_branch()->row();
    $data['tottype'] =  $this->home_model->tampil_type()->row();
    $data['totcustomer'] =  $this->home_model->tampil_customer()->row();
    $data['graph'] =  $this->home_model->graph();
    $data['graph2'] =  $this->home_model->graph2();
    $data['graph3'] =  $this->home_model->graph3();
    $data['graph4'] =  $this->home_model->graph4();
    $data['graph5'] =  $this->home_model->graph5();
    $data['pie_data'] =  $this->home_model->GetPie();
    $data['graphh'] =  $this->home_model->graphh();
    $data['chartdata'] =  $this->home_model->GetPie1();


    $this->load->view('template/inc/_header');
    $this->load->view('template/inc/_sidebar');
    $this->load->view('dashboard/v_index', $data);
    $this->load->view('template/inc/_footer');
  }
   */
}
