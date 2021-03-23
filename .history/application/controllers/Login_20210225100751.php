<?php
class Login extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Login", "login");
  }

  public function index()
  {
    $this->load->view('template/_login');
  }

  public function ceklogin()
  {
    $this->db->trans_begin();
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $cek = $this->login->cek_login($username, md5($password));
    $value = $this->login->cek_login($username, md5($password))->row_array();
    $branch = $this->M_Login->cek_branch($value["userid"])->row_array();
    if ($cek->num_rows() > 0) {
      if ($value['levelid'] == 5 && $branch["adminid"] == NULL) {
        redirect("login?status=branch_notfound", 'refresh');
      } elseif ($value['levelid'] == 4 && $branch["spvid"] == NULL || $value['levelid'] == 7 && $branch["spvid"] == NULL) {
        redirect("login?status=branch_notfound", 'refresh');
      } else {
        if ($value["isactive"] == "t") {
          $data = array(
            'login'     => TRUE,
            'username'  => $value["username"],
            'userid'    => $value["userid"],
            'branchid'  => $branch["branchid"],
            'fullname'  => $value["fullname"],
            'levelid'   => $value["levelid"]
          );
          $this->session->set_userdata($data);
          if ($this->session->userdata('login') == TRUE) {
            if ($this->session->userdata('levelid') == 1)
              redirect("transaksi");
            if ($this->session->userdata('levelid') == 2)
              redirect("transaksi");
            if ($this->session->userdata('levelid') == 3)
              redirect("transaksi/purchase");
            if ($this->session->userdata('levelid') == 4)
              redirect("transaksi/purchase");
            if ($this->session->userdata('levelid') == 7)
              redirect("transaksi/purchase");
            if ($this->session->userdata('levelid') == 5)
              redirect("transaksi");
            if ($this->session->userdata('levelid') == 9)
              redirect("transaksi/purchase");
            if ($this->session->userdata('levelid') == 10)
              redirect("transaksi/inquiry");
          }
        } else {
          redirect("login?status=account_inactive", 'refresh');
        }
    //       }
    //     } else {
    //       redirect("login?status=login_failed", 'refresh');
    //     }
    //   }
    // }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }
}
