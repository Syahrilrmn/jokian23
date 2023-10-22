<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->model('M_Admin');
	}

	public function index()
	{
		$data['title_web'] = 'Login | Sistem Informasi Perpustakaan';
		$this->load->view('login_view', $data);
	}

	public function register()
	{
		$data['title_web'] = 'Register | Sistem Informasi Perpustakaan';
		$this->load->view('register_view', $data);
	}

	public function auth()
	{
		// $this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['count_pengguna'] = $this->db->query("SELECT * FROM tbl_login")->num_rows();
		$email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
		$pass = htmlspecialchars($this->input->post('pass', TRUE), ENT_QUOTES);

		// Authenticate user
		$proses_login = $this->M_login->GET_LOGIN($email, md5($pass)); // assuming the password is stored as MD5 hash in the database
		$row = $proses_login->num_rows();

		if ($row > 0) {
			$hasil_login = $proses_login->row_array();
			$nama_pengguna = $hasil_login['user'];

			// Create session
			$this->session->set_userdata('masuk_perpus', TRUE);
			$this->session->set_userdata('ses_id', $hasil_login['id_login']);
			$this->session->set_userdata('last_activity', time()); // Set waktu login terakhir

			$d = $this->db->query("SELECT * FROM tbl_login WHERE id_login='" . $hasil_login['id_login'] . "'")->row();

			$response = [
                'status' => 'success',
                'message' => 'Login Berhasil!',
                'user' => $nama_pengguna
            ];
        } else {
            // Menggunakan SweetAlert2 untuk menampilkan pesan login gagal
            $response = [
                'status' => 'error',
                'message' => 'Login Gagal! Periksa Kembali Gmail dan Password Anda'
            ];
        }

        echo json_encode($response);
    
	}


	public function do_register()
	{
		$user = htmlspecialchars($this->input->post('user', TRUE), ENT_QUOTES);
		$pass = htmlspecialchars($this->input->post('pass', TRUE), ENT_QUOTES);
		$email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
		$nama = htmlspecialchars($this->input->post('nama', TRUE), ENT_QUOTES);

		// Check if user already exists
		$check_user = $this->M_login->cek_user($user);
		if ($check_user > 0) {
			echo '<script>alert("Username already exists!");
        window.location="' . base_url() . 'login/register";</script>';
			return;
		}

		// Generate a unique anggota_id
		$anggota_id = $this->M_Admin->generate_kode_pengguna();

		// Upload photo
		$nmfile = "user_" . time();
		$config['upload_path'] = './assets_style/image/pengguna/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['file_name'] = $nmfile;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			echo '<script>alert("Failed to upload photo! Please try again.");
        window.location="' . base_url() . 'login/register";</script>';
			return;
		}

		$photo_path = $this->upload->data('file_name');

		// Prepare data for new user
		$data = array(
			'anggota_id' => $anggota_id,
			'user' => $user,
			'pass' => md5($pass),
			// assuming the password will be stored as MD5 hash in the database
			'email' => $email,
			'nama' => $nama,
			'foto' => $photo_path,
			'tgl_bergabung' => date('Y-m-d')
		);

		// Insert new user
		$result = $this->M_login->insertTable('tbl_login', $data);

		if ($result) {
			echo '<script>alert("Registration successful! Please login.");
        window.location="' . base_url() . 'login";</script>';
		} else {
			echo '<script>alert("Registration failed! Please try again.");
        window.location="' . base_url() . 'login/register";</script>';
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		echo '<script>alert("Apakah Anda Yakin Untuk Keluar Aplikasi ?");
		window.location="' . base_url('login') . '";</script>';
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
				// Tentukan batas waktu tidak aktif (30 menit dalam detik)
				$inactive_time = 5 * 60;

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
}
