<?php
class SolarTransaction extends CI_Controller
{
    public function index()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
		$this->load->model('Solar_Transaction_Model');
        $data = $this->Solar_Transaction_Model->get_solar_list();
        $this->data['title_web'] = 'Data Solar';
        $this->load->view('template/header_view',$this->data);
        $this->load->view('template/sidebar_view',$this->data);
        $this->load->view('transactionSolar/transaction_data',['data' => $data]);
        $this->load->view('template/footer_view',$this->data);
    }


    public function create()
    {
        $this->load->model('Solar_Transaction_Model');
        $this->data['title_web'] = 'Tambah Data Solar';
        $this->load->view('template/header_view',$this->data);
        $this->load->view('template/sidebar_view',$this->data);
        $this->load->view('transcationSolar/transaction_store');
        $this->load->view('template/footer_view',$this->data);   
    }


	public function store()
	{
        $this->load->model('Solar_Transaction_Model');
		$data  = $this->Solar_Transaction_Model->storeSolar();
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
            $this->load->view('template/header_view',$this->data);
			$this->load->view('template/sidebar_view');
			$this->load->view('solar/editSolar',['data'=>$data]);
			$this->load->view('template/footer_view');  
        }
    }

    public function delete($id){
        $this->load->model('Solar_Transaction_Model');
        $this->Solar_Transaction_Model->delete_solar($id);
        redirect('solar');
    }
}
