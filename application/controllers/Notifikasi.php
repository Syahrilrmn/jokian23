<?php
class Notifikasi extends CI_Controller
{
    public function index()
    {
		$this->load->model('Pengumuman_Model');
        $data = $this->Pengumuman_Model->get_pengumuman_list();
        $this->data['title_web'] = 'Data Pengumuman';
        $this->load->view('template/header_view',$this->data);
        $this->load->view('template/sidebar_view',$this->data);
        $this->load->view('notifikasi/listPengumuman',['data' => $data]);
        $this->load->view('template/footer_view',$this->data);
    }


    public function create()
    {
        $this->data['title_web'] = 'Data Solar';
        $this->load->view('template/header_view');
        $this->load->view('template/sidebar_view');
        $this->load->view('notifikasi/createPengumuman');
        $this->load->view('template/footer_view');   
    }


	public function store()
	{
        $this->load->model('Pengumuman_Model');
		$this->Pengumuman_Model->storePengumuman();
		redirect('Notifikasi');
		
	}

    public function edit($id)
    {
        $title = "SIMTAWA UNISKA | Tambah Kategori Prestasi ";
        $this->load->model('Pengumuman_Model');
        if (isset($_POST['simpan'])) {
            $this->Pengumuman_Model->update_pengumuman($id);
            redirect('solar');
        } else {
            $data = $this->Pengumuman_Model->get_pengumuman_by_id($id);
            $title = "SIMTAWA UNISKA |"." Ubah ";
			$this->load->view('template/header_view');
			$this->load->view('template/sidebar_view');
			$this->load->view('notifikasi/editPengumuman',['data'=>$data]);
			$this->load->view('template/footer_view');  
        }
    }

    public function delete($id){
       
        $this->load->model('Pengumuman_Model');
        $this->Pengumuman_Model->delete_solar($id);
        redirect('solar');
    }
}
