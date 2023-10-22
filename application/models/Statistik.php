<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Statistik extends CI_Model
{
    // Di Model Anda (M_login.php atau Model yang relevan)
    public function getVisitorStatistics()
    {
        // Query untuk mengambil statistik pengunjung per bulan
        $query = $this->db->query("SELECT DATE_FORMAT(tgl_kunjung, '%Y-%m') AS month, COUNT(*) AS count
                               FROM tbl_pengunjung
                               GROUP BY month
                               ORDER BY month");

        return $query->result();
    }
    public function getStatistik() {
        return $this->db->query(
            "SELECT MONTH(`tgl_pinjam`) AS bulan, `status`, COUNT(*) AS jumlah
            FROM `tbl_pinjam`
            WHERE `status` IN ('Dipinjam', 'Dikembalikan')
            GROUP BY bulan, `status`
            ORDER BY bulan"
        )->result();
    }
    public function getPeminjamanPengembalianStatistik() {
        return $this->db->query(
            "SELECT MONTH(`tgl_pinjam`) AS month, `status`, COUNT(*) AS count
            FROM `tbl_pinjam`
            WHERE `status` IN ('Dipinjam', 'Dikembalikan')
            GROUP BY month, `status`
            ORDER BY month"
        )->result();
    }
    public function getBulanData() {
        $this->db->select("DATE_FORMAT(CASE WHEN status = 'Dipinjam' THEN tgl_pinjam ELSE tgl_kembali END, '%Y-%m') as month, 
                           SUM(CASE WHEN status = 'Dipinjam' THEN 1 ELSE 0 END) as dipinjam, 
                           SUM(CASE WHEN status = 'Di Kembalikan' THEN 1 ELSE 0 END) as dikembalikan");
        $this->db->from('tbl_pinjam');
        $this->db->where("status IN ('Dipinjam', 'Di Kembalikan')");
        $this->db->group_by("DATE_FORMAT(CASE WHEN status = 'Dipinjam' THEN tgl_pinjam ELSE tgl_kembali END, '%Y-%m')");
        $this->db->order_by("month", "ASC");

        $query = $this->db->get();
        return $query->result_array();
    }

}
