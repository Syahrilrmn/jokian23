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
        // $this->data['user'] = $this->M_Admin->get_table("tbl_login WHERE level = 'Pengguna'");

        $this->data['title_web'] = 'Data Pengguna ';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('user/user_view', $this->data);
        $this->load->view('template/footer_view', $this->data);
    }
    public function laporan()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['user'] = $this->M_Admin->get_table("tbl_login WHERE level = 'Pengguna'");
        $this->data['title_web'] = 'Data Pengguna ';
        $this->load->view('header_view', $this->data);
        $this->load->view('sidebar_view', $this->data);
        $this->load->view('user/laporan_user', $this->data);
        $this->load->view('footer_view', $this->data);
    }
    public function cetak()
    {
        $this->data['title_web'] = 'Cetak Pengguna ';
        $this->data['user'] = $this->M_Admin->get_table("tbl_login WHERE level = 'Pengguna'");
        $this->load->view('user/user_print', $this->data);
    }
    public function tambah()
    {
        $this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['user'] = $this->M_Admin->get_table('tbl_login');

        $this->data['title_web'] = 'Tambah Pengguna ';
        $this->load->view('template/header_view', $this->data);
        $this->load->view('template/sidebar_view', $this->data);
        $this->load->view('user/tambah_view', $this->data);
        $this->load->view('template/footer_view', $this->data);
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
            echo '<script>alert("Pengguna TIDAK DITEMUKAN");window.location="' . base_url('pengguna') . '"</script>';
        }
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
        } elseif ($this->session->userdata('level') == 'Pengguna') {
            $this->data['idbo'] = $this->session->userdata('ses_id');
            $count = $this->M_Admin->CountTableId('tbl_login', 'id_login', $this->session->userdata('ses_id'));
            if ($count > 0) {
                $this->data['user'] = $this->M_Admin->get_tableid_edit('tbl_login', 'id_login', $this->session->userdata('ses_id'));
            } else {
                echo '<script>alert("Pengguna TIDAK DITEMUKAN");window.location="' . base_url('Pengguna') . '"</script>';
            }
        }
        $this->data['title_web'] = 'Print Kartu Pengguna ';
        $this->load->view('user/detail', $this->data);
    }
    public function add()
    {


        $user = htmlentities($this->input->post('user', TRUE));
        $pass = md5(htmlentities($this->input->post('pass', TRUE)));
        $jenkel = htmlentities($this->input->post('jenkel', TRUE));
        $alamat = htmlentities($this->input->post('alamat', TRUE));
        $email = $_POST['email'];
        $dd = $this->db->query("SELECT * FROM tbl_login WHERE user = '$user' OR email = '$email'");
        if ($dd->num_rows() > 0) {
            $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Gagal Update Pengguna : ' . $user . ' !, Username / Email Anda Sudah Terpakai</p>
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
                'user' => $user,
                'pass' => $pass,
                'email' => $_POST['email'],
                'foto' => $data1['upload_data']['file_name'],
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'tgl_bergabung' => date('Y-m-d')
            );
            $this->db->insert('tbl_login', $data);
            if ($this->db->affected_rows() > 0) {
                $status = 'Berhasil';
                $pesan = 'Data Pengguna Berhasil diTambahkan';
            } else {
                $status = 'Gagal';
                $pesan = 'Data Pengguna Gagal diTambahkan';
            }
            $this->session->set_flashdata('status', $status);
            $this->session->set_flashdata('pesan', $pesan);
            redirect(base_url('pengguna'));
        }
    }
    public function upd()
    {
        $user = htmlentities($this->input->post('user', TRUE));
        $pass = htmlentities($this->input->post('pass'));
        $jenkel = htmlentities($this->input->post('jenkel', TRUE));
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
            if ($this->input->post('pass') !== '') {
                $data = array(
                    'user' => $user,
                    'pass' => md5($pass),
                    'email' => $_POST['email'],
                    'jenkel' => $jenkel,
                    'alamat' => $alamat,
                );
                $this->M_Admin->update_table('tbl_login', 'id_login', $id_login, $data);
                if ($this->session->userdata('level') == 'Admin') {
                    if ($this->db->affected_rows() > 0) {
                        $status = 'Berhasil';
                        $pesan = 'Data pengguna Berhasil Di Update'  ;
                    } else {
                        $status = 'Gagal';
                        $pesan = 'Data pengguna Gagal Di Update';
                    }
                    $this->session->set_flashdata('status', $status);
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('pengguna'));
                } elseif ($this->session->userdata('level') == 'User') {

                    $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
					<p> Berhasil Update Pengguna: ' . $user . ' !</p>
					</div></div>');
                    redirect(base_url('pengguna/edit/' . $id_login));
                }
            } else {
                $data = array(
                    'user' => $user,
                    'pass' => md5($pass),
                    'email' => $_POST['email'],
                    'jenkel' => $jenkel,
                    'alamat' => $alamat,
                );
                $this->M_Admin->update_table('tbl_login', 'id_login', $id_login, $data);

                if ($this->session->userdata('level') == 'Admin') {
                    if ($this->db->affected_rows() > 0) {
                        $status = 'Berhasil';
                        $pesan = 'Data pengguna Berhasil Di Update';
                    } else {
                        $status = 'Gagal';
                        $pesan = 'Data pengguna Gagal Di Update';
                    }
                    $this->session->set_flashdata('status', $status);
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('pengguna'));
                } elseif ($this->session->userdata('level') == 'User') {

                    $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
					<p> Berhasil Update Pengguna : ' . $user . ' !</p>
					</div></div>');
                    redirect(base_url('pengguna/edit/' . $id_login));
                }
            }
        } else {
            $result1 = $this->upload->data();
            $result = array('foto' => $result1);
            $data1 = array('upload_data' => $this->upload->data());
            unlink('./assets_style/image/pengguna/' . $this->input->post('foto'));
            if ($this->input->post('pass') !== '') {
                $data = array(

                    'user' => $user,
                    'pass' => md5($pass),
                    'email' => $_POST['email'],
                    'jenkel' => $jenkel,
                    'alamat' => $alamat,
                    'foto' => $data1['upload_data']['file_name'],
                );
                $this->M_Admin->update_table('tbl_login', 'id_login', $id_login, $data);

                if ($this->session->userdata('level') == 'Admin') {
                    if ($this->db->affected_rows() > 0) {
                        $status = 'Berhasil';
                        $pesan = 'Data pengguna Berhasil Di Update' ;
                    } else {
                        $status = 'Gagal';
                        $pesan = 'Data pengguna Gagal Di Update';
                    }
                    $this->session->set_flashdata('status', $status);
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('pengguna'));
                } elseif ($this->session->userdata('level') == 'User') {

                    $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
					<p> Berhasil Update User : ' . $user . ' !</p>
					</div></div>');
                    redirect(base_url('pengguna/edit/' . $id_login));
                }
            } else {
                $data = array(
                    'user' => $user,
                    'pass' => md5($pass),
                    'email' => $_POST['email'],
                    'jenkel' => $jenkel,
                    'alamat' => $alamat,
                    'foto' => $data1['upload_data']['file_name'],
                );
                $this->M_Admin->update_table('tbl_login', 'id_login', $id_login, $data);

                if ($this->session->userdata('level') == 'Admin') {
                    if ($this->db->affected_rows() > 0) {
                        $status = 'Berhasil';
                        $pesan = 'Data pengguna Berhasil Di Update';
                    } else {
                        $status = 'Gagal';
                        $pesan = 'Data pengguna Gagal Di Update';
                    }
                    $this->session->set_flashdata('status', $status);
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('pengguna'));
                } elseif ($this->session->userdata('level') == 'User') {

                    $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
					<p> Berhasil Update Pengguna : ' . $user . ' !</p>
					</div></div>');
                    redirect(base_url('Pengguna/edit/' . $id_login));
                }
            }
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
        if ($this->db->affected_rows() > 0) {
            $status = 'Berhasil';
            $pesan = 'Data Pengguna Berhasil DiHapus';
        } else {
            $status = 'Gagal';
            $pesan = 'Data Pengguna Gagal DiHapus';
        }
        $this->session->set_flashdata('status', $status);
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('pengguna'));
    }
}
