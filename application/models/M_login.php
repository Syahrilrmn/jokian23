<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Login extends CI_Model
{

    function GET_LOGIN($email, $pass)
    {
        $row = $this->db->query("SELECT * FROM tbl_login WHERE email ='$email' AND pass = '$pass'");
        return $row;
    }

    function insertTable($table_name, $data)
    {
        $tambah = $this->db->insert($table_name, $data);
        return $tambah;
    }

    function cek_user($email)
    {
        $query = $this->db->get_where('tbl_login', array('email' => $email));
        return $query->num_rows();
    }
    public function hitungJumlahPinjaman($anggota_id)
    {
        $this->db->select('COUNT(*) as jml_pinjam');
        $this->db->from('tbl_pinjam');
        $this->db->where('anggota_id', $anggota_id);
        $this->db->where('status', 'Dipinjam');

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result->jml_pinjam;
        } else {
            return 0;
        }
    }
    public function hitungJumlahkembali($anggota_id)
    {
        $this->db->select('COUNT(*) as jml_pinjam');
        $this->db->from('tbl_pinjam');
        $this->db->where('anggota_id', $anggota_id);
        $this->db->where('status', 'Di kembalikan');

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result->jml_pinjam;
        } else {
            return 0;
        }
    }

    public function statusPinjam($anggota_id){ 
        $this->db->select('tgl_balik,jml_pinjam');
        $this->db->from('tbl_pinjam');
        $this->db->where('anggota_id', $anggota_id);
        $this->db->where('status', 'Dipinjam');

        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // ...
}
?>
