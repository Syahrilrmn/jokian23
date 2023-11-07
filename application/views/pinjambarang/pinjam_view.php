<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
    <?php
        if (!empty($this->session->flashdata('pesan'))) {
            if ($this->session->flashdata('status') == 'Berhasil') { ?>
                <div class="alert alert-success alert-dismissible" id="alertBerhasil">
                    <div class="close" data-dismiss="alert" aria-hidden="true" onclick="closeAlert(this)" style="cursor:pointer;font-size:20px;text-align:end;">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
            <?php
            } else { ?>
                <div class="alert alert-danger alert-dismissible" id="alertGagal">
                    <div class="close" data-dismiss="alert" aria-hidden="true" onclick="closeAlert(this)" style="cursor:pointer;font-size:20px;text-align:end;">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
        <?php
            }
        }
        ?>
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
           
            <?php if ($this->session->userdata('level') == 'Admin') { ?>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo base_url("Transaksibarang/pinjam"); ?>" class="btn btn-success px-5">
                        <i class='fa fa-plus mr-1'></i> Tambah Data
                    </a>
                </div>
            </div>
            <?php } ?> 

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Semua Data Peminjam </h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                                <th>Jumlah Pinjam</th>
                                <?php if ($this->session->userdata('level') == 'Admin') { ?>
                                <th>Aksi</th>
                                <?php } ?> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pinjam as $isi) { ?>
                                <tr>
                                    <td>
                                        <?= $no; ?>
                                    </td>
                                    <td>
                                        <?= $isi['user']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['kode_barang']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['Nama_Barang']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['Tanggal_Peminjaman']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['Tanggal_Pengembalian']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['status']; ?>
                                    </td>
                                    <td>
                                        <?= $isi['Jumlah']; ?>
                                    </td>
                                    <?php if ($this->session->userdata('level') == 'Admin') { ?>
                                    <td>
                                        <center>
                                            
                                            <a href="<?= base_url('transaksibarang/kembalipinjam/' . $isi['Pinjam_id']); ?>" class="btn btn-warning btn-sm" title="pengembalian buku">
                                                <i class="fa fa-sign-out"></i> Kembalikan
                                            </a>
                                            <!-- <a href="<?= base_url('transaksibarang/prosespinjam?ID_Peminjaman=' . $isi['ID_Peminjaman']); ?>" onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');" class="btn btn-primary btn-sm" title="Batal">
                                                <i class="fa fa-edit"></i>
                                            </a> -->
                                            <a href="<?= base_url('transaksibarang/prosespinjam?ID_Peminjaman=' . $isi['ID_Peminjaman']); ?>" onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');" class="btn btn-danger btn-sm" title="Batal">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <?php } ?> 
                                    <!-- <td>
                                        
                                    </td> -->
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