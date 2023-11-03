<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->data['CI'] = &get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('FilterModel');
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
		$this->load->library('pdf');
	}

	public function index()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		// $this->data['databarang'] = $this->M_Admin->get_table('barang');
		$this->data['databarang'] = $this->db->get('barang')->result_array();
		$this->data['title_web'] = 'Data Barang';
		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('barang/barang_view', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}

	public function laporan()
	{
		// $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
		// $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
		// if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
		// 	$transaksi = $this->FilterModel->view_semuabuku(); // Panggil fungsi view_all yang ada di FilterModel
		// 	$url_cetak = 'cetak';
		// 	$label = 'Semua Data Barang';
		// } else { // Jika terisi
		// 	$transaksi = $this->FilterModel->view_by_tanggal($tgl_awal, $tgl_akhir); // Panggil fungsi view_by_date yang ada di FilterModel
		// 	$url_cetak = 'cetak?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir;
		// 	$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
		// 	$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
		// 	$label = 'Periode Tanggal ' . $tgl_awal . ' S/d ' . $tgl_akhir;
		// }
		// $this->data['buku_masuk'] = $transaksi;
		// $this->data['url_cetak'] = base_url('buku_masuk/' . $url_cetak);
		// $this->data['label'] = $label;
		// $this->data['idbo'] = $this->session->userdata('ses_id');
		// // $this->data['pengunjung'] = $this->M_Pengunjung->get_table('tbl_pengunjung');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		// $this->data['databarang'] = $this->M_Admin->get_table('barang');
		$this->data['databarang'] = $this->db->get('barang')->result_array();
		$this->data['title_web'] = 'Data Barang';
		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('barang/laporan_barang', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}
	public function cetak()
	{
		// $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
		// $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
		// if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
		// 	$transaksi = $this->FilterModel->view_semuabuku(); // Panggil fungsi view_all yang ada di FilterModel
		// 	$label = 'Semua Data Barang ';
		// } else { // Jika terisi
		// 	$transaksi = $this->FilterModel->view_by_tanggal($tgl_awal, $tgl_akhir); // Panggil fungsi view_by_date yang ada di FilterModel
		// 	// $url_cetak = 'cetak?tgl_awal=' . $tgl_awal.'&tgl_akhir='.$tgl_akhir;
		// 	$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
		// 	$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
		// 	$label = ' Periode Tanggal ' . $tgl_awal . ' S/d ' . $tgl_akhir;
		// }
		// $data['label'] = $label;
		// $data['buku_masuk'] = $transaksi;
		// $this->load->view('buku_masuk/buku_print', $data);
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['title_web'] = 'Cetak Barang';
		// $this->data['databarang'] = $this->M_Admin->get_table('barang');
		$this->data['databarang'] = $this->db->get('barang')->result_array();
		$this->load->view('barang/barang_print', $this->data);
	}

	public function detail()
	{
		if ($this->session->userdata('level') == 'Petugas') {
			if ($this->uri->segment('3') == '') {
				echo '<script>alert("halaman tidak ditemukan");window.location="' . base_url('user') . '";</script>';
			}
			$this->data['idbo'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_pengunjung', 'id_pengunjung', $this->uri->segment('3'));
			if ($count > 0) {
				$this->data['pengunjung'] = $this->M_Admin->get_tableid_edit('tbl_pengunjung', 'id_pengunjung', $this->uri->segment('3'));
			} else {
				echo '<script>alert("PENGUNJUNG TIDAK DITEMUKAN");window.location="' . base_url('pengunjung') . '"</script>';
			}
		} elseif ($this->session->userdata('level') == 'Anggota') {
			$this->data['idbo'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_pengunjung', 'id_pengunjung', $this->session->userdata('ses_id'));
			if ($count > 0) {
				$this->data['pengunjung'] = $this->M_Admin->get_tableid_edit('tbl_pengunjung', 'id_pengunjung', $this->session->userdata('ses_id'));
			} else {
				echo '<script>alert("PENGUNJUNG TIDAK DITEMUKAN");window.location="' . base_url('pengunjung') . '"</script>';
			}
		}
		$this->data['title_web'] = 'Print Kartu Anggota ';
		$this->load->view('buku_masuk/detail', $this->data);
	}
	public function edit()
	{
		// $this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('barang', 'ID_Barang', $this->uri->segment('3'));
		if ($count > 0) {

			$this->data['databarang'] = $this->M_Admin->get_tableid_edit('barang', 'ID_Barang', $this->uri->segment('3'));

			// $this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			// $this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();

		} else {
			echo '<script>alert("Barang TIDAK DITEMUKAN");window.location="' . base_url('barang') . '"</script>';
		}

		$this->data['title_web'] = 'Data Barang Edit';
		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('barang/edit_view', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}

	public function tambah()
	{

		// $this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['databarang'] = $this->M_Admin->get_table('barang');
		$this->data['title_web'] = 'Tambah Barang';
		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('barang/tambah_view', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}


	public function prosesbarang()
	{
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}

		// tambah aksi form proses buku
		if (!empty($this->input->post('tambah'))) {
			$post = $this->input->post();
			$data = array(
				'kode_barang' => $this->M_Admin->generate_kode_barang(),
				'Nama_Barang' => htmlentities($post['Nama_Barang']),
				'Stok' => htmlentities($post['Stok']),
			);

			$this->db->insert('barang', $data);
			if ($this->db->affected_rows() > 0) {
				$status = 'Berhasil';
				$pesan = 'Data Barang Berhasil diTambahkan';
			} else {
				$status = 'Gagal';
				$pesan = 'Data Barang Gagal diTambahkan';
			}
			$this->session->set_flashdata('status', $status);
			$this->session->set_flashdata('pesan', $pesan);
			redirect(base_url('Barang'));
		
		}
		// edit aksi form proses 
		if (!empty($this->input->post('edit'))) {
			$post = $this->input->post();
			$data = array(

				'Nama_Barang' => htmlentities($post['Nama_Barang']),
				'Stok' => htmlentities($post['Stok']),
			);

			$this->db->where('ID_Barang', htmlentities($post['edit']));
			$this->db->update('barang', $data);
			if ($this->db->affected_rows() > 0) {
				$status = 'Berhasil';
				$pesan = 'Data Barang Berhasil diTambahkan';
			} else {
				$status = 'Gagal';
				$pesan = 'Data Barang Gagal diTambahkan';
			}
			$this->session->set_flashdata('status', $status);
			$this->session->set_flashdata('pesan', $pesan);
			redirect(base_url('Barang'));
		}
	}

	public function proses_edit()
	{
		// Mendapatkan data edit barang dari form
		$ID_Barang = $this->input->post('ID_Barang');
		$Nama_Barang = $this->input->post('Nama_Barang');
		$Stok = $this->input->post('Stok');

		// Validasi data jika diperlukan

		// Update data barang ke database
		$data = array(
			'Nama_Barang' => htmlentities($Nama_Barang),
			'Stok' => htmlentities($Stok)
		);

		// Update data ke dalam tabel barang berdasarkan ID_Barang
		$this->db->where('ID_Barang', $ID_Barang);
		$this->db->update('barang', $data);

		// Set pesan notifikasi untuk memberitahu bahwa perubahan berhasil disimpan
		if ($this->db->affected_rows() > 0) {
			$status = 'Berhasil';
			$pesan = 'Data Barang Berhasil DiUpdate';
		} else {
			$status = 'Gagal';
			$pesan = 'Data Barang Gagal DiUpdate';
		}
		$this->session->set_flashdata('status', $status);
		$this->session->set_flashdata('pesan', $pesan);
		redirect(base_url('Barang'));

		// Redirect ke halaman daftar barang atau halaman lain yang diinginkan
		redirect(base_url('Barang'));
	}


	public function del()
	{
		if ($this->uri->segment('3') == '') {
			echo '<script>alert("halaman tidak ditemukan");window.location="' . base_url('barang') . '";</script>';
		}
		
        $this->M_Admin->delete_table('barang', 'ID_Barang', $this->uri->segment('3'));
		redirect(base_url('barang'));
	}
}
