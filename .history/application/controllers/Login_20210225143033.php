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
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $result = $this->login->findUser($username, md5($password));

    if ($result->num_rows() > 0) {
      $row = $result->row();
      if ($row) {
        $value = $this->login->findUser($username, md5($password))->row_array();

        $data = array(
          'login' => TRUE,
          'username' => $value["username"],
          'userid' => $value["userid"],
          'fullname' => $value["name"]
        );
        $this->session->set_userdata($data);
      }

      echo 1;
    } else {
      echo 0;
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }
}
