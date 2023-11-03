<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_Barang extends CI_Model {
    public function hapus_barang($id_barang) {
        // Menghapus data dari tabel 'barang' berdasarkan ID_Barang
        $this->db->where('ID_Barang', $id_barang);
        $this->db->delete('barang');
    }
}
?>