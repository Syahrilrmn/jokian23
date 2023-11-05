<?php


class Solar_Transaction_Model extends CI_Model
{
    public function get_solar_list()
    {
        $this->db->order_by('ID_solar', 'DESC');
        return $this->db->get('solar')->result();
    }

    public function storeSolar()
    {
        $data = [
            'tanggal_pengambilan' => $this->input->post('tanggalPengambilan'),
            'jumlah_liter' => $this->input->post('jumlahLiter'),
            'no_plat' => $this->input->post('noPlat'),
            'kendaraan' => $this->input->post('kendaraan'),
            'id_user' => $this->session->userdata['ses_id']
        ];

        $this->db->select('jumlah_stok');
        $this->db->from('solar');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $data['solar_terakhir'] = $result->jumlah_stok;
            if ($data['solar_terakhir'] === "0") {
                $response = [
                    'status' => false,
                    'message' => 'Stok Solar Sedang Habis',
                    
                ];
                return $response;
            }
            if ($data['solar_terakhir'] < $data['jumlah_liter']) {
                $response = [
                    'status' => false,
                    'message' => 'Stok Solar Tidak Mencukupi'
                ];
                return $response;
            } else {
                $jumlahStokTerbaru = $data['solar_terakhir'] - $data['jumlah_liter'];
                $this->db->set('jumlah_stok', $jumlahStokTerbaru);
                $this->db->update('solar');
            }
        } else {
            $data['solar_terakhir'] = 0;
        }

        $this->db->insert('transaksi_solar', $data);
        if ($this->db->affected_rows() > 0) {
            return $response = [
                'status' => true,
                'message' => 'Data Solar Berhasil ditambahkan'
            ];
        } else {
            return $response = [
                'status' => false,
                'message' => 'Data Solar Berhasil ditambahkan'
            ];
        }
    }



    public function get_solar_by_id($id)
    {
        return $this->db->get_where('solar', ['ID_Solar' => $id])->row();
    }


    public function update_solar($id)
    {
        $data = [
            'jumlah_stok' => $this->input->post('jumlahSolar')
        ];
        $this->db->update('solar', $data, ['ID_Solar' => $id]);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', 'Berhasil');
            $this->session->set_flashdata('pesan', 'Data Solar Berhasil Di Edit');
        } else {
            $this->session->set_flashdata('status', 'Gagal');
            $this->session->set_flashdata('pesan', 'Data Solar Gagal diTambahkan');
        }
    }

    public function delete_solar($id)
    {
        $this->db->delete('solar', ['ID_Solar' => $id]);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', 'Berhasil');
            $this->session->set_flashdata('pesan', 'Data Solar Berhasil di hapus');
        } else {
            $this->session->set_flashdata('status', 'Gagal');
            $this->session->set_flashdata('pesan', 'Data Solar Gagal di hapus');
        }
    }
}