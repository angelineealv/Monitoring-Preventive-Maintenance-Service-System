<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author veilz
 */
class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("System_User", "user");
    $this->load->model("TableUserHistory", "userhistory");
  }

  public function index()
  {
    if ($this->session->userdata('username')) {
      redirect(base_url());
    } else {
      $this->load->view('login');
    }
  }

  public function process()
  {
    $username = $this->input->post('username');
    $password = md5($this->input->post('password'));

    $RESULT = $this->user->findUserPass($username, $password);

    if ($RESULT->num_rows() == 0) {
      echo 0;
    } else {
      $ROW = $RESULT->row();

      if ($ROW) {
        $ACCESS = $this->user->findUserPass($username, $password, 'access');
        $ACTIVE = $this->user->findUserPass($username, $password, 'active');
        if ($ACCESS->num_rows() == 0) {
          echo 2;
        } elseif ($ACTIVE->num_rows() == 0) {
          echo 3;
        } else {
          $this->session->set_userdata('username', $ROW->userid);
          $this->session->set_userdata('typeid', $ROW->typeid);
          $this->session->set_userdata('contactid', $ROW->contactid);
          $this->session->set_userdata('periode', date('Y'));

          $this->session->set_userdata('company', $ROW->compnm);
          $this->session->set_userdata('groupid', $ROW->groupid);
          $this->session->set_userdata('companyid', $ROW->companyid);

          $this->session->set_userdata('grouptypenm', $ROW->typenm);
          $this->session->set_userdata('grouptypeid', $ROW->grouptypeid);


          //insert to userhistory
          $data = array(
            "description" => "Login HDS",
            "createdby" => $ROW->userid,
            "createddate" => date('Y-m-d H:i:s')
          );
          $result = $this->userhistory->addHistory($data);

          echo 1;
        }
      }
    }
  }

  public function setPeriode()
  {
    $this->session->set_userdata('periode', getGet('year'));
    redirect(base_url('' . getGet('url')));
  }

  public function setCompany()
  {
    $userdt = getUserCompany(getGet('dtid'), 'a.id')->row();
    $set['companyid'] = $userdt->companyid;
    $set['company'] = $userdt->compnm;
    $set['groupid'] = $userdt->groupid;
    $set['grouptypeid'] = $userdt->typeid;
    $set['grouptypenm'] = $userdt->typenm;

    $this->session->set_userdata($set);
    redirect(base_url());
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url("dashboard"));
  }
}
