<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-edit" style="color:green"> </i> <?= $title_web; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
            <li class="active"><i class="fa fa-file-text"></i>&nbsp; <?= $title_web; ?></li>
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
                        <?php if ($this->session->userdata('level') == 'Petugas') { ?>
                            <a href="buku_masuk/tambah"><button class="btn btn-primary">
                                    <i class="fa fa-plus"> </i> Tambah Buku Masuk</button></a>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br />
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Buku_ID</th>
                                        <th>Kode Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Buku</th>
                                        <th>Tanggal masuk</th>
                                        <th>Jumlah Buku</th>
                                        <th>Status</th>
                                        <th>Sumber Bantuan</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
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
                                            <td><?= $isi['buku_id']; ?></td>
                                            <td><?= $isi['kode_buku']; ?></td>
                                            <td><?= $isi['judul']; ?></td>
                                            <td><?= $isi['pengarang']; ?></td>
                                            <td><?= $isi['penerbit']; ?></td>
                                            <td><?= $isi['tahun']; ?></td>
                                            <td><?= date('d', strtotime($isi['tanggal'])); ?> <?= $namaBulan[date('n', strtotime($isi['tanggal']))]; ?> <?= date('Y', strtotime($isi['tanggal'])); ?></td>
                                            <td><?= $isi['jumlah_buku']; ?></td>
                                            <td><?= $isi['status']; ?></td>
                                            <td><?= $isi['sumber_bantuan']; ?></td>
                                            <td>
                                                <center>
                                                    <a href="<?= base_url('buku_masuk/bukuedit/' . $isi['id']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="<?= base_url('buku_masuk/del/' . $isi['id']); ?>" onclick="return confirm('Anda yakin Buku Masuk akan dihapus ?');">
                                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>

                                                </center>

                                            </td>
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