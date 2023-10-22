<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class FilterModel extends CI_Model
{
  private $tabel = "tbl_pengunjung";
  public function get_kunjung()
  {
    return $this->db->get($this->tabel)->result_array();
  }
  public function view_all()
  {
    return $this->db->get('tbl_pengunjung')->result_array(); // Tampilkan semua data filter
  }
  public function view_by_date($tgl_awal, $tgl_akhir)
  {
    $tgl_awal = $this->db->escape($tgl_awal);
    $tgl_akhir = $this->db->escape($tgl_akhir);
    $this->db->where('DATE(tgl_kunjung) BETWEEN ' . $tgl_awal . ' AND ' . $tgl_akhir);  // Tambahkan where tanggal nya
    return $this->db->get('tbl_pengunjung')->result_array(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
  }
  //buku masuk//
  private $tabel2 = "tbl_bukumasuk";
  public function get_bukumasuk()
  {
    return $this->db->get($this->tabel2)->result_array();
  }
  public function view_semuabuku()
  {
    return $this->db->get('tbl_bukumasuk')->result_array(); // Tampilkan semua data filter
  }
  public function view_by_tanggal($tgl_awal, $tgl_akhir)
  {
    $tgl_awal = $this->db->escape($tgl_awal);
    $tgl_akhir = $this->db->escape($tgl_akhir);
    $this->db->where('DATE(tanggal) BETWEEN ' . $tgl_awal . ' AND ' . $tgl_akhir);  // Tambahkan where tanggal nya
    return $this->db->get('tbl_bukumasuk')->result_array(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
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

  public function view_by_tahun($thn_buku)
  {
      $this->db->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
      $this->db->from('tbl_buku');
      $this->db->join('tbl_kategori', 'tbl_buku.id_kategori = tbl_kategori.id_kategori');
      $this->db->join('tbl_rak', 'tbl_buku.id_rak = tbl_rak.id_rak');
      $this->db->where('YEAR(tbl_buku.thn_buku)', $thn_buku);

      $query = $this->db->get();
      return $query->result_array();
  }
}
