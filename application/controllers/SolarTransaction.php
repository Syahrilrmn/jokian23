<?php
class SolarTransaction extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); 
        $this->data['CI'] = &get_instance();
        $this->load->helper(array('form', 'url'));
        if ($this->session->userdata('masuk') != true) {
            $url = base_url('login');
            redirect($url);
        }
    }
    public function index()
    {
        // TransactionController.php

        $data = [];
        $this->load->model('Solar_Transaction_Model');

        if ($this->input->get()) {
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
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
            $this->Solar_Transaction_Model->update_solar_transaction($id);
            redirect('SolarTransaction');
        } else {
            $this->data['count_solar'] = $this->db->query("SELECT jumlah_stok FROM solar")->row();
            $data = $this->Solar_Transaction_Model->get_solar_transaction_by_id($id);
            $this->data['title_web'] = 'Edit Data Transaksi Solar';
            $this->load->view('template/header_view', $this->data);
            $this->load->view('template/sidebar_view');
            $this->load->view('transactionSolar/transaction_edit', ['data' => $data]);
            $this->load->view('template/footer_view');
        }
    }

    


    public function print(){
        $data = [];
        $this->load->model('Solar_Transaction_Model');

        if ($this->input->get() && $this->input->get('start_date')) {
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $data = $this->Solar_Transaction_Model->getDataByDateRange($start_date, $end_date);
        } else {
            $data = $this->Solar_Transaction_Model->get_solar_transaction_list();
        }

        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['title_web'] = 'Data Transaksi Solar';
       
        $this->load->view('transactionSolar/transaction_print', ['data' => $data]);
        
    }
}
