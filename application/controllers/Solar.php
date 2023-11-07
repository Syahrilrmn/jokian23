<?php
class Solar extends CI_Controller
{
    public function index()
    {
        $role = $this->session->userdata('level');
        if ($role != 'Admin') {
            redirect('Dashboard'); 
        }
    
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->load->model('Solar_Model');
        $data = $this->Solar_Model->get_solar_list();
        $this->data['title_web'] = 'Data Solar';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('solar/listSolar', ['data' => $data]);
        $this->load->view('template/footer_view', $this->data);
    }
    


    public function create()
    {
        $role = $this->session->userdata('level');
        if ($role != 'Admin') {
            redirect('Dashboard'); 
        }
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->load->model('Solar_Model');
        $this->data['title_web'] = 'Tambah Data Solar';
        $this->load->view('template/header_view',$this->data);
        $this->load->view('template/sidebar_view',$this->data);
        $this->load->view('solar/createSolar');
        $this->load->view('template/footer_view',$this->data);   
    }


	public function store()
	{
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->load->model('Solar_Model');
		$this->Solar_Model->storeSolar();
		redirect('Solar');
		
	}

    public function edit($id)
    {
        var_dump($this->session->userdata);
        $role = $this->session->userdata('level');
        if ($role != 'Admin') {
            redirect('Dashboard'); 
        }
        $this->load->model('Solar_Model');
        if (isset($_POST['simpan'])) {
            $this->Solar_Model->update_solar($id);
            redirect('solar');
        } else {
            $this->data['idbo'] = $this->session->userdata('ses_id');
            $data = $this->Solar_Model->get_solar_by_id($id);
            $this->data['title_web'] = 'Edit Data Solar';
            $this->load->view('template/header_view',$this->data);
			$this->load->view('template/sidebar_view');
			$this->load->view('solar/editSolar',['data'=>$data]);
			$this->load->view('template/footer_view');  
        }
    }

    public function delete($id){
        
        $this->load->model('Solar_Model');
        $this->Solar_Model->delete_solar($id);
        redirect('solar');
    }
}
