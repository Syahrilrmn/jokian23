<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
            <span style="margin-left:200px;">
            <?php if (!empty($this->session->flashdata())) {
                echo $this->session->flashdata('pesan');
            } ?>
            </span>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo base_url("Transaksibarang/pinjam");?>" class="btn btn-success px-5" >
                        <i class='fa fa-plus mr-1'></i> Tambah Data 
                    </a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Semua Data </h6>
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
                                <th>Jumlah Pinjam</th>
                                <th>Aksi</th>
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
                                        <?= $isi['Jumlah']; ?>
                                    </td>

                                    <td>
                                        <center>
                                            <a href="#"><button
                                                    class="btn btn-warning"></i>Kembalikan</button></a>
                                                   
                                                <a href="<?= base_url('transaksibarang/prosespinjam?ID_Peminjaman=' . $isi['ID_Peminjaman']); ?>" onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');" class="btn btn-primary btn-sm" title="Batal">
															<i class="fa fa-edit"></i> 
														</a>
                                                <a href="<?= base_url('transaksibarang/prosespinjam?ID_Peminjaman=' . $isi['ID_Peminjaman']); ?>" onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');" class="btn btn-danger btn-sm" title="Batal">
															<i class="fa fa-trash"></i> 
														</a>
                                        </center>
                                    </td>
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