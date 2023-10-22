<?php if (!defined('BASEPATH')) {
    exit('No direct script acess allowed');
} ?>


<style>
    table {
        font-size: 12px;

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
        font-size: 20px;
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

<title>Laporan Anggota</title>
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
        <td style=" font-style:italic">Alamat: Jl. Jembatan Gantung Pingaran Ilir RT.01  Kec. Astambul, Kab.Banjar, Kalimantan Selatan 70671</td>
    </tr>

    <!-- <tr>
<td style="font-weight: bold;">Telepon (0511) 6749696 Faksmili (0511) 6749697</td>
</tr> -->
</table>
</center>


    <hr size="2px" color="black" style="margin-bottom: 1px;">
    <hr size="2px" color="black" style="margin-top: 1px;">
    <center>
        <br>
        <table class="kop">
            <td style="font-size: 30px; font-weight: bold;">Laporan Data Anggota</td>
        </table>
    </center>
    <br><br>
    <div>
        <table class="isi" style="width:100%;">
            <thead >

                <tr>
                    <th>No</th>
                    <th>Kode_Anggota</th>
                    <!-- <th>Foto</th> -->
                    <th>Nama Anggota</th>
                    <th>User</th>
                    <th>Level</th>
                    <th>Jenis kelamin</th>
                    <th>Telepon</th>
                    <th>Alamat</th>

                </tr>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($user as $isi) { ?>
                    <tr>
                        <td>
                            <center><?= $no; ?></center>
                        </td>
                        <td><?= $isi['anggota_id']; ?></td>
                        <!-- <td>
                            <center>
                                <?php if (!empty($isi['foto'] !== "-")) { ?>
                                    <img src="<?php echo base_url(); ?>assets_style/image/pengguna/<?php echo $isi['foto']; ?>" alt="#" class="img-responsive" style="height:50px;width:50px;" />
                                <?php } else { ?>
                                    <!--<img src="" alt="#" class="user-image" style="border:2px solid #fff;"/>-->
                                    <i class="fa fa-user fa-3x" style="color:#333;"></i>
                                <?php } ?>
                            </center>
                        </td> -->

                        <td>
                            <center><?= $isi['nama']; ?></center>
                        </td>
                        <td>
                            <center><?= $isi['user']; ?></center>
                        </td>
                        <td>
                            <center><?= $isi['level']; ?></center>
                        </td>
                        <td>
                            <center><?= $isi['jenkel']; ?></center>
                        </td>
                        <td>
                            <center><?= $isi['telepon']; ?></center>
                        </td>
                        <td>
                            <center><?= $isi['alamat']; ?></center>
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

</div>