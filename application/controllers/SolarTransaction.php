<?php
class SolarTransaction extends CI_Controller
{
    public function index()
    {
        // TransactionController.php

        $data = [];
        $this->load->model('Solar_Transaction_Model');

        if ($this->input->post()) {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $data = $this->Solar_Transaction_Model->getDataByDateRange($start_date, $end_date);
        } else {
            $data = $this->Solar_Transaction_Model->get_solar_transaction_list();
        }

        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Data Transaksi Solar';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('transactionSolar/transaction_data', ['data' => $data]);
        $this->load->view('template/footer_view', $this->data);
    }





    public function store()
    {
        $this->load->model('Solar_Transaction_Model');
        $data = $this->Solar_Transaction_Model->storeSolar();
        echo json_encode($data);
    }

    public function edit($id)
    {
        $this->load->model('Solar_Transaction_Model');
        if (isset($_POST['simpan'])) {
            $this->Solar_Transaction_Model->update_solar($id);
            redirect('solar');
        } else {
            $data = $this->Solar_Transaction_Model->get_solar_by_id($id);
            $this->data['title_web'] = 'Edit Data Solar';
            $this->load->view('template/header_view', $this->data);
            $this->load->view('template/sidebar_view');
            $this->load->view('solar/editSolar', ['data' => $data]);
            $this->load->view('template/footer_view');
        }
    }

    public function delete($id)
    {
        $this->load->model('Solar_Transaction_Model');
        $this->Solar_Transaction_Model->delete_solar($id);
        redirect('solar');
    }
}
