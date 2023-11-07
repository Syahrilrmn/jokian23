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
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo base_url("pengguna/tambah"); ?>" class="btn btn-success px-5">
                        <i class='fa fa-plus mr-1'></i> Tambah Data
                    </a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Semua Data Pengguna</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>

                                <th>Foto</th>
                                <th>Nama Pengguna</th>
                                <th>Gmail</th>
                                <th>Jenis kelamin</th>
                                <th>Alamat</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($user as $isi) { ?>
                                <tr>
                                    <td><?= $no; ?></td>

                                    <td>
                                        <center>
                                            <?php if (!empty($isi['foto'] !== "-")) { ?>
                                                <img src="<?php echo base_url(); ?>assets/images/pengguna/<?php echo $isi['foto']; ?>" alt="#" class="img-responsive" style="height:100px;width:100px;" />
                                            <?php } else { ?>
                                                <!--<img src="" alt="#" class="user-image" style="border:2px solid #fff;"/>-->
                                                <i class="fa fa-user fa-3x" style="color:#333;"></i>
                                            <?php } ?>
                                        </center>
                                    </td>
                                    <td><?= $isi['user']; ?></td>
                                    <td><?= $isi['email']; ?></td>
                                    <td><?= $isi['jenkel']; ?></td>
                                    <td><?= $isi['alamat']; ?></td>
                                    <td>
                                        <center>
                                            <a href="<?= base_url('pengguna/edit/' . $isi['id_login']); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= base_url('pengguna/del/' . $isi['id_login']); ?>" onclick="return confirm('Anda yakin Anggota akan dihapus ?');">
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
<script>
    function closeAlert() {
        try {
            
            document.getElementById('alertBerhasil').style.display = 'none';
            document.getElementById('alertGagal').style.display = 'none';
        } catch (error) {
            
        }
    }

    // Tambahkan kode untuk menutup otomatis setelah 3 detik
    setTimeout(function () {
        closeAlert();
    }, 5000); // 5000 milidetik (5 detik)
</script>