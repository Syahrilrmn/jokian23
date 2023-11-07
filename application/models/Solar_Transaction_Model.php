<?php


class Solar_Transaction_Model extends CI_Model
{
    public function get_solar_transaction_list()
    {
        $role = $this->session->userdata['level'];
        $id_user = $this->session->userdata['ses_id'];

        $this->db->select('ts.*, tl.user');
        $this->db->from('transaksi_solar ts');
        $this->db->join('tbl_login tl', 'ts.id_user = tl.id_login', 'inner');
        $this->db->order_by('ts.id_transaksi_solar', 'DESC');

        if ($role != 'Admin') {
            $this->db->where('tl.id_login', $id_user);
        }
        return $this->db->get()->result();
    }


    public function get_solar_transaction_by_user()
    {
        $id_user = $this->session->userdata['ses_id'];
        $this->db->order_by('id_transaksi_solar', 'DESC');
        return $this->db->get_where('transaksi_solar', ['id_user' => $id_user])->result();
    }

    public function get_solar_transaction_by_user_month()
    {
        $id_user = $this->session->userdata['ses_id'];

        // Dapatkan bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');

        $this->db->where('id_user', $id_user);

        // Tambahkan kondisi untuk bulan dan tahun saat ini
        $this->db->where('MONTH(tanggal_pengambilan)', $currentMonth);
        $this->db->where('YEAR(tanggal_pengambilan)', $currentYear);
        $this->db->order_by('id_transaksi_solar', 'DESC');

        return $this->db->get('transaksi_solar')->result();
    }
    public function getDataByDateRange($start_date, $end_date)
    {
        $role = $this->session->userdata['level'];
        $id_user = $this->session->userdata['ses_id'];

        $this->db->select('ts.id_transaksi_solar, ts.*, tl.user');
        $this->db->from('transaksi_solar ts');
        $this->db->join('tbl_login tl', 'ts.id_user = tl.id_login', 'left');
        $this->db->where("ts.tanggal_pengambilan BETWEEN '$start_date' AND '$end_date'", null, false);
        $this->db->group_by('ts.id_transaksi_solar');
        $this->db->order_by('ts.tanggal_pengambilan', 'asc');

        if ($role != 'Admin') {
            $this->db->where('tl.id_login', $id_user);
        }

        $query = $this->db->get();
        return $query->result();
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