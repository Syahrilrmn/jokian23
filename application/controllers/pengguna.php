<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //validasi jika user belum login
        $this->data['CI'] = &get_instance();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_Admin');
        //  	if($this->session->userdata('masuk_perpus') != TRUE){
        // 		$url=base_url('eror');
        // 		redirect($url);
        // 	}
        $this->load->library('pdf');
    }

    public function index()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['user'] = $this->M_Admin->get_table('tbl_login');
        // $this->data['user'] = $this->M_Admin->get_table("tbl_login WHERE level = 'Anggota'");

        $this->data['title_web'] = 'Data Anggota ';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('user/user_view', $this->data);
        $this->load->view('template/footer_view', $this->data);
    }
    public function laporan()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['user'] = $this->M_Admin->get_table("tbl_login WHERE level = 'Anggota'");
        $this->data['title_web'] = 'Data Anggota ';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('user/laporan_user', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    public function cetak()
    {
        $this->data['user'] = $this->M_Admin->get_table("tbl_login WHERE level = 'Anggota'");
        $this->load->view('user/user_print', $this->data);
    }
    public function tambah()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['user'] = $this->M_Admin->get_table('tbl_login');

        $this->data['title_web'] = 'Tambah Anggota ';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('user/tambah_view', $this->data);
        $this->load->view('template/footer_view', $this->data);
    }

    public function add()
    {


        $user = htmlentities($this->input->post('user', TRUE));
        $pass = md5(htmlentities($this->input->post('pass', TRUE)));
        $jenkel = htmlentities($this->input->post('jenkel', TRUE));
        // $level = htmlentities($this->input->post('level',TRUE));
        // $telepon = htmlentities($this->input->post('telepon',TRUE));
        // $status = htmlentities($this->input->post('status',TRUE));
        $alamat = htmlentities($this->input->post('alamat', TRUE));
        $email = $_POST['email'];

        $dd = $this->db->query("SELECT * FROM tbl_login WHERE user = '$user' OR email = '$email'");
        if ($dd->num_rows() > 0) {
            $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Gagal Update Anggota : ' . $user . ' !, Username / Email Anda Sudah Terpakai</p>
			</div></div>');
            redirect(base_url('pengguna/tambah'));
        } else {
            // setting konfigurasi upload
            $nmfile = "user_" . time();
            $config['upload_path'] = './assets/images/pengguna/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = $nmfile;
            // load library upload
            $this->load->library('upload', $config);
            // upload foto 1
            $this->upload->do_upload('foto');
            $result1 = $this->upload->data();
            $result = array('foto' => $result1);
            $data1 = array('upload_data' => $this->upload->data());
            $data = array(
                'anggota_id' => $this->M_Admin->generate_kode_pengguna(),

                'user' => $user,
                'pass' => $pass,
                // 'level'=>$level,
                // 'tempat_lahir'=>$_POST['lahir'],
                // 'tgl_lahir'=>$_POST['tgl_lahir'],
                // 'level'=>$level,
                'email' => $_POST['email'],
                // 'telepon'=>$telepon,
                'foto' => $data1['upload_data']['file_name'],
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'tgl_bergabung' => date('Y-m-d')
            );
            $this->db->insert('tbl_login', $data);

            $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
            <p> Daftar Anggota telah berhasil !</p>
            </div></div>');
            redirect(base_url('pengguna'));
        }
    }

    public function edit()
    {
        // if($this->session->userdata('level') == 'Petugas'){
        if ($this->uri->segment('3') == '') {
            echo '<script>alert("halaman tidak ditemukan");window.location="' . base_url('user') . '";</script>';
        }
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $count = $this->M_Admin->CountTableId('tbl_login', 'id_login', $this->uri->segment('3'));
        if ($count > 0) {
            $this->data['user'] = $this->M_Admin->get_tableid_edit('tbl_login', 'id_login', $this->uri->segment('3'));
        } else {
            echo '<script>alert("Anggota TIDAK DITEMUKAN");window.location="' . base_url('pengguna') . '"</script>';
        }

        // }elseif($this->session->userdata('level') == 'Anggota'){
        // 	$this->data['idbo'] = $this->session->userdata('ses_id');
        // 	$count = $this->M_Admin->CountTableId('tbl_login','id_login',$this->uri->segment('3'));
        // 	if($count > 0)
        // 	{			
        // 		$this->data['user'] = $this->M_Admin->get_tableid_edit('tbl_login','id_login',$this->session->userdata('ses_id'));
        // 	}else{
        // 		echo '<script>alert("Pengguna TIDAK DITEMUKAN");window.location="'.base_url('pengguna').'"</script>';
        // 	}
        // }
        $this->data['title_web'] = 'Edit Pengguna ';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('user/edit_view', $this->data);
        $this->load->view('template/footer_view', $this->data);
    }

    public function detail()
    {
        if ($this->session->userdata('level') == 'Petugas') {
            if ($this->uri->segment('3') == '') {
                echo '<script>alert("halaman tidak ditemukan");window.location="' . base_url('Pengguna') . '";</script>';
            }
            $this->data['idbo'] = $this->session->userdata('ses_id');
            $count = $this->M_Admin->CountTableId('tbl_login', 'id_login', $this->uri->segment('3'));
            if ($count > 0) {
                $this->data['user'] = $this->M_Admin->get_tableid_edit('tbl_login', 'id_login', $this->uri->segment('3'));
            } else {
                echo '<script>alert("Pengguna TIDAK DITEMUKAN");window.location="' . base_url('Pengguna') . '"</script>';
            }
        } elseif ($this->session->userdata('level') == 'Anggota') {
            $this->data['idbo'] = $this->session->userdata('ses_id');
            $count = $this->M_Admin->CountTableId('tbl_login', 'id_login', $this->session->userdata('ses_id'));
            if ($count > 0) {
                $this->data['user'] = $this->M_Admin->get_tableid_edit('tbl_login', 'id_login', $this->session->userdata('ses_id'));
            } else {
                echo '<script>alert("Pengguna TIDAK DITEMUKAN");window.location="' . base_url('Pengguna') . '"</script>';
            }
        }
        $this->data['title_web'] = 'Print Kartu Anggota ';
        $this->load->view('user/detail', $this->data);
    }

    public function upd()
    {
        // $nama = htmlentities($this->input->post('nama',TRUE));
        $user = htmlentities($this->input->post('user', TRUE));
        $pass = htmlentities($this->input->post('pass'));
        $jenkel = htmlentities($this->input->post('jenkel', TRUE));
        // $level = htmlentities($this->input->post('level',TRUE));
        // $telepon = htmlentities($this->input->post('telepon',TRUE));
        // $status = htmlentities($this->input->post('status',TRUE));
        $alamat = htmlentities($this->input->post('alamat', TRUE));
        $id_login = htmlentities($this->input->post('id_login', TRUE));

        // setting konfigurasi upload
        $nmfile = "user_" . time();
        $config['upload_path'] = './assets/images/pengguna/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = $nmfile;
        // load library upload
        $this->load->library('upload', $config);
        // upload foto 1


        if (!$this->upload->do_upload('foto')) {

            $data = array(

                // 'nama'=>$nama,
                'user' => $user,
                'pass' => md5($pass),
                // 'tempat_lahir'=>$_POST['lahir'],
                // 'tgl_lahir'=>$_POST['tgl_lahir'],
                // 'level'=>$level,
                'email' => $_POST['email'],
                // 'telepon'=>$telepon,
                'jenkel' => $jenkel,
                'alamat' => $alamat,
            );
            $this->M_Admin->update_table('tbl_login', 'id_login', $id_login, $data);


            $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
					<p> Berhasil Update Anggota: ' . $user . ' !</p>
					</div></div>');
            redirect(base_url('pengguna'));
        }
    }
    public function del()
    {
        if ($this->uri->segment('3') == '') {
            echo '<script>alert("halaman tidak ditemukan");window.location="' . base_url('pengguna') . '";</script>';
        }

        $user = $this->M_Admin->get_tableid_edit('tbl_login', 'id_login', $this->uri->segment('3'));
        unlink('./assets/images/pengguna/' . $user->foto);
        $this->M_Admin->delete_table('tbl_login', 'id_login', $this->uri->segment('3'));

        $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-danger">
		<p> Berhasil Hapus Anggota !</p>
		</div></div>');
        redirect(base_url('pengguna'));
    }
}
