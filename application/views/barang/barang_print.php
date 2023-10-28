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

<title>Laporan Barang</title>

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
            <td style="font-size: 30px; font-weight: bold;">Laporan Data Barang</td>
        </table>
    </center>

    <!-- <span style="padding-left:200px;">
   
    </span> -->


    <br><br>
    <div>
        <table class="isi" style="width:100%;">
            <thead style="line-height: 20px;">

                <tr>
                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Stok</th>

                </tr>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $namaBulan = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ];
                if (empty($databarang)) {
                    echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                } else {
                    foreach ($databarang as $isi) { ?>
                        <tr>
                        <td>
                                        <?= $no; ?>
                                    </td>
                                    <td>
                                        <?= $isi['kode_barang']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['Nama_Barang']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['Stok']; ?>
                                    </td>

                        </tr>
                <?php $no++;
                    }
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
        <span style="font-size:16px; font-weight:bold; font-family: Times New Roman;"><?= $d->user; ?></span>
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