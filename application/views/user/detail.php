<?php
error_reporting(0);
if (!empty($_GET['download'] == 'doc')) {
    header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=" . date('d-m-Y') . "_laporan_rekam_medis.doc");
}
if (!empty($_GET['download'] == 'xls')) {
    header("Content-Type: application/force-download");
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: 0");
    header("content-disposition: attachment;filename=" . date('d-m-Y') . "_laporan_rekam_medis.xls");
}
?>
<?php
$tgla = $user->tgl_bergabung;
$tglk = $user->tgl_lahir;
$bulan = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
);

$array1 = explode("-", $tgla);
$tahun = $array1[0];
$bulan1 = $array1[1];
$hari = $array1[2];
$bl1 = $bulan[$bulan1];
$tgl1 = $hari . ' ' . $bl1 . ' ' . $tahun;

$array2 = explode("-", $tglk);
$tahun2 = $array2[0];
$bulan2 = $array2[1];
$hari2 = $array2[2];
$bl2 = $bulan[$bulan2];
$tgl2 = $hari2 . ' ' . $bl2 . ' ' . $tahun2;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_style/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_style/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <title><?= $title_web; ?></title>
    <style>
        body {
            background: rgba(0, 0, 0, 0.2);
        }

        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5pc;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            padding-left: 2.54cm;
            padding-right: 2.54cm;
            padding-top: 1.54cm;
            padding-bottom: 1.54cm;
        }

        @media print {
            body, page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>
<body>
<br/>
<button type="button" style="margin-left: 81.7em;" class="btn btn-success btn-md" onclick="printDiv('printableArea')">
    <i class="fa fa-print"></i> Print File
</button>
<div id="printableArea">
    <page size="A4">
        <div class="panel panel-default">
            <div class="panel-body bg-primary">
			    <div class="rata" style="display:flex;position:absolute;">
			     <img src="<?php echo base_url('assets_style/image/logo-mts.png'); ?>" height="80" width="80" alt="" class="gambar" style="margin-left:10px;">
                  <span class="text-center" style="padding-left:60px; padding-top:30px; font-family: Times New Roman; font-size:15px;"> PERPUSTAKAAN MTS SYEKH KHALID</span>
				  
				</div>
				<span style="padding-left:40%; font-size:20px; font-family: Times New Roman; font-size:15px;" >KARTU ANGGOTA</span>
				<br>
				
                <div class="row" style="margin-top:60px;">
                    <div class="col-sm-8">
                        <table class="table table-stripped">
                            <tr>
                                <td>ID Anggota</td>
                                <td>:</td>
                                <td><?= $user->anggota_id; ?></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><?= $user->nama; ?></td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>:</td>
                                <td><?= $user->tempat_lahir; ?>, <?= $tgl2; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $user->alamat; ?></td>
                            </tr>
                            <tr>
                                <td>Tgl Bergabung</td>
                                <td>:</td>
                                <td><?= $tgl1; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4 text-center">
                        <center>
                            <img src="<?php echo base_url(); ?>assets_style/image/pengguna/<?php echo $user->foto; ?>"
                                 style="width:3cm;height:4cm;" class="img-responsive">
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </page>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
</body>
</html>
