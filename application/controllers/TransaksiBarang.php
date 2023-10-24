<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiBarang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		// $this->load->model('Transaksi_model');
		// $this->load->model('Statistik');
		$this->load->library(array('cart'));
		// if ($this->session->userdata('masuk_perpus') != TRUE) {
		// 	$url = base_url('eror');
		// 	redirect($url);
		// }
	}

	public function index()
	{
		$this->data['title_web'] = 'Data Pinjam Buku';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		// if ($this->session->userdata('level') == 'Anggota') {
		// 	$this->data['pinjam'] = $this->db->query(
		// 		"SELECT DISTINCT 
		// 		`tbl_pinjam`.`pinjam_id`, 
		// 		`tbl_login`.`nama`, 
		// 		`tbl_login`.`anggota_id`, 
		// 		`tbl_pinjam`.`status`, 
		// 		`tbl_pinjam`.`tgl_pinjam`, 
		// 		`tbl_pinjam`.`lama_pinjam`, 
		// 		`tbl_pinjam`.`tgl_balik`, 
		// 		`tbl_pinjam`.`tgl_kembali`, 
		// 		`tbl_pinjam`.`jml_pinjam`, 
		// 		`tbl_buku`.`id_kategori`,
		// 		`tbl_buku`.`title`,
		// 		`tbl_kategori`.`nama_kategori`
		// 		FROM `tbl_pinjam` 
		// 		JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id`
		// 		JOIN `tbl_buku` ON `tbl_pinjam`.`buku_id` = `tbl_buku`.`buku_id`
		// 		JOIN `tbl_kategori` ON `tbl_buku`.`id_kategori` = `tbl_kategori`.`id_kategori`
		// 		WHERE `tbl_pinjam`.`status` IN ('Booking', 'Dipinjam', 'Batal') AND `tbl_login`.`anggota_id` = ?
		// 		ORDER BY `tbl_pinjam`.`pinjam_id` ASC",
		// 		array($this->session->userdata('anggota_id'))
		// 	);
		// } else {

		// 	$this->data['pinjam'] = $this->db->query(
		// 		"SELECT DISTINCT 
		// 		`peminjamanbarang`.`ID_Peminjaman`, 
		// 		`tbl_login`.`user`,  
		// 		`tbl_login`.`anggota_id`,  
		// 		`peminjamanbarang`.`Tanggal_Peminjaman`,
		// 		`peminjamanbarang`.`Tanggal_Pengembalian`, 
		// 		`peminjamanbarang`.`Jumlah`,
		// 		`barang`.`ID_Barang`,
		// 		`barang`.`kode_barang`,
		// 		`barang`.`Nama_Barang`,
		// 		`barang`.`stok`
		// 		FROM `peminjamanbarang` 
		// 		JOIN `tbl_login` ON `peminjamanbarang`.`anggota_id` = `tbl_login`.`anggota_id`
		// 		JOIN `barang` ON `peminjamanbarang`.`ID_Barang` = `barang`.`ID_Barang`
		// 		-- WHERE `peminjamanbarang`.`status` = 'Dipinjam'
		// 		ORDER BY `peminjamanbarang`.`ID_Peminjaman` ASC"
		// 	);
		// }
		$query = $this->db->query(
			"
				SELECT DISTINCT 
				`peminjamanbarang`.`ID_Peminjaman`, 
				`tbl_login`.`user`,  
				`tbl_login`.`anggota_id`,  
				`peminjamanbarang`.`Tanggal_Peminjaman`,
				`peminjamanbarang`.`Tanggal_Pengembalian`, 
				`peminjamanbarang`.`Jumlah`,
				`barang`.`ID_Barang`,
				`barang`.`kode_barang`,
				`barang`.`Nama_Barang`,
				`barang`.`stok`
				FROM `peminjamanbarang` 
				JOIN `tbl_login` ON `peminjamanbarang`.`anggota_id` = `tbl_login`.`anggota_id`
				JOIN `barang` ON `peminjamanbarang`.`kode_barang` = `barang`.`kode_barang`
				ORDER BY `peminjamanbarang`.`ID_Peminjaman` ASC"
		);

		$this->data['pinjam'] = $query->result_array();




		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('pinjambarang/pinjam_view', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}
	public function pinjam()
	{

		$this->data['nop'] = $this->M_Admin->buat_kode('peminjamanbarang', 'PJ', 'ID_Peminjaman', 'ORDER BY ID_Peminjaman DESC LIMIT 1');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['databarang'] = $this->db->query("SELECT * FROM barang ORDER BY ID_Barang DESC")->result_array();

		$this->data['title_web'] = 'Tambah Pinjam Buku ';
		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('pinjambarang/tambah_view', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}
	public function edit()
	{
		$this->data['nop'] = $this->M_Admin->buat_kode('peminjamanbarang', 'PJ', 'ID_Peminjaman', 'ORDER BY ID_Peminjaman DESC LIMIT 1');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['databarang'] = $this->db->query("SELECT * FROM barang ORDER BY ID_Barang DESC")->result_array();

		$id_pinjam = $this->uri->segment('3');

		// Mengambil data pinjam buku berdasarkan id_pinjam
		$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id_pinjam);
		if ($count > 0) {
			$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `id_pinjam`,`pinjam_id`, 
				`anggota_id`, `status`,`buku_id`, 
				`tgl_pinjam`, `lama_pinjam`, 
				`tgl_balik`, `tgl_kembali`,`jml_pinjam` 
				FROM tbl_pinjam WHERE pinjam_id = '$id_pinjam'")->row();
		} else {
			// Jika data tidak ditemukan, maka tampilkan pesan error dan redirect ke halaman transaksi
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
		}

		// Set data untuk tampilan
		$this->data['sidebar'] = 'kembali';
		$this->data['title_web'] = 'Edit Pinjam Buku ';

		// Load tampilan view
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/edit_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function booking()
	{
		$this->data['title_web'] = 'Data Pinjam Buku ';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		if ($this->session->userdata('level') == 'Anggota') {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`,
				`tbl_buku`.`id_kategori`,
				`tbl_buku`.`title`,
				`tbl_kategori`.`nama_kategori`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				JOIN `tbl_buku` ON `tbl_pinjam`.`buku_id` = `tbl_buku`.`buku_id`
				JOIN `tbl_kategori` ON `tbl_buku`.`id_kategori` = `tbl_kategori`.`id_kategori`
				WHERE `tbl_pinjam`.`status` IN ('Booking', 'Batal') AND `tbl_login`.`anggota_id` = ?
				ORDER BY `tbl_pinjam`.`pinjam_id` ASC",
				array($this->session->userdata('anggota_id'))
			);
		} else {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`,
				`tbl_buku`.`id_kategori`,
				`tbl_buku`.`title`,
				`tbl_kategori`.`nama_kategori`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				JOIN `tbl_buku` ON `tbl_pinjam`.`buku_id` = `tbl_buku`.`buku_id`
				JOIN `tbl_kategori` ON `tbl_buku`.`id_kategori` = `tbl_kategori`.`id_kategori`
				WHERE `tbl_pinjam`.`status` IN ('Booking', 'Batal')
				ORDER BY `tbl_pinjam`.`pinjam_id` ASC"
			);
		}


		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/booking_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function ubahStatus($pinjam_id)
	{
		$this->load->model('Transaksi_model');
		$this->Transaksi_model->updateStatusPinjam($pinjam_id);
		$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">Berhasil Dipinjamkan !</div></div>');
		redirect('transaksi/index');
	}
	public function UpdateStatus($pinjam_id)
	{
		// Memanggil model untuk mengubah status
		$this->load->model('Transaksi_model');
		$this->Transaksi_model->updateStatus($pinjam_id, 'Batal');

		// Menyimpan pesan notifikasi dalam flash data
		$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">Status berhasil diubah menjadi Batal</div></div>');

		// Redirect ke halaman yang dituju
		redirect('transaksi/index');
	}

	public function laporan()
	{
		$this->data['title_web'] = 'Data Pinjam Buku ';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		if ($this->session->userdata('level') == 'Anggota') {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`,
				`tbl_buku`.`id_kategori`,
				`tbl_buku`.`title`,
				`tbl_kategori`.`nama_kategori`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				JOIN `tbl_buku` ON `tbl_pinjam`.`buku_id` = `tbl_buku`.`buku_id`
				JOIN `tbl_kategori` ON `tbl_buku`.`id_kategori` = `tbl_kategori`.`id_kategori`
				WHERE `tbl_pinjam`.`status` = 'Dipinjam' AND tbl_login.anggota_id = ?
			    ORDER BY `tbl_pinjam`.`pinjam_id` DESC",
				array($this->session->userdata('anggota_id'))
			);
		} else {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`,
				`tbl_buku`.`id_kategori`,
				`tbl_buku`.`title`,
				`tbl_kategori`.`nama_kategori`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				JOIN `tbl_buku` ON `tbl_pinjam`.`buku_id` = `tbl_buku`.`buku_id`
				JOIN `tbl_kategori` ON `tbl_buku`.`id_kategori` = `tbl_kategori`.`id_kategori`
				WHERE `tbl_pinjam`.`status` = 'Dipinjam'
 				ORDER BY `tbl_pinjam`.`pinjam_id` DESC"
			);
		}

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/laporan_pinjam', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function cetak()
	{

		if ($this->session->userdata('level') == 'Anggota') {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`,
				`tbl_buku`.`id_kategori`,
				`tbl_buku`.`title`,
				`tbl_kategori`.`nama_kategori`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				JOIN `tbl_buku` ON `tbl_pinjam`.`buku_id` = `tbl_buku`.`buku_id`
				JOIN `tbl_kategori` ON `tbl_buku`.`id_kategori` = `tbl_kategori`.`id_kategori`
				WHERE `tbl_pinjam`.`status` = 'Dipinjam' AND tbl_login.anggota_id = ?
			    ORDER BY `tbl_pinjam`.`pinjam_id` DESC",
				array($this->session->userdata('anggota_id'))
			);
		} else {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`,
				`tbl_buku`.`id_kategori`,
				`tbl_buku`.`title`,
				`tbl_kategori`.`nama_kategori`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				JOIN `tbl_buku` ON `tbl_pinjam`.`buku_id` = `tbl_buku`.`buku_id`
				JOIN `tbl_kategori` ON `tbl_buku`.`id_kategori` = `tbl_kategori`.`id_kategori`
				WHERE `tbl_pinjam`.`status` = 'Dipinjam'
 				ORDER BY `tbl_pinjam`.`pinjam_id` DESC"
			);
		}
		$this->load->view('pinjam/pinjam_print', $this->data);
	}

	public function kembali()
	{
		$this->data['title_web'] = 'Data Pengembalian Buku ';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		if ($this->session->userdata('level') == 'Anggota') {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Di Kembalikan' AND tbl_login.anggota_id = ?
			    ORDER BY `tbl_pinjam`.`pinjam_id` DESC",
				array($this->session->userdata('anggota_id'))
			);
		} else {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Di Kembalikan'
 				ORDER BY `tbl_pinjam`.`pinjam_id` DESC"
			);
		}

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('kembali/home', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function hilang()
	{
		$this->data['title_web'] = 'Data Buku Hilang ';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		if ($this->session->userdata('level') == 'Anggota') {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Hilang' AND tbl_login.anggota_id = ?
			    ORDER BY `tbl_pinjam`.`pinjam_id` DESC",
				array($this->session->userdata('anggota_id'))
			);
		} else {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Hilang'
 				ORDER BY `tbl_pinjam`.`pinjam_id` DESC"
			);
		}

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('hilang/home', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function laporankembali()
	{
		$this->data['title_web'] = 'Data Pengembalian Buku ';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		if ($this->session->userdata('level') == 'Anggota') {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Di Kembalikan' AND tbl_login.anggota_id = ?
			    ORDER BY `tbl_pinjam`.`pinjam_id` DESC",
				array($this->session->userdata('anggota_id'))
			);
		} else {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Di Kembalikan'
 				ORDER BY `tbl_pinjam`.`pinjam_id` DESC"
			);
		}

		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('kembali/laporan_kembali', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function cetakkembali()
	{
		$this->data['title_web'] = 'Data Pengembalian Buku ';
		$this->data['idbo'] = $this->session->userdata('ses_id');
		if ($this->session->userdata('level') == 'Anggota') {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Di Kembalikan' AND tbl_login.anggota_id = ?
			    ORDER BY `tbl_pinjam`.`pinjam_id` DESC",
				array($this->session->userdata('anggota_id'))
			);
		} else {
			$this->data['pinjam'] = $this->db->query(
				"SELECT DISTINCT 
				`tbl_pinjam`.`pinjam_id`, 
				`tbl_login`.`nama`, 
				`tbl_login`.`anggota_id`, 
				`tbl_pinjam`.`status`, 
				`tbl_pinjam`.`tgl_pinjam`, 
				`tbl_pinjam`.`lama_pinjam`, 
				`tbl_pinjam`.`tgl_balik`, 
				`tbl_pinjam`.`tgl_kembali`, 
				`tbl_pinjam`.`jml_pinjam`
				FROM `tbl_pinjam` 
				JOIN `tbl_login` ON `tbl_pinjam`.`anggota_id` = `tbl_login`.`anggota_id` 
				WHERE `tbl_pinjam`.`status` = 'Di Kembalikan'
 				ORDER BY `tbl_pinjam`.`pinjam_id` DESC"
			);
		}
		$this->load->view('kembali/cetak_kembali', $this->data);
	}
	public function statistik()
	{
		$data['idbo'] = $this->session->userdata('ses_id');
		$data['title_web'] = 'Statistik Pinjam ';
		$data['perbulan_data'] = $this->Statistik->getBulanData();

		$this->load->view('header_view', $data);
		$this->load->view('sidebar_view', $data);
		$this->load->view('pinjam/statistik_view', $data);
		$this->load->view('footer_view', $data);
	}

	public function detailpinjam()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		if ($this->session->userdata('level') == 'Anggota') {
			$count = $this->db->get_where('tbl_pinjam', [
				'pinjam_id' => $id,
				'anggota_id' => $this->session->userdata('anggota_id')
			])->num_rows();
			if ($count > 0) {
				$this->data['pinjam'] = $this->db->query(
					"SELECT DISTINCT `pinjam_id`, 
				`anggota_id`, `status`, 
				`tgl_pinjam`, `lama_pinjam`, 
				`tgl_balik`, `tgl_kembali` 
				FROM tbl_pinjam WHERE pinjam_id = ? 
				AND anggota_id =?",
					array($id, $this->session->userdata('anggota_id'))
				)->row();
			} else {
				echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
			}
		} else {
			$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
			if ($count > 0) {
				$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
				`anggota_id`, `status`, 
				`tgl_pinjam`, `lama_pinjam`, 
				`tgl_balik`, `tgl_kembali` 
				FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
			} else {
				echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
			}
		}
		$this->data['sidebar'] = 'kembali';
		$this->data['title_web'] = 'Detail Pinjam Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function detailhilang()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		if ($this->session->userdata('level') == 'Anggota') {
			$count = $this->db->get_where('tbl_pinjam', [
				'pinjam_id' => $id,
				'anggota_id' => $this->session->userdata('anggota_id')
			])->num_rows();
			if ($count > 0) {
				$this->data['pinjam'] = $this->db->query(
					"SELECT DISTINCT `pinjam_id`, 
				`anggota_id`, `status`, 
				`tgl_pinjam`, `lama_pinjam`, 
				`tgl_balik`, `tgl_kembali` 
				FROM tbl_pinjam WHERE pinjam_id = ? 
				AND anggota_id =?",
					array($id, $this->session->userdata('anggota_id'))
				)->row();
			} else {
				echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
			}
		} else {
			$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
			if ($count > 0) {
				$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
				`anggota_id`, `status`, 
				`tgl_pinjam`, `lama_pinjam`, 
				`tgl_balik`, `tgl_kembali` 
				FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
			} else {
				echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
			}
		}
		$this->data['sidebar'] = 'kembali';
		$this->data['title_web'] = 'Detail Pinjam Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('hilang/detail', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function kembalipinjam()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
		if ($count > 0) {
			$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
			`anggota_id`, `status`, 
			`tgl_pinjam`, `lama_pinjam`, 
			`tgl_balik`, `tgl_kembali` 
			FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
		}


		$this->data['title_web'] = 'Kembali Pinjam Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/kembali', $this->data);
		// $this->load->view('kembali/home', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function hilangpinjam()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('tbl_pinjam', 'pinjam_id', $id);
		if ($count > 0) {
			$this->data['pinjam'] = $this->db->query("SELECT DISTINCT `pinjam_id`, 
			`anggota_id`, `status`, 
			`tgl_pinjam`, `lama_pinjam`, 
			`tgl_balik`, `tgl_kembali` 
			FROM tbl_pinjam WHERE pinjam_id = '$id'")->row();
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('transaksi') . '"</script>';
		}


		$this->data['title_web'] = 'Data Buku ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('pinjam/hilang', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function prosespinjam()
	{
		$post = $this->input->post();

		if (!empty($post['tambah'])) {

			// $tgl = $post['tgl'];
			// $tgl2 = date('Y-m-d', strtotime('+' . $post['lama'] . ' days', strtotime($tgl)));

			$hasil_cart = array_values(unserialize($this->session->userdata('cart')));
			foreach ($hasil_cart as $isi) {

				// Check stock buku
				// $buku_id = $isi['id'];
				// $buku = $this->db->get_where('peminjamanbarang', array('kode_barang' => $buku_id))->row();
				// $stok = $buku->jml;
				// if ($stok < 1 && $post['status'] !== 'Booking') {
				// 	$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-danger">
                //     <p>Maaf, stok buku ' . $buku->title . ' sudah habis. Silakan pilih buku lain.</p>
                //     </div></div>');
				// 	redirect(base_url('transaksibarang/pinjam'));
				// }

				$data[] = array(
					'Pinjam_id' => htmlentities($post['nopinjam']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'kode_barang' => htmlentities($post['kode_barang']),
					'Tanggal_Peminjaman' => htmlentities($post['Tanggal_Peminjaman']),
					'Tanggal_Pengembalian' => htmlentities($post['Tanggal_Pengembalian']),
					'Jumlah' => htmlentities($post['Jumlah']),
					// 'Tanggal_Peminjaman' => $tgl2,
					// 'tgl_kembali' => '0',
				);
			}

			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->insert_batch('peminjamanbarang', $data);

				$cart = array_values(unserialize($this->session->userdata('cart')));
				for ($i = 0; $i < count($cart); $i++) {
					unset($cart[$i]);
				}
			}

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
            <p> Tambah Pinjam Buku Sukses !</p>
        </div></div>');
			redirect(base_url('transaksibarang'));
		}


		// --------------edit---------------
		$post = $this->input->post();

		// --------------edit---------------
		if (!empty($post['edit'])) {
			$id = htmlentities($post['pinjam_id']);
			$tgl = $post['tgl'];
			$tgl2 = date('Y-m-d', strtotime('+' . $post['lama'] . ' days', strtotime($tgl)));

			$hasil_cart = array_values(unserialize($this->session->userdata('cart')));
			foreach ($hasil_cart as $isi) {

				// Check stock buku
				$buku_id = $isi['id'];
				$buku = $this->db->get_where('tbl_buku', array('buku_id' => $buku_id))->row();
				$stok = $buku->jml;
				if ($stok < 1) {
					// Redirect jika stok buku habis
					$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-danger">
					<p>Maaf, stok buku ' . $buku->title . ' sudah habis. Silakan pilih buku lain.</p>
					</div></div>');
					redirect(base_url('transaksi'));
				}

				$data[] = array(
					'pinjam_id' => htmlentities($post['nopinjam']),
					'anggota_id' => htmlentities($post['anggota_id']),
					'buku_id' => $buku_id,
					'status' => 'Dipinjam',
					'tgl_pinjam' => htmlentities($post['tgl']),
					'lama_pinjam' => htmlentities($post['lama']),
					'jml_pinjam' => htmlentities($post['jml_pinjam']),
					'tgl_balik' => $tgl2,
					'tgl_kembali' => '0',
				);
			}

			$total_array = count($data);
			if ($total_array != 0) {
				// Gunakan fungsi update_batch untuk melakukan update data pada tabel tbl_pinjam
				$this->db->update_batch('tbl_pinjam', $data, 'pinjam_id');

				$cart = array_values(unserialize($this->session->userdata('cart')));
				for ($i = 0; $i < count($cart); $i++) {
					unset($cart[$i]);
				}
			}

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
				<p>Edit Pinjam Buku Sukses !</p>
				</div></div>');
			redirect(base_url('transaksi'));
		}
		// ------------------------hapus peminjam---------------

		if ($this->input->get('pinjam_id')) {
			$this->M_Admin->delete_table('tbl_pinjam', 'pinjam_id', $this->input->get('pinjam_id'));
			$this->M_Admin->delete_table('tbl_denda', 'pinjam_id', $this->input->get('pinjam_id'));

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p>  Hapus Transaksi Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}
		// ----------------------kembali dulu----------------------------
		// if ($this->input->get('kembali')) {
		// 	$id = $this->input->get('kembali');
		// 	$pinjam = $this->db->query("SELECT  * FROM tbl_pinjam WHERE pinjam_id = '$id'");

		// 	foreach ($pinjam->result_array() as $isi) {
		// 		$pinjam_id = $isi['pinjam_id'];
		// 		$denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
		// 		$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();
		// 		if ($denda->num_rows() > 0) {
		// 			$s = $denda->row();
		// 			echo $s->denda;
		// 		} else {
		// 			$date1 = date('Ymd');
		// 			$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']);
		// 			$diff = $date2 - $date1;
		// 			if ($diff >= 0) {
		// 				$harga_denda = 0;
		// 				$lama_waktu = 0;
		// 			} else {
		// 				$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
		// 				$harga_denda = $jml * ($dd->harga_denda * abs($diff));
		// 				$lama_waktu = abs($diff);
		// 			}
		// 		}
		// 	}

		//  kembali new 7
		if ($this->input->get('kembali')) {
			$id = $this->input->get('kembali');
			$pinjam = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$id'");

			foreach ($pinjam->result_array() as $isi) {
				$pinjam_id = $isi['pinjam_id'];
				$denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
				$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();

				if ($denda->num_rows() > 0) {
					$s = $denda->row();
					echo $s->denda;
				} else {
					$date1 = date('Ymd');
					$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']);
					$dueDate = date('Ymd', strtotime("+7 days", strtotime($date2)));

					if ($date1 > $dueDate) {
						$diff = $date1 - $dueDate;
						$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
						$harga_denda = $jml * ($dd->harga_denda * abs($diff));
						$lama_waktu = abs($diff);
					} else {
						$harga_denda = 0;
						$lama_waktu = 0;
					}
				}
			}

			$data = array(
				'status' => 'Di Kembalikan',
				'tgl_kembali' => date('Y-m-d'),
			);

			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->where('pinjam_id', $this->input->get('kembali'));
				$this->db->update('tbl_pinjam', $data);
			}

			$data_denda = array(
				'pinjam_id' => $this->input->get('kembali'),
				'denda' => $harga_denda,
				'lama_waktu' => $lama_waktu,
				'tgl_denda' => date('Y-m-d'),
			);
			$this->db->insert('tbl_denda', $data_denda);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Pengembalian Pinjam Buku Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}
		// hilang

		if ($this->input->get('hilang')) {
			$id = $this->input->get('hilang');
			$pinjam = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$id'");

			foreach ($pinjam->result_array() as $isi) {
				$pinjam_id = $isi['pinjam_id'];
				$denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
				$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();

				if ($denda->num_rows() > 0) {
					$s = $denda->row();
					echo $s->denda;
				} else {
					$date1 = date('Ymd');
					$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']);
					$dueDate = date('Ymd', strtotime("+7 days", strtotime($date2)));

					if ($date1 > $dueDate) {
						$diff = $date1 - $dueDate;
						$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
						$harga_denda = $jml * ($dd->harga_denda * abs($diff));
						$lama_waktu = abs($diff);
					} else {
						$harga_denda = 0;
						$lama_waktu = 0;
					}
				}
			}

			$data = array(
				'status' => 'Hilang',
				'tgl_kembali' => date('Y-m-d'),
			);

			$total_array = count($data);
			if ($total_array != 0) {
				$this->db->where('pinjam_id', $this->input->get('hilang'));
				$this->db->update('tbl_pinjam', $data);
			}

			$data_denda = array(
				'pinjam_id' => $this->input->get('hilang'),
				'denda' => $harga_denda,
				'lama_waktu' => $lama_waktu,
				'tgl_denda' => date('Y-m-d'),
			);
			$this->db->insert('tbl_denda', $data_denda);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Proses Buku Hilang Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi'));
		}
	}

	public function denda()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$this->data['denda'] = $this->db->query("SELECT * FROM tbl_biaya_denda ORDER BY id_biaya_denda DESC");

		if (!empty($this->input->get('id'))) {
			$id = $this->input->get('id');
			$count = $this->M_Admin->CountTableId('tbl_biaya_denda', 'id_biaya_denda', $id);
			if ($count > 0) {
				$this->data['den'] = $this->db->query("SELECT *FROM tbl_biaya_denda WHERE id_biaya_denda='$id'")->row();
			} else {
				echo '<script>alert("KATEGORI TIDAK DITEMUKAN");window.location="' . base_url('transaksi/denda') . '"</script>';
			}
		}

		$this->data['title_web'] = ' Denda ';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('denda/denda_view', $this->data);
		$this->load->view('footer_view', $this->data);
	}

	public function dendaproses()
	{
		if (!empty($this->input->post('tambah'))) {
			$post = $this->input->post();
			$data = array(
				'harga_denda' => $post['harga'],
				'stat' => 'Tidak Aktif',
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->insert('tbl_biaya_denda', $data);

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Tambah  Harga Denda  Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}

		if (!empty($this->input->post('edit'))) {
			$dd = $this->M_Admin->get_tableid('tbl_biaya_denda', 'stat', 'Aktif');
			foreach ($dd as $isi) {
				$data1 = array(
					'stat' => 'Tidak Aktif',
				);
				$this->db->where('id_biaya_denda', $isi['id_biaya_denda']);
				$this->db->update('tbl_biaya_denda', $data1);
			}

			$post = $this->input->post();
			$data = array(
				'harga_denda' => $post['harga'],
				'stat' => $post['status'],
				'tgl_tetap' => date('Y-m-d')
			);

			$this->db->where('id_biaya_denda', $post['edit']);
			$this->db->update('tbl_biaya_denda', $data);


			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
			<p> Edit Harga Denda  Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}

		if (!empty($this->input->get('denda_id'))) {
			$this->db->where('id_biaya_denda', $this->input->get('denda_id'));
			$this->db->delete('tbl_biaya_denda');

			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-warning">
			<p> Hapus Harga Denda Sukses !</p>
			</div></div>');
			redirect(base_url('transaksi/denda'));
		}
	}
	public function result()
	{

		$data = $this->M_Admin->get_tableid_edit('tbl_login', 'anggota_id', $this->input->post('kode_anggota')); //mengubah Kode buku pencarian jadi nama
		error_reporting(0);
		if ($data->user != null) {
			echo '<div class="container mt-2">
       
            <table class="table table-striped">
                <tr>
                    <td>Nama Anggota</td>
                    <td>:</td>
                    <td>' . $data->user . '</td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td>' . $data->alamat . '</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>' . $data->jenkel . '</td>
                </tr>
            </table>
    </div>';
		} else {
			echo 'Anggota Tidak Ditemukan !';
		}
	}

	public function barang()
	{
		$id = $this->input->post('kode_buku');
		$row = $this->db->query("SELECT * FROM barang WHERE kode_barang ='$id'");

		if ($row->num_rows() > 0) {
			$tes = $row->row();
			$item = array(
				'id' => $id,
				'qty' => 1,
				'price' => '1000',
				'name' => $tes->title,
				'options' => array( 'Nama_Barang' => $tes->Nama_Barang, 'Stok' => $tes->Stok)
			);
			if (!$this->session->has_userdata('cart')) {
				$cart = array($item);
				$this->session->set_userdata('cart', serialize($cart));
			} else {
				$index = $this->exists($id);
				$cart = array_values(unserialize($this->session->userdata('cart')));
				if ($index == -1) {
					array_push($cart, $item);
					$this->session->set_userdata('cart', serialize($cart));
				} else {
					$cart[$index]['quantity']++;
					$this->session->set_userdata('cart', serialize($cart));
				}
			}
		} else {
		}
	}

	public function barang_list()
	{
?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>Stok</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
					<tr>
						<td>
							<?= $no; ?>
						</td>
						<td>
							<?= $items['options']['Nama_Barang']; ?>
						</td>
						<td>
							<?= $items['options']['Stok']; ?>
						</td>
						<td style="width:17%">
							<a href="javascript:void(0)" id="delete_buku<?= $no; ?>" data_<?= $no; ?>="<?= $items['id']; ?>" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<script>
						$(document).ready(function() {
							$("#delete_buku<?= $no; ?>").click(function(e) {
								$.ajax({
									type: "POST",
									url: "<?php echo base_url('transaksibarang/del_cart'); ?>",
									data: 'kode_buku=' + $(this).attr("data_<?= $no; ?>"),
									beforeSend: function() {},
									success: function(html) {
										$("#tampil").html(html);
									}
								});
							});
						});
					</script>
				<?php $no++;
				} ?>
			</tbody>
		</table>
		<?php foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
			<input type="hidden" value="<?= $items['id']; ?>" name="idbuku[]">
		<?php } ?>
		<div id="tampil"></div>
<?php
	}

	public function del_cart()
	{
		error_reporting(0);
		$id = $this->input->post('kode_barang');
		$index = $this->exists($id);
		$cart = array_values(unserialize($this->session->userdata('cart')));
		unset($cart[$index]);
		$this->session->set_userdata('cart', serialize($cart));
		// redirect('jual/tambah');
		echo '<script>$("#result_barang").load("' . base_url('transaksibarang/barang_list') . '");</script>';
	}

	private function exists($id)
	{
		$cart = array_values(unserialize($this->session->userdata('cart')));
		for ($i = 0; $i < count($cart); $i++) {
			if ($cart[$i]['buku_id'] == $id) {
				return $i;
			}
		}
		return -1;
	}
}
