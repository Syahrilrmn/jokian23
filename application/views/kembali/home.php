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
            <!-- <?php if ($this->session->userdata('level') == 'Admin') { ?>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo base_url("Transaksibarang/pinjam"); ?>" class="btn btn-success px-5">
                        <i class='fa fa-plus mr-1'></i> Tambah Data
                    </a>
                </div>
            </div>
            <?php } ?> -->

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">Data Barang Di Kembalikan </h6>
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
                    <p>Filter Berdasarkan Tanggal Kembali</p>
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
                                <th>Tanggal Di kembalikan</th>
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
                                        <?= date('d-m-Y', strtotime($isi['Tanggal_Peminjaman'])); ?>

                                    </td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($isi['Tanggal_Pengembalian'])); ?>

                                    </td>
                                    <td>
                                        <?= $isi['status']; ?>
                                    </td>
                                    <?php
                                    // Check if the Tanggal_Pengembalian is overdue
                                    $tanggalPengembalian = strtotime($isi['Tanggal_Pengembalian']);
                                    $currentDate = strtotime(date('Y-m-d'));
                                    $daysOverdue = floor(($currentDate - $tanggalPengembalian) / (60 * 60 * 24));
                                    ?>
                                    <td class="<?= ($tanggalPengembalian < $currentDate) ? 'bg-danger text-light' : ''; ?>">
                                        <?= date('d-m-Y', strtotime($isi['tgl_kembali'])); ?>
                                        <?php if ($daysOverdue > 0): ?>
                                            <br>
                                            <small class=' text-light'>Di Kemablikan Dengan Telat, lewat
                                                <?= $daysOverdue ?> hari
                                            </small>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <?= $isi['Jumlah']; ?>
                                    </td>

                                    <td>
                                        <center>


                                            <a href="<?= base_url('TransaksiBarang/prosespinjam?ID_Peminjaman=' . $isi['ID_Peminjaman']); ?>"
                                                onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');"
                                                class="btn btn-danger btn-sm" title="Batal">
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

<script>
    function printData() {
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        // Pemeriksaan untuk memastikan start_date tidak lebih besar dari end_date
        const check = checkDate()
        if (!check) {
            return;
        }

        var printUrl = "<?php echo base_url('TransaksiBarang/printKembali'); ?>";
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