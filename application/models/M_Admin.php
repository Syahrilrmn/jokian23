<?php if (!defined('BASEPATH')) exit('No direct script acess allowed');

class M_Admin extends CI_Model
{
  private $tabel = "tbl_anggota";
  public function get_anggotaa()
  {
    return $this->db->get($this->tabel)->result();
  }
  private $tabel2 = "tbl_login";
  public function get_userr()
  {
    return $this->db->get($this->tabel2)->result();
  }
  private $tabel3 = "tbl_buku";
  public function get_bukuu()
  {
    return $this->db->get($this->tabel3)->result();
  }
  private $tabel4 = "tbl_pinjam";
  public function get_pinjamm()
  {
    return $this->db->get($this->tabel4)->result();
  }


  public function __construct()
  {
    parent::__construct();
    //validasi jika user belum login
  }

  public function get_table($table_name)
  {
    $get_user = $this->db->get($table_name);
    $get_anggota = $this->db->get($table_name);
    $get_pengunjung = $this->db->get($table_name);
    $get_pengunjung = $this->db->get($table_name);
    $get_buku = $this->db->get($table_name);
    $get_denda = $this->db->get($table_name);

    return $get_user->result_array();
    return $get_anggota->result_array();
    return $get_pengunjung->result_array();
    return $get_buku->result_array();
    return $get_denda->result_array();
  }

  public function get_tableid($table_name, $where, $id)
  {
    $this->db->where($where, $id);
    $edit = $this->db->get($table_name);
    return $edit->result_array();
  }

  public function get_tableid_edit($table_name, $where, $id)
  {
    $this->db->where($where, $id);
    $edit = $this->db->get($table_name);
    return $edit->row();
  }

  public function add_multiple($table, $data = array())
  {
    $total_array = count($data);

    if ($total_array != 0) {
      $this->db->insert_batch($table, $data);
    }
  }

  public function insertTable($table_name, $data)
  {
    $tambah = $this->db->insert($table_name, $data);
    return $tambah;
  }

  public function LastinsertId($table_name, $data)
  {
    $this->db->insert($table_name, $data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }

  public function update_table($table_name, $where, $id, $data)
  {
    $this->db->where($where, $id);
    $update = $this->db->update($table_name, $data);
    return $update;
  }

  public function delete_table($table_name, $where, $id)
  {
    $this->db->where($where, $id);
    $hapus = $this->db->delete($table_name);
    return $hapus;
  }

  public function delete_table_multiple($table_name, $where, $id)
  {
    if (!empty($id)) {
      $this->db->where_in($where, $id);
      $hapus = $this->db->delete($table_name);
      return $hapus;
    }
  }

  public function edit_table($table_name, $where, $id)
  {
    $this->db->where($where, $id);
    $edit = $this->db->get($table_name);
    return $edit->row();
  }

  public function CountTable($table_name)
  {
    $Count = $this->db->get($table_name);
    return $Count->num_rows();
  }

  public function CountTableId($table_name, $where, $id)
  {
    $this->db->where($where, $id);
    $Count = $this->db->get($table_name);
    return $Count->num_rows();
  }

  public function SelectTable($table_name, $query, $id, $orderby)
  {
    $this->db->select($query, false); // select('RIGHT(user.id_odojers,4) as kode', FALSE);
    $this->db->order_by($id, $orderby);
    $query = $this->db->get($table_name); // cek dulu apakah ada sudah ada kode di tabel.
    return $query;
  }

  public function SelectTableSQL($query)
  {
    $row = $this->db->query($query);
    return $row;
  }
  //tabel get
  public function get_user($user)
  {
    $this->db->where('id_login', $user);
    $get_user = $this->db->get('tbl_login');
    return $get_user->row();
  }
  public function get_anggota($anggota)
  {
    $this->db->where('id_login', $anggota);
    $get_anggota = $this->db->get('tbl_login');
    return $get_anggota->row();
  }
  public function get_barang($barang)
  {
    $this->db->where('ID_Barang', $barang);
    $get_buku = $this->db->get('barang');
    return $get_buku->row();
  }
  public function get_pengunjung($pengunjung)
  {
    $this->db->where('id_pengunjung', $pengunjung);
    $get_pengunjung = $this->db->get('tbl_pengunjung');
    return $get_pengunjung->row();
  }
  public function get_pinjam($pinjam)
  {
    $this->db->where('id_pinjam', $pinjam);
    $get_pinjam = $this->db->get('tbl_pinjam');
    return $get_pinjam->row();
  }
  public function get_denda($denda)
  {
    $this->db->where('id_denda', $denda);
    $get_denda = $this->db->get('tbl_denda');
    return $get_denda->row();
  }
  public function get_pinjammm()
  {
    $this->db->select(['a.id_buku', 'b.id_pinjam', 'b.pinjam_id', 'b.anggota_id', 'b.buku_id', 'b.status', 'b.tgl_pinjam', 'b.tgl_balik', 'b.tgl_kembali', 'b.jml_pinjam']);
    $this->db->from('tbl_pinjam b');
    $this->db->join('tbl_buku a', 'a.id_buku = b.buku_id', 'inner');
    $this->db->order_by('b.id_pinjam', 'DESC');
    $return = $this->db->get('');
    return $return->result_array();
  }

  public function rp($angka)
  {
    $hasil_rupiah = "Rp" . number_format($angka, 0, ',', '.') . ',-';
    return $hasil_rupiah;
  }


  public function buat_kode($table_name, $kodeawal, $idkode, $orderbylimit)
{
    $query = $this->db->query("SELECT * FROM $table_name $orderbylimit"); // cek apakah ada sudah ada kode di tabel.

    if ($query->num_rows() > 0) {
        // jika kode ternyata sudah ada.
        $hasil = $query->row();
        $kd = $hasil->$idkode;
        $cd = substr($kd, strlen($kodeawal) + 1); // ambil angka dari kode yang ada
        $kode = $cd + 1;
        $kodejadi = $kodeawal . "-" . sprintf("%04d", $kode); // hasilnya PJ-0001 dst.
    } else {
        // jika kode belum ada
        $kode = 1;
        $kodejadi = $kodeawal . "-" . sprintf("%04d", $kode); // hasilnya PJ-0001 dst.
    }

    return $kodejadi;
}


  public function buat_kode_join($table_name, $kodeawal, $idkode)
  {
    $query = $this->db->query($table_name); // cek dulu apakah ada sudah ada kode di tabel.
    if ($query->num_rows() > 0) {
      //jika kode ternyata sudah ada.
      $hasil = $query->row();
      $kd = $hasil->$idkode;
      $cd = $kd;
      $kode = $cd + 1;
      $kodejadi = $kodeawal . "00" . $kode;    // hasilnya CUS-0001 dst.
      $kdj = $kodejadi;
    } else {
      //jika kode belum ada
      $kode = 0 + 1;
      $kodejadi = $kodeawal . "00" . $kode;    // hasilnya CUS-0001 dst.
      $kdj = $kodejadi;
    }
    return $kdj;
  }

  public function acak($panjang)
  {
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter) - 1);
      $string .= $karakter[$pos];
    }
    return $string;
  }


  // -------------------------------------new revisi-------------------------------------------
  public function generate_kode_barang()
  {
    $query = $this->db->query("SELECT MAX(RIGHT(kode_barang,4)) as max_kode FROM barang");
    $kode = intval($query->row()->max_kode);
    $kode = $kode + 1;
    $kode_max = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $kode_barang = "BRG" . $kode_max;
    return $kode_barang;
  }
  public function generate_kode_bukumasuk()
  {
    $query = $this->db->query("SELECT MAX(RIGHT(buku_id,3)) as max_kode FROM tbl_bukumasuk");
    $kode = intval($query->row()->max_kode);
    $kode = $kode + 1;
    $kode_max = str_pad($kode, 3, "0", STR_PAD_LEFT);
    $kode_barang = "BKM" . $kode_max;
    return $kode_barang;
  }
  public function generate_kode_anggota()
  {
    $query = $this->db->query("SELECT MAX(RIGHT(kode_anggota,4)) as max_kode FROM tbl_anggota");
    $kode = intval($query->row()->max_kode);
    $kode = $kode + 1;
    $kode_max = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $kode_barang = "AGT" . $kode_max;
    return $kode_barang;
  }
  public function generate_kode_pengguna()
  {
    $query = $this->db->query("SELECT MAX(RIGHT(anggota_id,4)) as max_kode FROM tbl_login");
    $kode = intval($query->row()->max_kode);
    $kode = $kode + 1;
    $kode_max = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $kode_barang = "AGT" . $kode_max;
    return $kode_barang;
  }
  public function getDataBuku()
  {
    // $this->db->join('t_kth c', 'c.id = b.kth', 'inner');
    // $this->db->order_by('b.id', 'ASC');
    $this->db->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
    $this->db->from('tbl_buku');
    $this->db->join('tbl_kategori', 'tbl_buku.id_kategori = tbl_kategori.id_kategori');
    $this->db->join('tbl_rak', 'tbl_buku.id_rak = tbl_rak.id_rak');
    $return = $this->db->get();
    return $return->result_array();
  }
  public function getDataview()
  {
    $this->db->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
    $this->db->from('tbl_buku');
    $this->db->join('tbl_kategori', 'tbl_buku.id_kategori = tbl_kategori.id_kategori');
    $this->db->join('tbl_rak', 'tbl_buku.id_rak = tbl_rak.id_rak');

    // Menggunakan CAST untuk mengonversi jumlah_view menjadi angka sebelum pengurutan
    $this->db->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.nama_rak, CAST(tbl_buku.jumlah_view AS SIGNED) AS numeric_view', false);

    // Mengurutkan berdasarkan numeric_view yang sudah dikonversi
    $this->db->order_by('numeric_view', 'DESC');

    $return = $this->db->get();
    return $return->result_array();
  }

  public function generate_kode_buku()
  {
    $query = $this->db->query("SELECT MAX(RIGHT(buku_id,3)) as max_kode FROM tbl_buku");
    $kode = intval($query->row()->max_kode);
    $kode = $kode + 1;
    $kode_max = str_pad($kode, 3, "0", STR_PAD_LEFT);
    $kode_barang = "BK" . $kode_max;
    return $kode_barang;
  }

  // statistik

  public function getVisitorStatistics()
  {
    // Query untuk mengambil statistik pengunjung per bulan
    $query = $this->db->query("SELECT DATE_FORMAT(tgl_kunjung, '%Y-%m') AS month, COUNT(*) AS count
                             FROM tbl_pengunjung
                             GROUP BY month
                             ORDER BY month");

    return $query->result();
  }
  public function getGenderStatistics()
  {
      // Query untuk mengambil statistik anggota berdasarkan jenis kelamin
      $query = $this->db->query("SELECT jenkel, COUNT(*) AS count
                             FROM tbl_login
                             GROUP BY jenkel");

      return $query->result();
  }
}
