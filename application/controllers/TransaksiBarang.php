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
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		}
	}

	public function index()
	{
		$this->data['title_web'] = 'Data Pinjam Barang';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$anggota_id = $this->session->userdata('anggota_id');


		// Periksa apakah anggota_id ada sebelum menjalankan query
		$this->db->distinct();
		$this->db->select('
        peminjamanbarang.ID_Peminjaman,
        peminjamanbarang.Pinjam_id,
        tbl_login.user,
        tbl_login.anggota_id,
        peminjamanbarang.Tanggal_Peminjaman,
        peminjamanbarang.Tanggal_Pengembalian,
        peminjamanbarang.tgl_kembali,
        peminjamanbarang.status,
        peminjamanbarang.Jumlah,
        barang.ID_Barang,
        barang.kode_barang,
        barang.Nama_Barang,
        barang.stok
    ');
		$this->db->from('peminjamanbarang');
		$this->db->join('tbl_login', 'peminjamanbarang.anggota_id = tbl_login.anggota_id');
		$this->db->join('barang', 'peminjamanbarang.kode_barang = barang.kode_barang');
		$this->db->where('peminjamanbarang.status', 'Dipinjam');

		if ($this->session->userdata('level') == 'User' && !empty($anggota_id)) {
			$this->db->where('tbl_login.anggota_id', $anggota_id);
		}

		$this->db->order_by('peminjamanbarang.ID_Peminjaman', 'ASC');
		if ($this->input->get()) {
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman >=', $start_date);
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman <=', $end_date);
		}

		$this->data['pinjam'] = $this->db->get()->result_array();

		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('pinjambarang/pinjam_view', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}


	public function print()
	{
		$this->data['title_web'] = 'Data Pinjam Barang';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$anggota_id = $this->session->userdata('anggota_id');


		// Periksa apakah anggota_id ada sebelum menjalankan query
		$this->db->distinct();
		$this->db->select('
        peminjamanbarang.ID_Peminjaman,
        peminjamanbarang.Pinjam_id,
        tbl_login.user,
        tbl_login.anggota_id,
        peminjamanbarang.Tanggal_Peminjaman,
        peminjamanbarang.Tanggal_Pengembalian,
        peminjamanbarang.tgl_kembali,
        peminjamanbarang.status,
        peminjamanbarang.Jumlah,
        barang.ID_Barang,
        barang.kode_barang,
        barang.Nama_Barang,
        barang.stok
    ');
		$this->db->from('peminjamanbarang');
		$this->db->join('tbl_login', 'peminjamanbarang.anggota_id = tbl_login.anggota_id');
		$this->db->join('barang', 'peminjamanbarang.kode_barang = barang.kode_barang');
		$this->db->where('peminjamanbarang.status', 'Dipinjam');

		if ($this->session->userdata('level') == 'User' && !empty($anggota_id)) {
			$this->db->where('tbl_login.anggota_id', $anggota_id);
		}

		$this->db->order_by('peminjamanbarang.ID_Peminjaman', 'ASC');
		if ($this->input->get() && $this->input->get('start_date') && $this->input->get('end_date')) {
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman >=', $start_date);
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman <=', $end_date);
		}
		$this->data['title'] = "Peminjaman Barang";

		$this->data['pinjam'] = $this->db->get()->result_array();


		$this->load->view('pinjambarang/pinjam_transaction_print', $this->data);

	}


	public function kembali()
	{
		$this->data['title_web'] = 'Data Kembalian Barang';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$anggota_id = $this->session->userdata('anggota_id');



		$this->db->distinct();
		$this->db->select('
        peminjamanbarang.ID_Peminjaman,
        peminjamanbarang.Pinjam_id,
        tbl_login.user,
        tbl_login.anggota_id,
        peminjamanbarang.Tanggal_Peminjaman,
        peminjamanbarang.Tanggal_Pengembalian,
        peminjamanbarang.tgl_kembali,
        peminjamanbarang.status,
        peminjamanbarang.Jumlah,
        barang.ID_Barang,
        barang.kode_barang,
        barang.Nama_Barang,
        barang.stok
    ');
		$this->db->from('peminjamanbarang');
		$this->db->join('tbl_login', 'peminjamanbarang.anggota_id = tbl_login.anggota_id');
		$this->db->join('barang', 'peminjamanbarang.kode_barang = barang.kode_barang');
		$this->db->where('peminjamanbarang.status', 'Di kembalikan');

		if ($this->session->userdata('level') == 'User' && !empty($anggota_id)) {
			$this->db->where('tbl_login.anggota_id', $anggota_id);
		}

		$this->db->order_by('peminjamanbarang.ID_Peminjaman', 'ASC');
		if ($this->input->get() && $this->input->get('start_date') && $this->input->get('end_date')) {
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman >=', $start_date);
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman <=', $end_date);
		}

		$this->data['pinjam'] = $this->db->get()->result_array();
		

		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('kembali/home', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}

	public function printKembali()
	{
		$this->data['title_web'] = 'Data Pinjam Barang';
		$this->data['idbo'] = $this->session->userdata('ses_id');

		$anggota_id = $this->session->userdata('anggota_id');


		// Periksa apakah anggota_id ada sebelum menjalankan query
		$this->db->distinct();
		$this->db->select('
        peminjamanbarang.ID_Peminjaman,
        peminjamanbarang.Pinjam_id,
        tbl_login.user,
        tbl_login.anggota_id,
        peminjamanbarang.Tanggal_Peminjaman,
        peminjamanbarang.Tanggal_Pengembalian,
        peminjamanbarang.tgl_kembali,
        peminjamanbarang.status,
        peminjamanbarang.Jumlah,
        barang.ID_Barang,
        barang.kode_barang,
        barang.Nama_Barang,
        barang.stok
    ');
		$this->db->from('peminjamanbarang');
		$this->db->join('tbl_login', 'peminjamanbarang.anggota_id = tbl_login.anggota_id');
		$this->db->join('barang', 'peminjamanbarang.kode_barang = barang.kode_barang');
		$this->db->where('peminjamanbarang.status', 'Di kembalikan');

		if ($this->session->userdata('level') == 'User' && !empty($anggota_id)) {
			$this->db->where('tbl_login.anggota_id', $anggota_id);
		}

		$this->db->order_by('peminjamanbarang.ID_Peminjaman', 'ASC');
		if ($this->input->get() && $this->input->get('start_date') && $this->input->get('end_date')) {
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman >=', $start_date);
			$this->db->where('peminjamanbarang.Tanggal_Peminjaman <=', $end_date);
		}

		$this->data['pinjam'] = $this->db->get()->result_array();

		$this->data['title'] = "Pengembalian Barang";
		$this->load->view('pinjambarang/pinjam_transaction_print', $this->data);

	}

	public function pinjam()
	{

		$this->data['nop'] = $this->M_Admin->buat_kode('peminjamanbarang', 'PJ', 'Pinjam_id', 'ORDER BY Pinjam_id DESC LIMIT 1');
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['databarang'] = $this->db->query("SELECT * FROM barang ORDER BY ID_Barang DESC")->result_array();
		$this->session->set_userdata('cart', null);
		$this->data['title_web'] = 'Tambah Pinjam Barang ';
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
	

	public function kembalipinjam()
	{
		$this->data['nop'] = $this->M_Admin->buat_kode('peminjamanbarang', 'PJ', 'Pinjam_id', 'ORDER BY Pinjam_id DESC LIMIT 1');
		$this->data['user'] = $this->M_Admin->get_table('tbl_login');
		$this->data['databarang'] = $this->db->query("SELECT * FROM barang ORDER BY ID_Barang DESC")->result_array();
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$id = $this->uri->segment('3');
		$count = $this->M_Admin->CountTableId('peminjamanbarang', 'Pinjam_id', $id);
		if ($count > 0) {
			// Query untuk mendapatkan data dari tabel peminjamanbarang dengan informasi tambahan
			$query = $this->db->query(
				"
				SELECT DISTINCT 
				`peminjamanbarang`.`ID_Peminjaman`, 
				`peminjamanbarang`.`Pinjam_id`, 
				`tbl_login`.`user`,  
				`tbl_login`.`anggota_id`,  
				`tbl_login`.`jenkel`,  
				`tbl_login`.`alamat`,  
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
				WHERE `peminjamanbarang`.`Pinjam_id` = '$id'
				ORDER BY `peminjamanbarang`.`ID_Peminjaman` ASC"
			);

			if ($query->num_rows() > 0) {
				// Menyimpan hasil query ke dalam $this->data['pinjam']
				$this->data['pinjam'] = $query->row();
			} else {
				echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('TransaksiBarang') . '"</script>';
			}
		} else {
			echo '<script>alert("DETAIL TIDAK DITEMUKAN");window.location="' . base_url('TransaksiBarang') . '"</script>';
		}


		$this->data['title_web'] = 'Kembali Pinjam Buku ';
		$this->load->view('template/header_view', $this->data);
		$this->load->view('template/sidebar_view', $this->data);
		$this->load->view('pinjambarang/kembali', $this->data);
		$this->load->view('template/footer_view', $this->data);
	}
	

	public function prosespinjam()
	{
		$post = $this->input->post();

		if (!empty($post['tambah'])) {

			// $tgl = $post['tgl'];
			// $tgl2 = date('Y-m-d', strtotime('+' . $post['lama'] . ' days', strtotime($tgl)));
			$Pinjam_id = htmlentities($this->input->post('Pinjam_id', TRUE));
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
					'Pinjam_id' => $Pinjam_id,
					// 'Pinjam_id' => htmlentities($post['Pinjam_id']),
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
			if ($this->db->affected_rows() > 0) {
				$status = 'Berhasil';
				$pesan = 'Data Pemijaman Berhasil diTambahkan';
			} else {
				$status = 'Gagal';
				$pesan = 'Data Pemijaman Gagal diTambahkan';
			}
			$this->session->set_flashdata('status', $status);
			$this->session->set_flashdata('pesan', $pesan);
			redirect(base_url('TransaksiBarang'));
		}


		// --------------edit tidak ada fungsinya lagi ---------------

		// $post = $this->input->post();
		// if (!empty($post['edit'])) {
		// 	$id = htmlentities($post['pinjam_id']);
		// 	$tgl = $post['tgl'];
		// 	$tgl2 = date('Y-m-d', strtotime('+' . $post['lama'] . ' days', strtotime($tgl)));

		// 	$hasil_cart = array_values(unserialize($this->session->userdata('cart')));
		// 	foreach ($hasil_cart as $isi) {

		// 		// Check stock buku
		// 		$buku_id = $isi['id'];
		// 		$buku = $this->db->get_where('tbl_buku', array('buku_id' => $buku_id))->row();
		// 		$stok = $buku->jml;
		// 		if ($stok < 1) {
		// 			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-danger">
		// 			<p>Maaf, stok buku ' . $buku->title . ' sudah habis. Silakan pilih buku lain.</p>
		// 			</div></div>');
		// 			redirect(base_url('transaksi'));
		// 		}

		// 		$data[] = array(
		// 			'pinjam_id' => htmlentities($post['nopinjam']),
		// 			'anggota_id' => htmlentities($post['anggota_id']),
		// 			'buku_id' => $buku_id,
		// 			'status' => 'Dipinjam',
		// 			'tgl_pinjam' => htmlentities($post['tgl']),
		// 			'lama_pinjam' => htmlentities($post['lama']),
		// 			'jml_pinjam' => htmlentities($post['jml_pinjam']),
		// 			'tgl_balik' => $tgl2,
		// 			'tgl_kembali' => '0',
		// 		);
		// 	}

		// 	$total_array = count($data);
		// 	if ($total_array != 0) {
		// 		$this->db->update_batch('tbl_pinjam', $data, 'pinjam_id');

		// 		$cart = array_values(unserialize($this->session->userdata('cart')));
		// 		for ($i = 0; $i < count($cart); $i++) {
		// 			unset($cart[$i]);
		// 		}
		// 	}
		// 	if ($this->db->affected_rows() > 0) {
		// 		$status = 'Berhasil';
		// 		$pesan = 'Data Pemijaman Berhasil diedit';
		// 	} else {
		// 		$status = 'Gagal';
		// 		$pesan = 'Data Pemijaman Gagal diedit';
		// 	}
		// 	$this->session->set_flashdata('status', $status);
		// 	$this->session->set_flashdata('pesan', $pesan);
		// 	redirect(base_url('transaksibarang'));
		// }
		// ------------------------hapus peminjam---------------

		if ($this->input->get('ID_Peminjaman')) {
			$this->data['idbo'] = $this->session->userdata('ses_id');
			$this->M_Admin->delete_table('peminjamanbarang', 'ID_Peminjaman', $this->input->get('ID_Peminjaman'));
			// $this->M_Admin->delete_table('tbl_denda', 'pinjam_id', $this->input->get('pinjam_id'));

			if ($this->db->affected_rows() > 0) {
				$status = 'Berhasil';
				$pesan = 'Data Pemijaman Berhasil Dihapus';
			} else {
				$status = 'Gagal';
				$pesan = 'Data Pemijaman Gagal Dihapus';
			}
			$this->session->set_flashdata('status', $status);
			$this->session->set_flashdata('pesan', $pesan);
			redirect(base_url('TransaksiBarang'));
		}
		// kembali barang
		if ($this->input->get('kembali')) {
			$id = $this->input->get('kembali');
			$pinjam = $this->db->query("SELECT * FROM peminjamanbarang WHERE Pinjam_id = '$id'")->row();

			if ($pinjam) {
				// Ubah status dan tanggal kembali
				$data = array(
					'status' => 'Di Kembalikan',
					'tgl_kembali' => date('Y-m-d'),
				);

				// Update data peminjaman
				$this->db->where('Pinjam_id', $id);
				$this->db->update('peminjamanbarang', $data);
				if ($this->db->affected_rows() > 0) {
					$status = 'Berhasil';
					$pesan = 'Data pengembalian Barang Berhasil ';
				} else {
					$status = 'Gagal';
					$pesan = 'Data pengembalian Barang Gagal ';
				}
				$this->session->set_flashdata('status', $status);
				$this->session->set_flashdata('pesan', $pesan);
				// Set pesan sukses
				// $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
				// <p> Pengembalian Pinjam Buku Sukses !</p>
				// </div></div>');
			} else {
				// Jika data peminjaman tidak ditemukan, tampilkan pesan error
				$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-danger">
				<p> Data Peminjaman Tidak Ditemukan!</p>
				</div></div>');
			}

			// Redirect ke halaman 'transaksibarang'
			redirect(base_url('TransaksiBarang'));
		} else {
			// Jika parameter 'kembali' tidak ditemukan, tampilkan pesan error
			$this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-danger">
			<p> Parameter Pengembalian Tidak Valid!</p>
			</div></div>');
			// Redirect ke halaman 'transaksibarang'
			redirect(base_url('TransaksiBarang'));
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



	
	public function result()
	{

		$data = $this->M_Admin->get_tableid_edit('tbl_login', 'anggota_id', $this->input->post('kode_anggota')); //mengubah Kode buku pencarian jadi nama
		error_reporting(0);
		if ($data->user != null) {
			echo '<div class="container mt-2">
       
            <table class="table table-striped">
                <tr>
                    <td>Nama Pengguna</td>
                    <td>:</td>
                    <td>' . $data->user . '</td>
                </tr>
                <tr>
                    <td>Alamat</td>
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
				'options' => array('Nama_Barang' => $tes->Nama_Barang, 'Stok' => $tes->Stok)
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
							<a href="javascript:void(0)" id="delete_buku<?= $no; ?>" data_<?= $no; ?>="<?= $items['id']; ?>"
								class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<script>
						$(document).ready(function () {
							$("#delete_buku<?= $no; ?>").click(function (e) {
								$.ajax({
									type: "POST",
									url: "<?php echo base_url('transaksibarang/del_cart'); ?>",
									data: 'kode_buku=' + $(this).attr("data_<?= $no; ?>"),
									beforeSend: function () { },
									success: function (html) {
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
		echo '<script>$("#result_barang").load("' . base_url('TransaksiBarang/barang_list') . '");</script>';
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
