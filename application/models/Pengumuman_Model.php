<?php


class Pengumuman_Model extends CI_Model{
    public function get_pengumuman_list(){
        $this->db->order_by('ID_Pengumuman', 'DESC');
        return $this->db->get('pengumumantugas')->result();
    }
    
    public function storePengumuman(){
        $data=[
            'Pegawai_Tujuan'=>$this->input->post('namaPegawai'),
            'Isi_Pengumuman'=>$this->input->post('isiPengumuman'),
            'tanggal'=>$this->input->post('tanggal')
        ];
        $this->db->insert('pengumumantugas',$data);
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

    public function get_pengumuman_by_id($id){
        return $this->db->get_where('solar',['ID_Solar'=>$id])->row();
    }


    public function update_pengumuman($id){
        $data=[
            'jumlah_stok'=>$this->input->post('jumlahSolar')
        ];
        $this->db->update('solar',$data,['ID_Solar'=>$id]);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('status','Berhasil');
            $this->session->set_flashdata('pesan','Data Solar Berhasil diTambahkan');
        }else{
            $this->session->set_flashdata('status','Gagal');
            $this->session->set_flashdata('pesan','Data Solar Gagal diTambahkan');
        }
    }

    public function delete_pengumuman($id){
        $this->db->delete('solar',['ID_Solar'=>$id]);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('status','Berhasil');
            $this->session->set_flashdata('pesan','Data Solar Berhasil di hapus');
        }else{
            $this->session->set_flashdata('status','Gagal');
            $this->session->set_flashdata('pesan','Data Solar Gagal di hapus');
        }
    }
}