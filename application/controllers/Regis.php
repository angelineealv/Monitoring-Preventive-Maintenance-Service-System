<?php
class Regis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('SystemAuth', 'auth');
        $this->load->model('master/Master_User', 'user');
    }

    public function index()
    {
        if ($this->session->userdata('regis')) {
            redirect(base_url('login'));
        } else {
            $this->load->view('template/_regis');
        }
    }

    public function cekregis()
    {
        $username = $this->input->post('username');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        $result = $this->auth->findUser($username);
        if ($result) {
            $result = null;
            echo 2;
        } else if (strlen($password1) < 3) {
            echo 3;
        } else if (!preg_match('#[0-9]#', $password1) || !preg_match('#[a-zA-Z]#', $password1)) {
            echo 4;
        } else if ($password1 != $password2) {
            echo 5;
        } else {
            $newuser = [
                'username' => $this->input->post('username'),
                'userpassword' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'createdby' => 0,
                'createddate' => date('Y-m-d H:i:s'),
                'updatedby' => 0,
                'updateddate' => date('Y-m-d H:i:s'),
                'isactive' => true
            ];
            $this->user->Insert($newuser);
            $data = array(
                'regis' => TRUE
            );
            $this->session->set_userdata($data);
            echo 1;
        }
    }
}
