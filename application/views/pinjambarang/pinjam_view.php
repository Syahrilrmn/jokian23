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

            <?php if ($this->session->userdata('level') == 'Admin') { ?>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="<?php echo base_url("TransaksiBarang/pinjam"); ?>" class="btn btn-success px-5">
                            <i class='fa fa-plus mr-1'></i> Tambah Data
                        </a>
                    </div>
                </div>
            <?php } ?>

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Peminjaman Barang </h6>
        <hr />
        <div class="card">
            <div class="card-body">
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
                    <p>Filter Berdasarkan Tanggal Peminjaman</p>
                </form>
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
                                        <?= date('d-m-Y', strtotime($isi['Tanggal_Peminjaman'])); ?>

                                    </td>
                                    <?php
                                    // Check if the Tanggal_Pengembalian is overdue
                                    $tanggalPengembalian = strtotime($isi['Tanggal_Pengembalian']);
                                    $currentDate = strtotime(date('Y-m-d'));
                                    $daysOverdue = floor(($currentDate - $tanggalPengembalian) / (60 * 60 * 24));
                                    ?>

                                    <td class="<?= ($tanggalPengembalian < $currentDate) ? 'bg-danger text-light' : ''; ?>">
                                        <?= date('d-m-Y', $tanggalPengembalian); ?>
                                        <?php if ($daysOverdue > 0): ?>
                                            <br>
                                            <small class=' text-light'>Sudah lewat
                                                <?= $daysOverdue ?> hari
                                            </small>
                                        <?php endif; ?>
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

                                                <a href="<?= base_url('TransaksiBarang/kembalipinjam/' . $isi['Pinjam_id']); ?>"
                                                    class="btn btn-warning btn-sm" title="pengembalian buku">
                                                    <i class="fa fa-sign-out"></i> Kembalikan
                                                </a>
                                                <!-- <a href="<?= base_url('transaksibarang/prosespinjam?ID_Peminjaman=' . $isi['ID_Peminjaman']); ?>" onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');" class="btn btn-primary btn-sm" title="Batal">
                                                <i class="fa fa-edit"></i>
                                            </a> -->
                                                <a href="<?= base_url('TransaksiBarang/prosespinjam?ID_Peminjaman=' . $isi['ID_Peminjaman']); ?>"
                                                    onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');"
                                                    class="btn btn-danger btn-sm" title="Batal">
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

<script>
    function printData() {
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        // Pemeriksaan untuk memastikan start_date tidak lebih besar dari end_date
        const check = checkDate()
        if (!check) {
            return;
        }

        var printUrl = "<?php echo base_url('TransaksiBarang/print'); ?>";
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
</script>