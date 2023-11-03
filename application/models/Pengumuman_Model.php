<?php


class Pengumuman_Model extends CI_Model{
    public function get_pengumuman_list(){
        $this->db->order_by('ID_Pengumuman', 'DESC');
        return $this->db->get('pengumumantugas')->result();
    }

    public function get_pengumuman_list_for_users(){
        $this->db->select('*');
        $this->db->from('pengumumantugas');
        $this->db->where('DATE_FORMAT(Tanggal, "%Y-%m-%d") =', date('Y-m-d'));
        return $this->db->get()->result();
    }
    
    
    
    public function storePengumuman() {
        $pegawaiTujuan = $this->input->post('namaPegawai');
        $isiPengumuman = $this->input->post('isiPengumuman');
        $tanggal = $this->input->post('tanggal');
    
        $data = [
            'Isi_Pengumuman' => json_encode($this->groupData($pegawaiTujuan, $isiPengumuman)),
            'tanggal' => $tanggal
        ];
    
        $this->db->insert('pengumumantugas', $data);
        if ($this->db->affected_rows() > 0) {
            $status = 'Berhasil';
            $pesan = 'Data Pengumuman Berhasil diTambahkan';
        } else {
            $status = 'Gagal';
            $pesan = 'Data Pengumuman Gagal diTambahkan';
        }
        $this->session->set_flashdata('status', $status);
        $this->session->set_flashdata('pesan', $pesan);
    }
    
    // Fungsi untuk mengelompokkan data menjadi objek array
    private function groupData($pegawaiTujuan, $isiPengumuman) {
        $groupedData = [];
        for ($i = 0; $i < count($pegawaiTujuan); $i++) {
            $groupedData[] = [
                'Pegawai_Tujuan' => $pegawaiTujuan[$i],
                'Isi_Pengumuman' => $isiPengumuman[$i]
            ];
        }
        return $groupedData;
    }
    
    public function get_pengumuman_by_id($id){
        return $this->db->get_where('pengumumantugas',['ID_Pengumuman'=>$id])->row();
    }


    public function update_pengumuman($id){
        $data=[
            'Pegawai_Tujuan'=>$this->input->post('namaPegawai'),
            'Isi_Pengumuman'=>$this->input->post('isiPengumuman'),
            'tanggal'=>$this->input->post('tanggal')
        ];
        $this->db->update('solar',$data,['ID_Pengumuman'=>$id]);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('status','Berhasil');
            $this->session->set_flashdata('pesan','Data Pengumuman Berhasil Di Update');
        }else{
            $this->session->set_flashdata('status','Gagal');
            $this->session->set_flashdata('pesan','Data Solar Gagal Update');
        }
    }

    
    public function get_total_records()
    {
        return $this->db->count_all('pengumumantugas'); // Gantilah 'table_name' sesuai tabel Anda
    }
    
    public function delete_pengumuman($id){
        $this->db->delete('pengumumantugas',['ID_Pengumuman'=>$id]);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('status','Berhasil');
            $this->session->set_flashdata('pesan','Data Pengumuman Berhasil Di Hapus');
        }else{
            $this->session->set_flashdata('status','Gagal');
            $this->session->set_flashdata('pesan','Data Solar Gagal Di Hapus');
        }
    }
}