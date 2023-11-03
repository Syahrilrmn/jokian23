<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <?php
        if (!empty($this->session->flashdata('pesan'))) {
            if ($this->session->flashdata('status') == 'Berhasil') { ?>
                <div class="alert alert-success alert-dismissible" id="alertBerhasil">
                    <div class="close" data-dismiss="alert" aria-hidden="true" onclick="closeAlert(this)"
                        style="cursor:pointer;font-size:20px;text-align:end;">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    <?= $this->session->flashdata('pesan'); ?>
                </div>
                <?php
            } else { ?>
                <div class="alert alert-danger alert-dismissible" id="alertGagal">
                    <div class="close" data-dismiss="alert" aria-hidden="true" onclick="closeAlert(this)"
                        style="cursor:pointer;font-size:20px;text-align:end;">
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
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo base_url("Notifikasi/create"); ?>" class="btn btn-success px-5">
                        <i class='fa fa-plus mr-1'></i> Tambah Data
                    </a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">DataTable Import</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Isi Pengumuman</th>
                                <th>Tanggal</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $isi): ?>

                                <tr>
                                    <td>
                                        <?= $no; ?>
                                    </td>

                                    <td>
                                        <?php
                                        $jsonData = $isi->Isi_Pengumuman;
                                        $decodedData = json_decode($jsonData, true);
                                        foreach ($decodedData as $item):
                                            ?>
                                            <details>
                                                <summary>Pegawai :
                                                    <?= $item['Pegawai_Tujuan']; ?>
                                                </summary>
                                                <p>Deskripsi Job:
                                                    <?= $item['Isi_Pengumuman']; ?>
                                                </p>
                                            </details>
                                            <?php
                                        endforeach
                                        ?>
                                    </td>

                                    <td>
                                        <?= $isi->Tanggal; ?>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= base_url('notifikasi/edit/' . $isi->ID_Pengumuman); ?>"><button
                                                    class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= base_url('notifikasi/delete/' . $isi->ID_Pengumuman); ?>"
                                                onclick="return confirm('Anda yakin Anggota akan dihapus ?');">
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                        </center>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                        </tbody>
                        <!-- <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot> -->
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
    setTimeout(function () {
        closeAlert();
    }, 5000); // 5000 milidetik (5 detik)
</script>