<?php

defined('BASEPATH') or exit('No direct script access allowed');

use vendor\database\Datatables;

class MasterCountry extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('master/Master_Country', 'country');
        $this->load->library('pdf');
    }


    public function index()
    {

        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Master Country";

            $this->theme->panel("master/country/v_index", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function datatables()
    {
        $json = array();
        $datatables = new Datatables('Master_Country', 'QueryDatatable', 'columnSearch');
        $datatables->execute();

        foreach ($datatables->getData() as $key => $value) {

            $data = array();

            $btnEdit = "<a href='" . base_url("master/country/edit/$value->countryid") . "' class='btn btn-xs btn-primary' style='color: #fff;'><i class='fas fa-edit'></i></a>";
            $btnDelete = "<a href='" . base_url("master/country/delete/$value->countryid") . "' class='btn btn-xs btn-danger' style='color: #fff;' onclick=\"return confirm('Are you sure delete this data?')\"><i class='fas fa-trash'></i></a>";

            $data[] = $datatables->getNumber();
            $data[] = $value->countryname;
            // $data[] = $value->createdby;
            // $data[] = $value->createddate;
            //$data[] = $value->updatedby;
            // $data[] = $value->updateddate;
            //$data[] = $value->isactive;

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
            $data['page_heading'] = "Add Master Country";
            $data['form_type'] = "add";
            $data['row'] = $this->country->get_dataadd();
            $this->theme->panel("master/country/v_form", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    //  public function print()
    // {
    //     $data['country'] = $this->country->tampil_data('mscountry', true);
    //    $this->load->view('print_country', $data);
    //  }

    public function pdf()
    {
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL

        $pdf = new FPDF('L', 'mm', 'Letter');

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DAFTAR COUNTRY', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C');
        $pdf->Cell(45, 6, 'COUNTRY NAME', 1, 0, 'C');
        $pdf->Cell(45, 6, 'CREATEDBY', 1, 0, 'C');
        $pdf->Cell(45, 6, 'CREATEDDATE', 1, 0, 'C');
        $pdf->Cell(45, 6, 'UPDATEDBY', 1, 0, 'C');
        $pdf->Cell(45, 6, 'UPDATEDDATE', 1, 0, 'C');
        $pdf->Cell(25, 6, 'ISACTIVE', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $country = $data['country'] = $this->country->tampil_data('mscountry', true);
        $no = 0;
        foreach ($country->result() as $ctr) {
            $no++;
            $pdf->Cell(10, 6, $no, 1, 0, 'C');
            $pdf->Cell(45, 6, $ctr->countryname, 1, 0, 'C');
            $pdf->Cell(45, 6, $ctr->createdby, 1, 0, 'C');
            $pdf->Cell(45, 6, $ctr->createddate, 1, 0, 'C');
            $pdf->Cell(45, 6, $ctr->updatedby, 1, 0, 'C');
            $pdf->Cell(45, 6, $ctr->updateddate, 1, 0, 'C');
            $pdf->Cell(25, 6, $ctr->isactive, 1, 1, 'C');
        }
        $pdf->Output();
    }


    public function insertData()
    {
        $this->db->trans_begin();
        $insert['countryname'] = $this->input->post('countryname');
        $insert['createdby'] = $this->session->userdata('userid');
        $insert['createddate'] = $this->input->post('createddate');
        $insert['updatedby'] = $this->session->userdata('userid');
        $insert['updateddate'] = $this->input->post('updateddate');
        $insert['isactive'] = 't';

        $this->country->Insert($insert);
        $data = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data["result"] = '0';
            $data["message"] = 'Insert Data Failed! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/add', 'master/country'));
        } else {
            $this->db->trans_commit();
            $data["result"] = '1';
            $data["message"] = 'Insert Data Success!';
            $data["redirect"] = base_url('master/country');
        }

        echo json_encode($data);
    }

    public function edit($id)
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Edit Master Country";
            $data['form_type'] = "edit";
            $data['row'] = $this->country->get_data($id);
            $this->theme->panel("master/country/v_form", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function updateData($id)
    {
        $this->db->trans_begin();
        $update['countryname'] = $this->input->post('countryname');
        // $update['createdby'] = $this->session->userdata('userid');
        // $update['createddate'] = $this->input->post('createddate');
        $update['updatedby'] = $this->session->userdata('userid');
        $update['updateddate'] = $this->input->post('updateddate');
        $update['isactive'] = $this->input->post('isactive');;

        $this->country->Update($update, $id);
        $data = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data["result"] = '0';
            $data["message"] = 'Update Data Failed! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/country', $id));
        } else {
            $this->db->trans_commit();
            $data["result"] = '1';
            $data["message"] = 'Update Data Success!';
            $data["redirect"] = base_url('master/country');
        }

        echo json_encode($data);
    }

    public function deleteData($id)
    {
        $this->db->trans_begin();
        $this->country->delete($id);
        $this->db->trans_commit();
        redirect("master/country", "refresh");
    }
}
