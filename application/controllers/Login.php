<?php
class Login extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('SystemAuth', 'auth');
    $this->load->model('Userlog');
    $this->load->helper('date');
  }

  public function index()
  {
    if ($this->session->userdata('username')) {
      redirect(base_url('home'));
    } else {
      $this->session->sess_destroy();
      $this->load->view('template/_login');
    }
  }

  public function ceklogin()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $result = $this->auth->findUser($username);
    if ($result) {
      if (password_verify($password, $result['userpassword'])) {
        $data = array(
          'login' => TRUE,
          'username' => $result["username"],
          'userid' => $result["userid"],
          'isactive' => true
        );
        $this->session->set_userdata($data);
        $this->CheckUserLog();
        echo 1;
      }
    } else {
      echo 0;
    }
  }

  public function CheckUserLog()
  {
    $id = $this->session->userdata['userid'];
    $cek = $this->Userlog->CheckUserLog($id);
    $getloc = json_decode(file_get_contents("http://ipinfo.io/"));

    if ($cek) {
      $data = array(
        'userid' => $id,
        'firstlogin' =>  $cek['firstlogin'],
        'lastlogin' =>   date('Y-m-d H:i:s'),
        'lastactive' =>  date('Y-m-d H:i:s'),
        'activeduration' => timespan(date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 3),
        'lastlocation' =>  $getloc->city,
        'lastpasswordchange' => $cek['lastpasswordchange']
      );
      $this->db->where('userid', $id);
      $this->Userlog->updatedata($data);
    } else {
      $data = array(
        'userid' => $id,
        'firstlogin' => date('Y-m-d H:i:s'),
        'lastlogin' => date('Y-m-d H:i:s'),
        'lastactive' => date('Y-m-d H:i:s'),
        'activeduration' => timespan(date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), 3),
        'lastlocation' => $getloc->city,
        'lastpasswordchange' => date('Y-m-d H:i:s')
      );
      $this->Userlog->insertdata($data);
    }
  }

  public function logout()
  {
    $id = $this->session->userdata('userid');
    $this->auth->logout($id);
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }
}
