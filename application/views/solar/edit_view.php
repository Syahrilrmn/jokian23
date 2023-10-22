<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-edit" style="color:green"> </i> <?= $title_web; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
            <li class="active"><i class="fa fa-edit"></i>&nbsp; <?= $title_web; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo base_url('buku_masuk/prosesbuku'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>Judul Buku</label>
                                        <input type="text" class="form-control" value="<?= $buku_masuk->judul; ?>" name="judul" placeholder="Contoh : Cara Cepat Belajar Pemrograman Web">
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Pengarang</label>
                                        <input type="text" class="form-control" value="<?= $buku_masuk->pengarang; ?>" name="pengarang" placeholder="Nama Pengarang">
                                    </div>
                                    <div class="form-group">
                                        <label>Penerbit</label>
                                        <input type="text" class="form-control" value="<?= $buku_masuk->penerbit; ?>" name="penerbit" placeholder="Nama Penerbit">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Buku</label>
                                        <input type="number" class="form-control" value="<?= $buku_masuk->tahun; ?>" name="tahun" placeholder="Tahun Buku : 2019">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>jumlah Buku</label>
                                        <input type="number" class="form-control" value="<?= $buku_masuk->jumlah_buku; ?>" name="jumlah_buku" placeholder="Tahun Buku : 2019">
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Masuk Buku</label>
                                        <input type="date" class="form-control" value="<?= $buku_masuk->tanggal; ?>" name="tanggal" placeholder="Jumlah buku : 12">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required="required">

                                            <option <?php if ($buku_masuk->status == 'Baru') {
                                                        echo 'selected';
                                                    } ?>>Baru</option>
                                            <option <?php if ($buku_masuk->status == 'Bekas') {
                                                        echo 'selected';
                                                    } ?>>Bekas</option>
                                            <option <?php if ($buku_masuk->status == 'Rusak') {
                                                        echo 'selected';
                                                    } ?>>Rusak</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sumber Bantuan</label>
                                        <input type="text" class="form-control" value="<?= $buku_masuk->sumber_bantuan; ?>" name="sumber_bantuan" >
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-right: 15px;">
                                    <input type="hidden" name="edit" value="<?= $buku_masuk->id; ?>">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="<?= base_url('buku_masuk'); ?>" class="btn btn-danger btn-md">Kembali</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>