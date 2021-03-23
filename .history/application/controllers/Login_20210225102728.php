<?php
class Login extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("SystemLogin", "login");
  }

  public function index()
  {
    if ($this->session->userdata('username')) {
      redirect(base_url('home'));
    } else {
      $this->load->view('template/_login');
    }
  }

  public function ceklogin()
  {
    $this->db->trans_begin();
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $result = $this->login->findUser($username, $password);

    if ($result->num_rows() > 0) {
      echo 0;
    } else {
      $value = $this->login->cek_login($username, $password)->row_array();
      $row = $result->row();
      if ($row) {
        $data = array(
          'login' => TRUE,
          'username' => $value["username"],
          'userid' => $value["userid"],
          'fullname' => $value["name"]
        );
        $this->session->set_userdata($data);
      }

      echo 1;
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }
}
