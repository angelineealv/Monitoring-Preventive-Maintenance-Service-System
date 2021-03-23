<?php

defined('BASEPATH') or exit('No direct script access allowed');

use vendor\database\Datatables;

class MasterCustomer extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('master/Master_Customer', 'user');
  }

  public function index()
  {
    if ($this->session->userdata('username')) {
      $data['page_heading'] = "Master Costumer";

      $this->theme->panel("master/user/v_index", $data);
    } else {
      redirect(base_url('login'));
    }
  }

  public function datatables()
  {
    $json = array();
    $datatables = new Datatables('Master_Customer', 'QueryDatatable', 'columnSearch');
    $datatables->execute();

    foreach ($datatables->getData() as $key => $value) {

      $data = array();

      $btnEdit = "<a href='" . base_url("master/customer/edit/$value->customerid") . "' class='btn btn-xs btn-primary' style='color: #fff;'><i class='fas fa-edit'></i></a>";
      $btnDelete = "<a href='" . base_url("master/customer/delete/$value->customerid") . "' class='btn btn-xs btn-danger' style='color: #fff;' onclick=\"return confirm('Are you sure delete this data?')\"><i class='fas fa-trash'></i></a>";

      $data[] = $datatables->getNumber();
      $data[] = $value->customername;
      $data[] = $value->customerphone;
      $data[] = $value->customeraddress;
      $data[] = $value->customeremail;
      $data[] = $value->customertypeid;
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
      $data['page_heading'] = "Add Master Costumer";
      $data['form_type'] = "add";
      $this->theme->panel("master/user/v_form", $data);
    } else {
      redirect(base_url('login'));
    }
  }

  public function insertData()
  {
    $this->db->trans_begin();
    $insert['customername'] = $this->input->post('fullname');
    $insert['customerprefix'] = $this->input->post('prefix');
    $insert['customerphone'] = $this->input->post('phone');
    $insert['customeraddress'] = $this->input->post('address');
    $insert['customeremail'] = $this->input->post('email');
    $insert['customertypeid'] = $this->input->post('type');
    $insert['customerprovinceid'] = $this->input->post('province');
    $insert['customercityid'] = $this->input->post('city');
    $insert['customersubdisid'] = $this->input->post('subdis');
    $insert['customeruvid'] = $this->input->post('uv');
    $insert['customerpostalcode'] = $this->input->post('postal');
    $insert['customerlatitude'] = $this->input->post('latitude');
    $insert['customerlongtitude'] = $this->input->post('longtitude');
    $insert['createdby'] = $this->session->userdata('userid');
    $insert['createddate'] = date('Y-m-d H:i:s');
    $insert['updatedby'] = $this->session->userdata('userid');
    $insert['updateddate'] = date('Y-m-d H:i:s');
    $insert['isactive'] = true;

    $this->user->Insert($insert);
    $data = array();
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $data["result"] = '0';
      $data["message"] = 'Insert Data Failed! Please try again!';
      $data["redirect"] = base_url(sprintf('%s/add', 'master/costumer'));
    } else {
      $this->db->trans_commit();
      $data["result"] = '1';
      $data["message"] = 'Insert Data Success!';
      $data["redirect"] = base_url('master/customer');
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

    $update['customername'] = $this->input->post('fullname');
    $update['customerprefix'] = $this->input->post('prefix');
    $update['customerphone'] = $this->input->post('phone');
    $update['customeraddress'] = $this->input->post('address');
    $update['customeremail'] = $this->input->post('email');
    $update['customertypeid'] = $this->input->post('type');
    $update['customerprovinceid'] = $this->input->post('province');
    $update['customercityid'] = $this->input->post('city');
    $update['customersubdisid'] = $this->input->post('subdis');
    $update['customeruvid'] = $this->input->post('uv');
    $update['customerpostalcode'] = $this->input->post('postal');
    $update['customerlatitude'] = $this->input->post('latitude');
    $update['customerlongtitude'] = $this->input->post('longtitude');
    $update['createdby'] = $this->session->userdata('userid');
    $update['createddate'] = date('Y-m-d H:i:s');
    $update['updatedby'] = $this->session->userdata('userid');
    $update['updateddate'] = date('Y-m-d H:i:s');
    $update['isactive'] = true;

    $this->user->Update($update, $id);
    $data = array();
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $data["result"] = '0';
      $data["message"] = 'Update Data Failed! Please try again!';
      $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/customer', $id));
    } else {
      $this->db->trans_commit();
      $data["result"] = '1';
      $data["message"] = 'Update Data Success!';
      $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/customer', $id));
    }

    echo json_encode($data);
  }

  public function deleteData($id)
  {
    $this->db->trans_begin();
    $this->user->delete($id);
    $this->db->trans_commit();
    redirect("master/customer", "refresh");
  }
}
