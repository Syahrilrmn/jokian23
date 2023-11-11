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
        <?php
        // Fungsi untuk mendapatkan nilai parameter dari URL
        function getParameter($name)
        {
            return isset($_GET[$name]) ? htmlspecialchars($_GET[$name]) : null;
        }

        // Mendapatkan nilai parameter dari URL
        $startDateParam = getParameter('start_date');
        $endDateParam = getParameter('end_date');
        ?>
        <h6 class="mb-0 text-uppercase">Transaksi Solar</h6>
        <hr />

        <div class="card">
            <div class="card-body">
                <form method="get" class="row gap-2 mb-2" onsubmit="return checkDate()">
                    <div class="col-auto">
                        <input type="date" class="form-control" name="start_date" required id="startDate"
                            value="<?php echo $startDateParam; ?>">
                    </div>
                    <div class="col-auto">
                        <input type="date" name="end_date" class="form-control" required id="endDate"
                            value="<?php echo $endDateParam; ?>" onchange="checkDate()">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group">
                            <button onclick="printData()" href="<?php echo base_url("SolarTransaction/print"); ?>"
                                type="button" target="_blank" class="btn btn-success px-5">
                                <i class='fa fa-print mr-1'></i> Cetak Data
                            </button>
                        </div>
                    </div>
                    <p>Filter Berdasarkan Tanggal Pengambilan</p>
                </form>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Transaksi</th>
                                <th>Nama</th>
                                <th>No Plat</th>
                                <th>Kendaraan</th>
                                <th>Tanggal Pengambilan</th>
                                <th>Jumlah Liter</th>
                                <th>Di Input Pada</th>
                                <th>Di Edit Pada</th>
                                <th>Aksi</th>

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
                                        <?= $isi->id_transaksi_solar; ?>
                                    </td>
                                    <td>
                                        <?= $isi->user; ?>
                                    </td>
                                    <td>
                                        <?= $isi->no_plat; ?>
                                    </td>
                                    <td>
                                        <?= $isi->kendaraan; ?>
                                    </td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($isi->tanggal_pengambilan)); ?>

                                    </td>
                                    <td>
                                        <?= $isi->jumlah_liter; ?>
                                    </td>
                                    <td>
                                        <?= $isi->created_at; ?>
                                    </td>
                                    <td
                                        class="<?= ($isi->created_at != $isi->updated_at) ? 'bg-primary text-white' : ''; ?> col">
                                        <?= $isi->updated_at; ?>

                                        <?php if ($isi->created_at != $isi->updated_at) {
                                            ?>
                                            <br/>
                                            <small>Data Di Lakukan Perubahan</small>
                                            <?php
                                        } ?>
                                    </td>

                                    <td>

                                        <a href="<?= base_url('SolarTransaction/edit/' . $isi->id_transaksi_solar); ?>"><button
                                                class="btn btn-success"><i class="fa fa-edit"></i></button></a>

                                    </td>


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
    function printData() {
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        // Pemeriksaan untuk memastikan start_date tidak lebih besar dari end_date
        const check = checkDate()
        if (!check) {
            return;
        }

        var printUrl = "<?php echo base_url('SolarTransaction/print'); ?>";
        printUrl += "?start_date=" + startDate + "&end_date=" + endDate;

        window.open(printUrl, '_blank');
    }

    function checkDate() {
        var startDate = new Date(document.getElementById("startDate").value);
        var endDate = new Date(document.getElementById("endDate").value);

        // Pemeriksaan untuk memastikan start_date tidak lebih besar dari end_date
        if (startDate > endDate) {
            alert("Start Date tidak boleh lebih besar dari End Date");
            return false;
        }
        return true; // Lanjutkan dengan mengajukan formulir
    }



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