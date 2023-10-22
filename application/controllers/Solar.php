<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solar extends CI_Controller {
	function __construct(){
	 parent::__construct();
	 	//validasi jika user belum login
     $this->data['CI'] =& get_instance();
     $this->load->helper(array('form', 'url'));
     $this->load->model('M_Admin');
	 $this->load->model('FilterModel');
		if($this->session->userdata('masuk_perpus') != TRUE){
				$url=base_url('eror');
				redirect($url);
		}
		$this->load->library('pdf');
	}

	public function index()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$this->data['buku_masuk'] = $this->M_Admin->get_table('tbl_bukumasuk');
        $this->data['title_web'] = 'Data Buku Masuk';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('buku_masuk/buku_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function laporan()
	{
		$tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
		$tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
		if (empty($tgl_awal)or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
			$transaksi = $this->FilterModel->view_semuabuku();  // Panggil fungsi view_all yang ada di FilterModel
			$url_cetak = 'cetak';
			$label = 'Semua Data Buku Masuk';
		} else { // Jika terisi
			$transaksi = $this->FilterModel->view_by_tanggal($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di FilterModel
			$url_cetak = 'cetak?tgl_awal=' . $tgl_awal.'&tgl_akhir='.$tgl_akhir;
			$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
			$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
			$label = 'Periode Tanggal ' . $tgl_awal .' S/d ' .$tgl_akhir;
		}
		$this->data['buku_masuk'] = $transaksi;
		$this->data['url_cetak'] = base_url('buku_masuk/' . $url_cetak);
		$this->data['label'] = $label;
		$this->data['idbo'] = $this->session->userdata('ses_id');
		// $this->data['pengunjung'] = $this->M_Pengunjung->get_table('tbl_pengunjung');

		$this->data['title_web'] = 'Data Buku Masuk';
		$this->load->view('header_view', $this->data);
		$this->load->view('sidebar_view', $this->data);
		$this->load->view('buku_masuk/laporan_buku', $this->data);
		$this->load->view('footer_view', $this->data);
	}
	public function cetak()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if (empty($tgl_awal)or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->FilterModel->view_semuabuku();  // Panggil fungsi view_all yang ada di FilterModel
            $label = 'Semua Data Buku Masuk ';
        } else { // Jika terisi
            $transaksi = $this->FilterModel->view_by_tanggal($tgl_awal,$tgl_akhir);  // Panggil fungsi view_by_date yang ada di FilterModel
			// $url_cetak = 'cetak?tgl_awal=' . $tgl_awal.'&tgl_akhir='.$tgl_akhir;
			$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = ' Periode Tanggal ' . $tgl_awal .' S/d ' .$tgl_akhir;
        }
        $data['label'] = $label;
        $data['buku_masuk'] = $transaksi;
        $this->load->view('buku_masuk/buku_print', $data);
    }

    public function detail()
    {	
		if($this->session->userdata('level') == 'Petugas'){
			if($this->uri->segment('3') == ''){ echo '<script>alert("halaman tidak ditemukan");window.location="'.base_url('user').'";</script>';}
			$this->data['idbo'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_pengunjung','id_pengunjung',$this->uri->segment('3'));
			if($count > 0)
			{			
				$this->data['pengunjung'] = $this->M_Admin->get_tableid_edit('tbl_pengunjung','id_pengunjung',$this->uri->segment('3'));
			}else{
				echo '<script>alert("PENGUNJUNG TIDAK DITEMUKAN");window.location="'.base_url('pengunjung').'"</script>';
			}		
		}elseif($this->session->userdata('level') == 'Anggota'){
			$this->data['idbo'] = $this->session->userdata('ses_id');
			$count = $this->M_Admin->CountTableId('tbl_pengunjung','id_pengunjung',$this->session->userdata('ses_id'));
			if($count > 0)
			{			
				$this->data['pengunjung'] = $this->M_Admin->get_tableid_edit('tbl_pengunjung','id_pengunjung',$this->session->userdata('ses_id'));
			}else{
				echo '<script>alert("PENGUNJUNG TIDAK DITEMUKAN");window.location="'.base_url('pengunjung').'"</script>';
			}
		}
        $this->data['title_web'] = 'Print Kartu Anggota ';
        $this->load->view('buku_masuk/detail',$this->data);
    }

	

	public function bukuedit()
	{
		$this->data['idbo'] = $this->session->userdata('ses_id');
		$count = $this->M_Admin->CountTableId('tbl_bukumasuk','id',$this->uri->segment('3'));
		if($count > 0)
		{
			
			$this->data['buku_masuk'] = $this->M_Admin->get_tableid_edit('tbl_bukumasuk','id',$this->uri->segment('3'));
	   
			// $this->data['kats'] =  $this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori DESC")->result_array();
			// $this->data['rakbuku'] =  $this->db->query("SELECT * FROM tbl_rak ORDER BY id_rak DESC")->result_array();

		}else{
			echo '<script>alert("pengunjung TIDAK DITEMUKAN");window.location="'.base_url('pengunjung').'"</script>';
		}
 
		$this->data['title_web'] = 'Data Buku Masuk Edit';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('buku_masuk/edit_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}

	public function tambah()
	{
		
		$this->data['idbo'] = $this->session->userdata('ses_id');
        $this->data['buku_masuk'] = $this->M_Admin->get_table('tbl_bukumasuk');
        $this->data['title_web'] = 'Tambah Buku Masuk';
        $this->load->view('header_view',$this->data);
        $this->load->view('sidebar_view',$this->data);
        $this->load->view('buku_masuk/tambah_view',$this->data);
        $this->load->view('footer_view',$this->data);
	}


	public function prosesbuku()
{
    if ($this->session->userdata('masuk_perpus') != TRUE) {
        $url = base_url('login');
        redirect($url);
    }

    // tambah aksi form proses buku
    if (!empty($this->input->post('tambah'))) {
        $post = $this->input->post();
        $tahun = date('Y'); // Ambil tahun saat ini (4 digit)
        $bulan = date('m'); // Ambil bulan saat ini (2 digit)

        // Mendapatkan angka otomatis dari database atau menggunakan logika lain
        // Misalnya, Anda bisa mengambil data terakhir dari tabel buku_masuk dan menambahkannya dengan 1
        $lastBukuMasuk = $this->db->select('buku_id')->order_by('buku_id', 'DESC')->limit(1)->get('tbl_bukumasuk')->row();
        $lastAngkaOtomatis = !empty($lastBukuMasuk) ? intval(substr($lastBukuMasuk->buku_id, -3)) : 0;
        $angkaOtomatis = str_pad($lastAngkaOtomatis + 1, 3, '0', STR_PAD_LEFT);

        $kodeBuku = $tahun . $bulan . '-' . $angkaOtomatis;
        $data = array(
            'buku_id' => $this->M_Admin->generate_kode_bukumasuk(),
            'kode_buku' => $kodeBuku,
            'judul' => htmlentities($post['judul']),
            'pengarang' => htmlentities($post['pengarang']),
            'penerbit' => htmlentities($post['penerbit']),
            'tahun' => htmlentities($post['tahun']),
            'tanggal' => htmlentities($post['tanggal']),
            'jumlah_buku' => htmlentities($post['jumlah_buku']),
            'status' => htmlentities($post['status']),
            'sumber_bantuan' => htmlentities($post['sumber_bantuan']),
        );

        $this->db->insert('tbl_bukumasuk', $data);

        $this->session->set_flashdata('pesan', '<div id="notifikasi"><div class="alert alert-success">
        <p> Tambah Pengunjung Sukses !</p>
        </div></div>');
        redirect(base_url('buku_masuk'));
    }
		// edit aksi form proses buku
		if(!empty($this->input->post('edit')))
		{
			$post = $this->input->post();
			$data = array(
				
				'judul'=>htmlentities($post['judul']), 
				'pengarang'=>htmlentities($post['pengarang']), 
				'penerbit' => htmlentities($post['penerbit']),  
				'tahun'=> htmlentities($post['tahun']), 
				'tanggal'=> htmlentities($post['tanggal']),     
				'jumlah_buku' => htmlentities($post['jumlah_buku']), 
				'status' => htmlentities($post['status']), 
				'sumber_bantuan' => htmlentities($post['sumber_bantuan']), 
			);
						
			$this->db->where('id',htmlentities($post['edit']));
			$this->db->update('tbl_bukumasuk', $data);

			$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-success">
					<p> Edit Buku Masuk berhasil!</p>
				</div></div>');
				redirect(base_url('buku_masuk'));  
		}
	}
    public function del()
    {
        if($this->uri->segment('3') == ''){ echo '<script>alert("halaman tidak ditemukan");window.location="'.base_url('pengunjung').'";</script>';}
        
        $user = $this->M_Admin->get_tableid_edit('tbl_bukumasuk','id',$this->uri->segment('3'));
        unlink('./assets_style/image/'.$user->foto);
		$this->M_Admin->delete_table('tbl_bukumasuk','id',$this->uri->segment('3'));
		
		$this->session->set_flashdata('pesan','<div id="notifikasi"><div class="alert alert-danger">
		<p> Berhasil Hapus Buku_masuk !</p>
		</div></div>');
		redirect(base_url('buku_masuk'));  
    }
}
