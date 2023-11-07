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
                                <th>Jumlah Stok</th>
                                <th>Updated At</th>
                                <?php if ($this->session->userdata('level') == 'Admin') { ?>
                                    <th>Edit</th>
                                <?php } ?>
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
                                        <?= $isi->Jumlah_Stok; ?>
                                    </td>
                                    <td>
                                        <?= date('d-m-Y H:i:s', strtotime($isi->updatedat)); ?>
                                    </td>
                                    <?php if ($this->session->userdata('level') == 'Admin') { ?>
                                        <td>
                                            <center>
                                                <a href="<?= base_url('solar/edit/' . $isi->ID_Solar); ?>"><button
                                                        class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                            </center>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php $no++; endforeach; ?>
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
            const alertSuccess = document.getElementById('alertBerhasil');
            const alertFailed = document.getElementById('alertGagal');
            if (alertSuccess) {
                alertSuccess.style.display = 'none';
            } else if (alertFailed) {
                alertFailed.style.display = 'none';
            }
        } catch (error) {
            // Tangani kesalahan di sini jika diperlukan
        }
    }

    // Tambahkan kode untuk menutup otomatis setelah 3 detik
    setTimeout(function () {
        closeAlert();
    }, 5000); // 5000 milidetik (5 detik)
</script>
