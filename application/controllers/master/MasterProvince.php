<?php

defined('BASEPATH') or exit('No direct script access allowed');

use vendor\database\Datatables;

class MasterProvince extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('master/Master_Province', 'province');
        $this->load->model('master/Master_Country', 'country');
        $this->load->library('pdf');
        // $data['getcountry'] = $this->province->get();
        // $this->load->view('v_form', $data);
    }



    public function index()
    {


        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Master Province";

            $this->theme->panel("master/province/v_index", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function datatables()
    {
        $json = array();
        $datatables = new Datatables('Master_Province', 'QueryDatatable', 'columnSearch');
        $datatables->execute();


        foreach ($datatables->getData() as $key => $value) {

            $data = array();

            $btnEdit = "<a href='" . base_url("master/province/edit/$value->provinceid") . "' class='btn btn-xs btn-primary' style='color: #fff;'><i class='fas fa-edit'></i></a>";
            $btnDelete = "<a href='" . base_url("master/province/delete/$value->provinceid") . "' class='btn btn-xs btn-danger' style='color: #fff;' onclick=\"return confirm('Are you sure delete this data?')\"><i class='fas fa-trash'></i></a>";

            $data[] = $datatables->getNumber();
            $data[] = $value->provincename;
            $data[] = $value->countryname;
            // $data[] = $value->createdby;
            // $data[] = $value->createddate;
            //  $data[] = $value->updatedby;
            // $data[] = $value->updateddate;
            //  $data[] = $value->isactive;
            $data[] = $btnEdit . " " . $btnDelete;

            $json[] = $data;
        };

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
            $data['page_heading'] = "Add Master Province";
            $data['form_type'] = "add";
            $data['getcountry'] = $this->province->get_id('mscountry', true);
            $data['row'] = $this->province->get_dataadd();
            $this->theme->panel("master/province/v_form", $data, true);
        } else {
            redirect(base_url('login'));
        }
    }

    //  public function print()
    //  {
    //     $data['province'] = $this->province->tampil_data('msprovince', true);
    //      $this->load->view('print_province', $data);
    //  }


    public function pdf()
    {
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL

        $pdf = new FPDF('L', 'mm', 'Letter');

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DAFTAR PROVINCE', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'NO', 1, 0, 'C');
        $pdf->Cell(38, 6, 'PROVINCE NAME', 1, 0, 'C');
        $pdf->Cell(38, 6, 'COUNTRY NAME', 1, 0, 'C');
        $pdf->Cell(38, 6, 'CREATEDBY', 1, 0, 'C');
        $pdf->Cell(38, 6, 'CREATEDDATE', 1, 0, 'C');
        $pdf->Cell(38, 6, 'UPDATEDBY', 1, 0, 'C');
        $pdf->Cell(38, 6, 'UPDATEDDATE', 1, 0, 'C');
        $pdf->Cell(25, 6, 'ISACTIVE', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $province = $data['province'] = $this->province->tampil_data('msprovince', true);
        $no = 0;
        foreach ($province->result() as $pvr) {
            $no++;
            $pdf->Cell(10, 6, $no, 1, 0, 'C');
            $pdf->Cell(38, 6, $pvr->provincename, 1, 0, 'C');
            $pdf->Cell(38, 6, $pvr->countryname, 1, 0, 'C');
            $pdf->Cell(38, 6, $pvr->createdby, 1, 0, 'C');
            $pdf->Cell(38, 6, $pvr->createddate, 1, 0, 'C');
            $pdf->Cell(38, 6, $pvr->updatedby, 1, 0, 'C');
            $pdf->Cell(38, 6, $pvr->updateddate, 1, 0, 'C');
            $pdf->Cell(25, 6, $pvr->isactive, 1, 1, 'C');
        }
        $pdf->Output();
    }



    public function insertData()
    {
        $this->db->trans_begin();
        $insert['provincename'] = $this->input->post('provincename');
        $insert['countryid'] = $this->input->post('countryid');
        $insert['createdby'] = $this->session->userdata('userid');
        $insert['createddate'] = $this->input->post('createddate');
        $insert['updatedby'] = $this->session->userdata('userid');
        $insert['updateddate'] = $this->input->post('updateddate');
        $insert['isactive'] = 't';

        $this->province->Insert($insert);
        $data = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data["result"] = '0';
            $data["message"] = 'Insert Data Failed! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/add', 'master/province'));
        } else {
            $this->db->trans_commit();
            $data["result"] = '1';
            $data["message"] = 'Insert Data Success!';
            $data["redirect"] = base_url('master/province');
        }

        echo json_encode($data);
    }

    public function edit($id)
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Edit Master Province";
            $data['form_type'] = "edit";
            $data['getcountry'] = $this->province->get_id('mscountry', true);
            $data['row'] = $this->province->get_data($id);

            $this->theme->panel("master/province/v_form", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function updateData($id)
    {
        $this->db->trans_begin();


        $update['provincename'] = $this->input->post('provincename');
        $update['countryid'] = $this->input->post('countryid');
        //$update['createdby'] = $this->input->post('createdby');
        //$update['createddate'] = $this->input->post('createddate');
        $update['updatedby'] = $this->input->post('updatedby');
        $update['updateddate'] = $this->input->post('updateddate');
        //$update['isactive'] = $this->input->post('isactive');
        if ($this->input->post('isactive') == 't') {
            $update['isactive'] = true;
        } else {
            $update['isactive'] = false;
        }

        $this->province->Update($update, $id);
        $data = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data["result"] = '0';
            $data["message"] = 'Update Data Failed! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/province', $id));
        } else {
            $this->db->trans_commit();
            $data["result"] = '1';
            $data["message"] = 'Update Data Success!';
            $data["redirect"] = base_url('master/province');
        }

        echo json_encode($data);
    }

    public function getcountry()
    {

        $searchTerm = $this->input->post('searchTerm');

        $response = $this->province->getcountry($searchTerm);

        echo json_encode($response);
    }


    public function deleteData($id)
    {
        $this->db->trans_begin();
        $this->province->delete($id);
        $this->db->trans_commit();
        redirect("master/province", "refresh");
    }
}
