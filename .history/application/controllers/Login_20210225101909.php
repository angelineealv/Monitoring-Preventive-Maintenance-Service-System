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
    if ($this->session->userdata('username')) {
      redirect(base_url());
    } else {
      $this->load->view('template/_login');
    }
  }

  public function ceklogin()
  {
    $this->db->trans_begin();
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $result = $this->login->findUser($username, md5($password));

    if ($result->num_rows() > 0) {
      echo 0;
    } else {
      $value = $this->login->cek_login($username, md5($password))->row_array();
      $row = $result->row();
      if ($row) {
        $data = array(
          'login' => TRUE,
          'username' => $value["username"],
          'userid' => $value["userid"],
          'fullname' => $value["name"]
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
      }
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }
}
