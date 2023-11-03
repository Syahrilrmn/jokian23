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
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ms-auto">
                <div class="btn-group">
                    <?php if ($this->session->userdata('level') == 'Admin') { ?>
                        <a href="<?php echo base_url("barang/tambah"); ?>" class="btn btn-success px-5">
                            <i class='fa fa-plus mr-1'></i> Tambah Data
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Semua Data Barang</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Stok</th>
                                <?php if ($this->session->userdata('level') == 'Admin') { ?>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
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
                                    <?php if ($this->session->userdata('level') == 'Admin') { ?>

                                        <td>
                                            <center>
                                                <a href="<?= base_url('barang/edit/' . $isi['ID_Barang']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url('barang/del/' . $isi['ID_Barang']); ?>" onclick="return confirm('Anda yakin Anggota akan dihapus ?');">
                                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                            </center>
                                        </td>
                                    <?php } ?>
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
<script>
    function closeAlert() {
        document.getElementById('alertBerhasil').style.display = 'none';
        document.getElementById('alertGagal').style.display = 'none';
    }

    // Tambahkan kode untuk menutup otomatis setelah 3 detik
    setTimeout(function() {
        closeAlert();
    }, 5000); // 5000 milidetik (5 detik)
</script>