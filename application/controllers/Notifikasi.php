<?php
class Notifikasi extends CI_Controller
{
    public function index()
    {
        $this->load->model('Pengumuman_Model');
        $data = $this->Pengumuman_Model->get_pengumuman_list();
        $this->data['title_web'] = 'Data Pengumuman';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('notifikasi/listPengumuman', ['data' => $data]);
        $this->load->view('template/footer_view', $this->data);
    }
    public function listPengumuman()
    {
        $this->load->model('Pengumuman_Model');

        // Konfigurasi paginasi
        $config = [
            'base_url' => site_url('notifikasi/listPengumuman'),
            'total_rows' => $this->Pengumuman_Model->get_total_records(), // Gantilah ini sesuai dengan model Anda
            'per_page' => 12,
            'uri_segment' => 3,
            // Konfigurasi lainnya sesuai kebutuhan Anda
            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',
            'first_link' => false,
            'last_link' => false,
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'prev_link' => '&laquo',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'next_link' => '&raquo',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><a class="page-link">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link'],
        ];

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = $this->Pengumuman_Model->get_pengumuman_list_for_users($config['per_page'], $this->uri->segment(3));
        $this->data['title_web'] = 'Data Pengumuman Tugas';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('notifikasi/listPengumumanForUsers', ['data' => $data]);
        $this->load->view('template/footer_view', $this->data);
    }



    public function create()
    {
        $this->data['title_web'] = 'Tambah Pengumuman';
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
        $this->load->model('Pengumuman_Model');
        if (isset($_POST['simpan'])) {
            $this->Pengumuman_Model->update_pengumuman($id);
            redirect('notifikasi');
        } else {
            $data = $this->Pengumuman_Model->get_pengumuman_by_id($id);
            $this->data['title_web'] = 'Edit Pengumuman';
            $this->load->view('template/header_view', $this->data);
            $this->load->view('template/sidebar_view');
            $this->load->view('notifikasi/editPengumuman', ['data' => $data]);
            $this->load->view('template/footer_view');
        }
    }

    public function delete($id)
    {

        $this->load->model('Pengumuman_Model');
        $this->Pengumuman_Model->delete_pengumuman($id);
        redirect('notifikasi');
    }
}
