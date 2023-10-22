<?php if (!defined('BASEPATH')) {
    exit('No direct script acess allowed');
} ?>


<style>
    table {
        font-size: 14px;

    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    thead {
        font-size: 16px;
    }

    .judul h3,
    h2,
    p {
        text-align: center;
        margin: 5px 0 5px 0;
    }

    .form-inline img {

        display: inline-block;
    }

    h2 {
        font-size: 30px;
    }

    .kop tr td {
        /* margin-right:100px; */
        text-align: center;
        border: 2px solid white;
        border-collapse: collapse;
    }

    .gambar {
        margin-right: 10px;
    }

    .isi tr td {
        padding-left: 5px;
        padding-right: 5px;
    }

    .ttd {
        text-align: center;
        display: inline-block;
        float: right;
    }
</style>

<script>
    window.load = print_d();

    function print_d() {
        window.print();
    }
    window.onfocus = function() {
        window.close();
    }
</script>

<title>Laporan Buku</title>


<!-- <div class="gambar" style="position: absolute; margin-left:10%;">
    <img src="<?php echo base_url('assets_style/image/logo_pln.png'); ?>" alt="" height="80" width="100">
</div> -->
<div class="container-fluid">
    <center>
        <table class="kop">
            <tr style="margin-right: 10px;">
                <td rowspan="5"><img src="<?php echo base_url('assets_style/image/logo-mts.png'); ?>" height="80" alt="" class="gambar"></td>
            </tr>

            <tr style="margin-left: 20px;">
                <td style="font-size: 20px; font-weight: bold;">PERPUSTAKAAN MTS SYEKH KHALID ASTAMBUL</td>
            </tr>
            <tr>
                <td style=" font-style:italic">Alamat: Jl. Jembatan Gantung Pingaran Ilir RT.01 Kec. Astambul, Kab.Banjar, Kalimantan Selatan 70671</td>
            </tr>
        </table>
    </center>



    <hr size="2px" color="black" style="margin-bottom: 1px;">
    <hr size="2px" color="black" style="margin-top: 1px;">
    <center>
        <br>
        <table class="kop">
            <td style="font-size: 30px; font-weight: bold;">Laporan Data Peminjam</td>
        </table>
    </center>
    <br><br>
    <div>
        <table class="isi" style="width:100%;">
            <thead style="line-height: 40px;">

                <tr>
                    <th>No</th>
                    <th>No Pinjam</th>
                    <th>ID Anggota</th>
                    <th>Nama Peminjam</th>
                    <th>Nama_buku</th>
                    <th>Nama kategori</th>
                    <th>Pinjam</th>
                    <th>Balik</th>
                    <th style="width:10%">Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($pinjam->result_array() as $isi) {
                    $anggota_id = $isi['anggota_id'];
                    // $ang = $this->db->query("SELECT * FROM tbl_login WHERE anggota_id = '$anggota_id'")->row();

                    $pinjam_id = $isi['pinjam_id'];
                    $denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
                    $total_denda = $denda->row();
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $isi['pinjam_id']; ?></td>
                        <td><?= $isi['anggota_id']; ?></td>
                        <td><?= $isi['nama'] ?></td>
                        <td><?= $isi['title']; ?></td>
                        <td><?= $isi['nama_kategori']; ?></td>
                        <td><?= $isi['tgl_pinjam']; ?></td>
                        <td><?= $isi['tgl_balik']; ?></td>
                        <td><?= $isi['status']; ?></td>
                        <td>
                            <?php
                            if ($isi['status'] == 'Di Kembalikan') {
                                echo $this->M_Admin->rp($total_denda->denda);
                            } elseif ($isi['status'] == 'Booking' || $isi['status'] == 'Batal') {
                                echo '<p style="color:green;">Denda Tidak Aktif</p>';
                            } else {
                                $jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();
                                $date1 = date('Ymd');
                                $date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']); // Mengambil tanggal pengembalian

                                $dueDate = date('Ymd', strtotime("+7 days", strtotime($date2)));

                                if ($date1 > $dueDate) {
                                    $diff = $date1 - $dueDate;
                                    echo $diff . ' hari';
                                    $dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
                                    echo '<p style="color:red;font-size:18px;">' . $this->M_Admin->rp($jml * ($dd->harga_denda * $diff)) . '</p><small style="color:#333;">* Untuk ' . $jml . ' Buku</small>';
                                } else {
                                    echo '<p>Tidak Ada Denda</p>';
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>

    <div class="ttd" style="display: inline-block; margin-right:70px;">

        <br>
        <br>
        <br>
        <br>
        <span style="font-size:16px; font-weight:bold; font-family: Times New Roman; ">Astambul, <span id="tanggal"></span></span>
        <br>
        <span style="font-size:16px; font-weight:bold; font-family: Times New Roman;">Penanggung Jawab</span>
        <br>
        <br>
        <br>
        <br>
        <h4 style="margin-bottom: 1px;"></h4>
        <?php
        $d = $this->db->query("SELECT * FROM tbl_login WHERE id_login")->row();
        ?>
        <span style="font-size:16px; font-weight:bold; font-family: Times New Roman;"><?= $d->nama; ?></span>
        <hr size="2px" color="black" style="margin-top: 1px;">
        <h4 style="margin-top: 1px; margin-right:120px;">NIP .</h4>

    </div>

    <script>
        // Mendapatkan tanggal saat ini
        var today = new Date();

        // Array untuk nama bulan dalam bahasa Indonesia
        var namaBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // Mendapatkan nilai tanggal, bulan, dan tahun saat ini
        var tanggal = today.getDate();
        var bulan = namaBulan[today.getMonth()];
        var tahun = today.getFullYear();

        // Menampilkan tanggal dalam format Indonesia pada elemen dengan id "tanggal"
        document.getElementById("tanggal").innerText = +tanggal + " " + bulan + " " + tahun;
    </script>

</div>