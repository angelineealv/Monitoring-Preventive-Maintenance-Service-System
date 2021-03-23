<?php

defined('BASEPATH') or exit('No direct script access allowed');

use vendor\database\Datatables;

class MasterCity extends CI_Controller
{

    function __construct()
    {
        include_once APPPATH . '/third_party/fpdf/fpdf.php';
        parent::__construct();
        $this->load->model('master/Master_City', 'city');
        $this->load->model('master/Master_Customer', 'cust');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Master City";

            $this->theme->panel("master/city/v_indexCity", $data);
        } else {
            redirect(base_url('login'));
        }
    }


    public function datatables()
    {
        $json = array();
        $datatables = new Datatables('Master_City', 'QueryDatatable', 'columnSearch');
        $datatables->execute();
        $username = $this->input->post('username');
        $user = $this->db->get_where('msuser', ['username' => $username])->row_array();

        foreach ($datatables->getData() as $key => $value) {

            $data = array();

            $btnEdit = "<a href='" . base_url("master/city/edit/$value->cityid") . "' class='btn btn-xs btn-primary' style='color: #fff;'><i class='fas fa-edit'></i></a>";
            $btnDelete = "<a href='" . base_url("master/city/delete/$value->cityid") . "' class='btn btn-xs btn-danger' style='color: #fff;' onclick=\"return confirm('Are you sure delete this data?')\"><i class='fas fa-trash'></i></a>";

            $data[] = $datatables->getNumber();
            $data[] = $value->cityname;
            $data[] = $value->provincename;
            //  $data[] = $this->session->userdata('username');
            // $data[] = $value->create;
            // $data[] = $value->createddate;
            //  $data[] = $this->session->userdata('username');
            //$data[] = $value->update;
            // $data[] = $value->updateddate;
            //  $data[] = $value->isactive;
            $data[] = $btnEdit . "    " . $btnDelete;
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
            $data['page_heading'] = "Add Master city";
            $data['form_type'] = "add";
            $data['row'] = $this->city->get_dataadd();
            $this->theme->panel("master/city/v_formCity", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function insertData()
    {
        $this->db->trans_begin();
        $insert['cityname'] = $this->input->post('cityname');

        $pro = $this->db->get_where('msprovince', ['provinceid' => $this->input->post('provinceid')])->row_array();
        //$insert['provinceid'] = $pro["provinceid"];
        $insert['provinceid'] = $this->input->post('provinceid');
        $insert['createdby'] = $this->session->userdata('userid');
        //  $insert['createddate'] = date('Y-m-d H:i:s');
        $insert['createddate'] = date('Y-m-d h:i:s');
        $insert['updatedby'] = $this->session->userdata('userid');
        // $insert['updateddate'] = date('Y-m-d H:i:s');
        $insert['updateddate'] = date('Y-m-d h:i:s');
        // $insert['isactive'] = $this->input->post('isactive');
        $insert['isactive'] = true;

        $this->city->Insert($insert);
        $data = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data["result"] = '0';
            $data["message"] = 'Insert Data Failed! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/add', 'master/city'));
        } else {
            $this->db->trans_commit();
            $data["result"] = '1';
            $data["message"] = 'Insert Data Success!';
            $data["redirect"] = base_url('master/city');
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Edit Master city";
            $data['form_type'] = "edit";

            $result = $this->city->get_data($id);
            $data['row'] = $result;
            //$data['provname'] = $this->cust->Provname($result->provinceid);
            $this->theme->panel("master/city/v_formCity", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function updateData($id)
    {
        $this->db->trans_begin();

        $hd = $this->city->get_data($id);
        $update['cityname'] = $this->input->post('cityname');
        $update['provinceid'] = $this->input->post('provinceid');
        /**  $update['createdby'] = $this->input->post('createdby');
        $update['createddate'] = $this->input->post('createddate');
         */
        $update['updatedby'] = $this->session->userdata('userid');
        $update['updateddate'] = date('Y-m-d h:i:s');
        // $update['isactive'] = $this->input->post('isactive');
        if ($this->input->post('isactive') == 't') {
            $update['isactive'] = true;
        } else {
            $update['isactive'] = false;
        }

        $this->city->Update($update, $id);
        $data = array();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data["result"] = '0';
            $data["message"] = 'Update Data Failed! Please try again!';
            $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/city', $id));
        } else {
            $this->db->trans_commit();
            $data["result"] = '1';
            $data["message"] = 'Update Data Success!';
            $data["redirect"] = base_url(sprintf('%s/edit/%d', 'master/city', $id));
        }

        echo json_encode($data);
    }

    public function deleteData($id)
    {
        $this->db->trans_begin();
        $this->city->delete($id);
        $this->db->trans_commit();
        redirect("master/city", "refresh");
    }


    public function getProvince()
    {

        $searchTerm = $this->input->post('searchTerm');
        $response = $this->city->getProvince($searchTerm);
        echo json_encode($response);
    }

    public function print()
    {
        $data['city'] = $this->city->tampil_data('mscity')->result();
        $this->load->view('master/city/print_city', $data);
    }

    /**  public function pdf()

    {
        $this->load->library('dompdf_gen');
        $data['city'] = $this->city->tampil_data('mscity')->result();
        $this->load->view('master/city/laporan_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        // $this->dompdf = new DOMPDF();
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_city.pdf', array('Attachment' => 0));
        $this->dompdf->set_option('enable_html5_parser', TRUE);
    }*/

    public function pdf()
    {
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL

        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DAFTAR CITY', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, 'No', 1, 0, 'C');
        $pdf->Cell(35, 6, 'City Name', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Province ID', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Created By', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Created Date', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Update By', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Update Date', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Active', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $city = $data['city'] = $this->city->tampil_data('mscity', true);
        $no = 0;
        foreach ($city->result() as $data) {
            $no++;
            $pdf->Cell(20, 6, $no, 1, 0, 'C');
            $pdf->Cell(35, 6, $data->cityname, 1, 0, 'C');
            $pdf->Cell(35, 6, $data->provincename, 1, 0, 'C');
            $pdf->Cell(35, 6, $data->createdby, 1, 0, 'C');
            $pdf->Cell(35, 6, $data->createddate, 1, 0, 'C');
            $pdf->Cell(35, 6, $data->updatedby, 1, 0, 'C');
            $pdf->Cell(35, 6, $data->updateddate, 1, 0, 'C');
            $pdf->Cell(30, 6, $data->isactive, 1, 1, 'C');
        }
        $pdf->Output();
    }
}
