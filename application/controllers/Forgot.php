<?php
class Forgot extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('SystemAuth', 'auth');
        $this->load->model('master/Master_User', 'user');
        $this->load->model('master/Master_UserLog', 'userlog');
    }

    public function index()
    {
        if ($this->session->userdata('forgot')) {
            redirect(base_url('login'));
        } else {
            $this->load->view('template/_forgot');
        }
    }

    public function cekforgot()
    {
        $username = $this->input->post('username');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        $result = $this->auth->findUser($username);
        if (!$result) {
            echo 2;
        } else if (password_verify($password1, $result['userpassword'])) {
            echo 3;
        } else if (strlen($password1) < 3) {
            echo 4;
        } else if (!preg_match('#[0-9]#', $password1) || !preg_match('#[a-zA-Z]#', $password1)) {
            echo 5;
        } else if ($password1 != $password2) {
            echo 6;
        } else {
            $this->user->ChangePass($username, $password1);
            $user = $this->user->getDataByName($username);
            $this->userlog->ChangePassDate($user);
            $data = array(
                'forgot' => TRUE
            );
            $this->session->set_userdata($data);
            echo 1;
        }
    }
}
