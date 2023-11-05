<?php


class Solar_Model extends CI_Model{
    public function get_solar_list(){
        $this->db->order_by('ID_solar', 'DESC');
        return $this->db->get('solar')->result();
    }
    
    public function storeSolar(){
        $data=[
            'jumlah_stok'=>$this->input->post('jumlahSolar')
        ];
        $this->db->insert('solar',$data);
        if ($this->db->affected_rows() > 0) {
            $status = 'Berhasil';
            $pesan = 'Data Solar Berhasil diTambahkan';
        } else {
            $status = 'Gagal';
            $pesan = 'Data Solar Gagal diTambahkan';
        }
        $this->session->set_flashdata('status', $status);
        $this->session->set_flashdata('pesan', $pesan);
        
    }

    public function get_solar_by_id($id){
        return $this->db->get_where('solar',['ID_Solar'=>$id])->row();
    }


    public function update_solar($id){
        $data=[
            'jumlah_stok'=>$this->input->post('jumlahSolar')
        ];
        $this->db->update('solar',$data,['ID_Solar'=>$id]);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('status','Berhasil');
            $this->session->set_flashdata('pesan','Data Solar Berhasil Di Edit');
        }else{
            $this->session->set_flashdata('status','Gagal');
            $this->session->set_flashdata('pesan','Data Solar Gagal diTambahkan');
        }
    }

    public function delete_solar($id){
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