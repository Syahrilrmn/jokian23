<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); 
        //validasi jika user belum login
        $this->data['CI'] = &get_instance();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_Admin');
        $this->load->model('Statistik');
        $this->load->model('M_login');
        // if ($this->session->userdata('masuk_perpus') != true) {
        //     $url = base_url('eror');
        //     redirect($url);
        // }

        // Memeriksa waktu tidak aktif
        $this->check_session();
    }

    // Fungsi untuk memeriksa sesi dan waktu login
    private function check_session()
    {
        // Periksa apakah pengguna sudah login
        if ($this->session->userdata('masuk_perpus')) {
            // Periksa apakah ada waktu login tersimpan dalam sesi
            if ($this->session->userdata('last_activity')) {
                // Ambil waktu login terakhir
                $last_activity = $this->session->userdata('last_activity');
                // Tentukan batas waktu tidak aktif (5 menit dalam detik)
                $inactive_time = 60 * 60;

                // Periksa apakah sudah melewati batas waktu tidak aktif
                if ((time() - $last_activity) > $inactive_time) {
                    // Jika melewati batas waktu, hapus sesi dan arahkan kembali ke halaman login
                    $this->session->unset_userdata('masuk_perpus');
                    $this->session->unset_userdata('level');
                    $this->session->unset_userdata('ses_id');
                    $this->session->unset_userdata('anggota_id');
                    $this->session->unset_userdata('last_activity');
                    redirect('login');
                } else {
                    // Jika masih dalam batas waktu tidak aktif, perbarui waktu login terakhir
                    $this->session->set_userdata('last_activity', time());
                }
            }
        }
    }

    public function index()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        // $visitor_data = $this->M_Admin->getVisitorStatistics();
        // $gender_data = $this->M_Admin->getGenderStatistics();

        // $this->data['visitor_data'] = $visitor_data;
        // $this->data['gender_data'] = $gender_data;

        // $userId = $this->session->userData('ses_id');
        // $this->data['title_web'] = 'Dashboard ';
        $this->data['count_pengguna'] = $this->db->query("SELECT * FROM tbl_login")->num_rows();
        $this->data['count_barang'] = $this->db->query("SELECT * FROM barang")->num_rows();
        $this->data['count_solar'] = $this->db->query("SELECT * FROM solar")->num_rows();
        $this->data['count_pinjam'] = $this->db->query("SELECT * FROM peminjamanbarang")->num_rows();
        // $this->data['count_pinjam'] = $this->db->query("SELECT * FROM tbl_pinjam WHERE status = 'Dipinjam'")->num_rows();
        // $this->data['count_kembali'] = $this->db->query("SELECT * FROM tbl_pinjam WHERE status = 'Di Kembalikan'")->num_rows();
        
       
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('template/dashboard_view', $this->data);
        $this->load->view('template/footer_view', $this->data);
        // $this->load->view('templatenew', $this->data);
    }

}
