<?php

defined('BASEPATH') or exit('No direct script access allowed');

use vendor\database\Datatables;

class MasterUser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('SystemAuth', 'auth');
        $this->load->model('master/Master_User', 'user');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Master User";

            $this->theme->panel("master/user/v_index", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function datatables()
    {
        $json = array();
        $datatables = new Datatables('Master_User', 'QueryDatatable', 'columnSearch');
        $datatables->execute();

        foreach ($datatables->getData() as $key => $value) {

            $data = array();

            $btnEdit = "<a href='" . base_url("master/user/edit/$value->userid") . "' class='btn btn-xs btn-primary' style='color: #fff;'><i class='fas fa-edit'></i></a>";
            $btnDelete = "<a href='" . base_url("master/user/delete/$value->userid") . "' class='btn btn-xs btn-danger' style='color: #fff;' onclick=\"return confirm('Are you sure delete this data?')\"><i class='fas fa-trash'></i></a>";

            $data[] = $datatables->getNumber();
            $data[] = $value->username;
            $data[] = $value->userpassword;
            $data[] = $value->isactive;
            $data[] = $btnEdit . " " . $btnDelete;

            $json[] = $data;
        }

        echo json_encode(array(
            'draw' => $datatables->draw,
            'data' => $json,
            'recordsTotal' => $datatables->getCountData(),
            'recordsFiltered' => $datatables->getCountFiltered()
        ));
    }

    public function add()
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Add Master User";
            $data['form_type'] = "add";
            $this->theme->panel("master/user/v_form", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function insertData()
    {
        $this->db->trans_begin();
        $insert['username'] = $this->input->post('username');
        $insert['userpassword'] = password_hash($this->input->post('userpassword'), PASSWORD_DEFAULT);
        $insert['createdby'] = $this->session->userdata('userid');
        $insert['createddate'] = date('Y-m-d H:i:s');
        $insert['updatedby'] = $this->session->userdata('userid');
        $insert['updateddate'] = date('Y-m-d H:i:s');
        $insert['isactive'] = 't';

        $result = $this->auth->findUser($this->input->post('username'));
        if ($result) {
            $data["result"] = '0';
            $data["message"] = 'Insert Data Failed! Username is taken! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/add', 'master/user'));
        } else {
            $this->user->Insert($insert);
            $data = array();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $data["result"] = '0';
                $data["message"] = 'Insert Data Failed! Please try again!';
                $data["redirect"] = base_url(sprintf('%s/add', 'master/user'));
            } else {
                $this->db->trans_commit();
                $data["result"] = '1';
                $data["message"] = 'Insert Data Success!';
                $data["redirect"] = base_url('master/user');
            }
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Edit Master User";
            $data['form_type'] = "edit";
            $data['row'] = $this->user->get_data($id);
            $this->theme->panel("master/user/v_form", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function updateData($id)
    {
        $this->db->trans_begin();

        $hd = $this->user->get_data($id);
        if ($this->input->post('userpassword') == "") {
            $pass = $hd->password;
        } else {
            $pass = password_hash($this->input->post('userpassword'), PASSWORD_DEFAULT);
        }
        $update['userpassword'] = $pass;
        $update['username'] = $this->input->post('username');


        $this->user->Update($update, $id);
        $data = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data["result"] = '0';
            $data["message"] = 'Update Data Failed! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/user', $id));
        } else {
            $this->db->trans_commit();
            $data["result"] = '1';
            $data["message"] = 'Update Data Success!';
            $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/user', $id));
        }

        echo json_encode($data);
    }

    public function deleteData($id)
    {
        $this->db->trans_begin();
        $this->user->delete($id);
        $this->db->trans_commit();
        redirect("master/user", "refresh");
    }
}
