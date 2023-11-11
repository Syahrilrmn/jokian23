<?php if (!defined('BASEPATH')) exit('No direct script acess allowed');

class M_Admin extends CI_Model
{
  private $tabel = "tbl_anggota";
  
  private $tabel2 = "tbl_login";
  
  private $tabel3 = "tbl_buku";
  
  private $tabel4 = "tbl_pinjam";
  

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
  

  
  
  

  



}
