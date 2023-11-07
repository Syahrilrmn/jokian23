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
			$this->session->set_userdata('masuk', TRUE);
			$this->session->set_userdata('level', $hasil_login['level']);
			$this->session->set_userdata('ses_id', $hasil_login['id_login']);
			$this->session->set_userdata('last_activity', time()); // Set waktu login terakhir
			$this->session->set_userdata('anggota_id', $hasil_login['anggota_id']);

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
		// Create session
		$this->session->set_userdata('masuk', TRUE);
		$this->session->set_userdata('level', $hasil_login['level']);
		$this->session->set_userdata('ses_id', $hasil_login['id_login']);
		$this->session->set_userdata('last_activity', time()); // Set waktu login terakhir
		$this->session->set_userdata('anggota_id', $hasil_login['anggota_id']);

		$anggota_id = htmlentities($this->input->post('anggota_id', TRUE));
		$tanggal_lahir = htmlentities($this->input->post('tanggal_lahir', TRUE));
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
				'anggota_id' => $anggota_id,
				'tanggal_lahir' => $tanggal_lahir,
				'user' => $user,
				'pass' => $pass,
				'email' => $_POST['email'],
				'foto' => $data1['upload_data']['file_name'],
				'jenkel' => $jenkel,
				'alamat' => $alamat,
				'tgl_bergabung' => date('Y-m-d')
			);
			$result = $this->db->insert('tbl_login', $data);

			if ($result) {
				$response = [
					'status' => 'success',
					'message' => 'Registration Successful! Please login.'
				];
			} else {
				$response = [
					'status' => 'error',
					'message' => 'Registration Failed! Please try again.'
				];
			}

			echo json_encode($response);
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
