<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-edit" style="color:green"> </i> Daftar Data Buku Masuk
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
            <li class="active"><i class="fa fa-file-text"></i>&nbsp; Daftar Data Buku Masuk</li>
        </ol>
    </section>
    <section class="content">
        <?php if (!empty($this->session->flashdata())) {
            echo $this->session->flashdata('pesan');
        } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <!-- /.box-header -->
                    <form method="get" action="<?php echo base_url('buku_masuk/laporan') ?>">
                        <div class="row" style="margin-top:20px; margin-left:15px;">
                            <label style="position:absolute; padding-left:10px; padding-top:10px;">Filter Tanggal</label>
                            <div class="col-sm-6 col-md-4">

                                <div class="form-group" style="display: flex; margin-left:60px;">

                                    <div class="input-group" style="margin-left: 30px; ">
                                        <input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                                    </div>
                                    <button>S/d</button>
                                    <div class="input-group">
                                        <input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                                    </div>
                                    <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>
                                    <?php
                                    if (isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                                        echo '<a href="' . base_url('buku_masuk/laporan') . '" class="btn btn-danger">RESET</a>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="n" style="margin-left: 27px;">
                        <?php echo $label ?><br />
                        <a href="<?php echo $url_cetak ?>" target="_blank">
                            <button class="btn btn-info" style="font-size: 16px; margin-top:5px; "><i class="fa fa-print" style="font-size: 20px; "></i><span style="padding-left: 15px;">Cetak Data</span> </button>
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <br />
                            <table id="example1" class="table table-bordered table-striped table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <!-- <th>Buku_ID</th> -->
                                        <th>Kode Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Buku</th>
                                        <th>Tanggal masuk</th>
                                        <th>Jumlah Buku</th>
                                        <th>Status</th>
                                        <th>Sumber Bantuan</th>
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
                                    foreach ($buku_masuk as $isi) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <!-- <td><?= $isi['buku_id']; ?></td> -->
                                            <td><?= $isi['kode_buku']; ?></td>
                                            <td><?= $isi['judul']; ?></td>
                                            <td><?= $isi['pengarang']; ?></td>
                                            <td><?= $isi['penerbit']; ?></td>
                                            <td><?= $isi['tahun']; ?></td>
                                            <td><?= date('d', strtotime($isi['tanggal'])); ?> <?= $namaBulan[date('n', strtotime($isi['tanggal']))]; ?> <?= date('Y', strtotime($isi['tanggal'])); ?></td>
                                            <td><?= $isi['jumlah_buku']; ?></td>
                                            <td><?= $isi['status']; ?></td>
                                            <td><?= $isi['sumber_bantuan']; ?></td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>