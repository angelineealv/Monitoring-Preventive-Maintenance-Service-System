<?php

defined('BASEPATH') or exit('No direct script access allowed');

use vendor\database\Datatables;

class MasterCustomer extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('master/Master_Customer', 'cust');
        $this->load->model('master/Master_User', 'user');
        include_once APPPATH . '/third_party/fpdf/fpdf.php';
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            $data['page_heading'] = "Master Customer";

            $this->theme->panel("master/customer/v_indexcust", $data);
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
            $data[] = $value->typename;
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
            $data['page_heading'] = "Add Master customer";
            $data['form_type'] = "add";
            $this->theme->panel("master/customer/v_formcust", $data);
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

        $pro = $this->db->get_where('msprovince', ['provinceid' => $this->input->post('province')])->row_array();
        $insert['customerprovinceid'] = $pro["provinceid"];

        $cit = $this->db->get_where('mscity', ['cityid' => $this->input->post('city')])->row_array();
        $insert['customercityid'] = $cit['cityid'];

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


        $this->cust->Insert($insert);
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
            $result = $this->db->get_where('mscustomer', ['customerid' => $id])->row_array();
            $data['page_heading'] = "Edit Master customer";
            $data['form_type'] = "edit";
            $data['row'] = $this->cust->get_data($id);
            $data['cityname'] = $this->cust->Cityname($result['customercityid']);
            $data['provname'] = $this->cust->Provname($result['customerprovinceid']);
            $data['create'] = $this->user->get_name($id);
            $this->theme->panel("master/customer/v_formcust", $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function getProvince()
    {

        $searchTerm = $this->input->post('searchTerm');

        $response = $this->cust->getProvince($searchTerm);

        echo json_encode($response);
    }

    public function getCity()
    {

        $searchTerm = $this->input->post('searchTerm');

        $response = $this->cust->getCity($searchTerm);

        echo json_encode($response);
    }

    public function updateData($id)
    {
        $this->db->trans_begin();

        $hd = $this->cust->get_data($id);

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
        // $update['createdby'] = $this->input->post('createdby');
        //    $update['createddate'] = $this->input->post('createddate');
        $update['updatedby'] = $this->session->userdata('userid');
        $update['updateddate'] = date('Y-m-d H:i:s');
        if ($this->input->post('isactive') == 't') {
            $update['isactive'] = true;
        } else {
            $update['isactive'] = false;
        }
        $this->cust->Update($update, $id);
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
        $this->cust->delete($id);
        $this->db->trans_commit();
        redirect("master/customer", "refresh");
    }

    public function print()
    {
        $data['cust'] = $this->cust->tampil_data('mscustomer')->result();
        $this->load->view('master/customer/print_customer', $data);
    }

    /**  public function pdf()

    {
        $this->load->library('dompdf_gen');
        $data['cust'] = $this->cust->tampil_data('mscustomer')->result();
        $this->load->view('master/customer/laporan_cust_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_customer.pdf', array('Attachment' => 0));
        $this->dompdf->set_option('enable_html5_parser', TRUE);
    }
     */

    public function pdf()
    {
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL

        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'DAFTAR CUSTOMER', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(15, 6, 'No', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Customer Name', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Prefix ', 1, 0, 'C');
        $pdf->Cell(25, 6, 'Phone By', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Address ', 1, 0, 'C');
        $pdf->Cell(35, 6, 'Email ', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Type ', 1, 0, 'C');
        //$pdf->Cell(30, 6, 'Province', 1, 0, 'C');
        $pdf->Cell(20, 6, 'City ', 1, 0, 'C');
        $pdf->Cell(15, 6, 'Subdis ', 1, 0, 'C');
        $pdf->Cell(10, 6, 'UV ', 1, 0, 'C');
        $pdf->Cell(22, 6, 'Postal Code', 1, 0, 'C');
        /*$pdf->Cell(20, 6, 'Latitude', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Longtitude ', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Created By', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Created Date', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Update By', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Update Date', 1, 0, 'C');*/
        $pdf->Cell(15, 6, 'Active', 1, 1, 'C');


        $pdf->SetFont('Arial', '', 10);
        $cust = $data['cust'] = $this->cust->tampil_data('mscustomer', true);
        $no = 0;
        foreach ($cust->result() as $data) {

            $no++;
            $pdf->Cell(15, 6, $no, 1, 0, 'C');
            $pdf->Cell(30, 6, $data->customername, 1, 0, 'C');
            $pdf->Cell(20, 6, $data->customerprefix, 1, 0, 'C');
            $pdf->Cell(25, 6, $data->customerphone, 1, 0, 'C');
            $pdf->Cell(30, 6, $data->customeraddress, 1, 0, 'C');
            $pdf->Cell(35, 6, $data->customeremail, 1, 0, 'C');

            $pdf->Cell(20, 6, $data->typename, 1, 0, 'C');
            //$pdf->Cell(30, 6, $data->provincename, 1, 0);
            $pdf->Cell(20, 6, $data->cityname, 1, 0, 'C');
            $pdf->Cell(15, 6, $data->customersubdisid, 1, 0, 'C');
            $pdf->Cell(10, 6, $data->customeruvid, 1, 0, 'C');
            $pdf->Cell(22, 6, $data->customerpostalcode, 1, 0, 'C');
            /*$pdf->Cell(10, 6, $data->customerlatitude, 1, 0);
            $pdf->Cell(10, 6, $data->customerlongtitude, 1, 0);
            $pdf->Cell(10, 6, $data->createdby, 1, 0);
            $pdf->Cell(10, 6, $data->createddate, 1, 0);
            $pdf->Cell(10, 6, $data->updatedby, 1, 0);
            $pdf->Cell(10, 6, $data->updateddate, 1, 0);*/
            $pdf->Cell(15, 6, $data->isactive, 1, 1, 'C');
        }

        $pdf->Output();
    }
}
