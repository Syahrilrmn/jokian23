<!--end header -->
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10 w-100 ">
            <div class="card-body row row-cols-1 ">
                <div id="circle"
                    style="display: flex; justify-content: center; align-items: center; position: relative;">
                    <div class="d-flex flex-column justify-content-center align-items-center"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        <strong class="display-4"></strong>
                        <div>
                            <p>
                                <?= $count_solar->jumlah_stok ?> Liter
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-center align-items-center p-3">
                    <?php if ($count_solar->jumlah_stok !== "0") {
                        ?>
                        <button type="button" class="button3 m-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Ambil Solar
                        </button>
                        <?php
                    } ?>
                    <button type="button" class="button3 m-2 " data-bs-toggle="modal" data-bs-target="#modalTransaksi">
                        History Transaksi
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengambilan Solar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" id="storeTransactionSolar">
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-lg-6">
                                                <label for="jumlahSolar" class="form-label">Tanggal Pengambilan</label>
                                                <input type="date" class="form-control" id="jumlahSolar"
                                                    placeholder="Jumlah Solar" name="tanggalPengambilan"
                                                    max="<?= $count_solar->jumlah_stok ?>" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="jumlahSolar" class="form-label">Jumlah Liter</label>
                                                <input type="number" itemtype="number" class="form-control"
                                                    id="jumlahSolar" placeholder="Jumlah Liter" name="jumlahLiter"
                                                    max="10000" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="jumlahSolar" class="form-label">No Plat</label>
                                                <input type="text" class="form-control" id="jumlahSolar"
                                                    placeholder="No Plat" name="noPlat" max="10000" required>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="jumlahSolar" class="form-label">Kendaraan</label>
                                                <input type="text" class="form-control" id="jumlahSolar"
                                                    placeholder="Kendaraan" name="kendaraan" max="10000" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- modal history transaksi -->
                    <div class="modal fade" id="modalTransaksi" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">History Transaksi Bulan Ini
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table id="example2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Transaksi</th>
                                                <th>No Plat</th>
                                                <th>Kendaraan</th>
                                                <th>Tanggal Pengambilan</th>
                                                <th>Jumlah Liter</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($dataTransaksi as $isi): ?>

                                                <tr>
                                                    <td>
                                                        <?= $no; ?>
                                                    </td>
                                                    <td>
                                                        <?= $isi->id_transaksi_solar; ?>
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
                                                    <?= date('d-m-Y H:i:s', strtotime($isi->created_at)); ?>

                                                    </td>

                                                </tr>
                                                <?php $no++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo base_url("SolarTransaction"); ?>" class="btn btn-primary"><i class='bx bx-radio-circle'></i>Lihat Semua History Transaksi Anda </a>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Data Pengguna</p>
                            <h4 class="my-5">
                                <?= $count_pengguna ?>
                            </h4>
                            <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>$34 Since last week</p> -->
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                    <!-- <div id="chart1"></div> -->
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Data Barang</p>
                            <h4 class="my-5">
                                <?= $count_barang ?>
                            </h4>
                            <!-- <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>14% Since last week</p> -->
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                class='bx bxs-briefcase'></i>
                        </div>
                    </div>
                    <!-- <div id="chart2"></div> -->
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Data Peminjaman</p>
                            <h4 class="my-5">
                                <?= $count_pinjam ?>
                            </h4>
                            <!-- <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since last week</p> -->
                        </div>
                        <div class="widgets-icons bg-light-primary text-primary ms-auto"><i
                                class='bx bxs-bookmark-plus'></i>
                        </div>
                    </div>
                    <!-- <div id="chart3"></div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="e-card playing">
        <div class="image"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="infotop">
            <h4 class="text-light">
                Pengumuman
                <?= $dataPengumuman ? $dataPengumuman[0]->Tanggal : '' ?>
            </h4>
            <div class="name">
                <?php
                if ($dataPengumuman) {
                    foreach ($dataPengumuman as $item) {
                        $isiPengumuman = json_decode($item->Isi_Pengumuman, true);
                        foreach ($isiPengumuman as $pengumuman) {
                            $pegawaiTujuan = $pengumuman['Pegawai_Tujuan'];
                            $isi = $pengumuman['Isi_Pengumuman'];
                            ?>
                            <details>
                                <summary class="h6 text-light">
                                    <?= $pegawaiTujuan; ?>
                                </summary>
                                <div class="cardCustom">
                                    <p><span class="labelDesc">Deskripsi Job:</span>
                                        <?= $isi; ?>
                                    </p>
                                </div>
                            </details>
                            <?php
                        }
                        ?>

                        <?php
                    }
                } else { ?>
                    <h5 style="text-transform: capitalize;" class="text-light">Tidak Ada Pengumuman Bray</h5>
                    <?php

                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php $jumlahStokSolar = $count_solar->jumlah_stok; ?>
<script>
    var jumlahStokSolar = <?= $jumlahStokSolar; ?>;
    var maxJumlahStok = 10000; // Atur nilai maksimal yang sesuai

    var progres = jumlahStokSolar / maxJumlahStok;

    $('#circle').circleProgress({
        value: progres,
        size: 300,
        fill: {
            gradient: ["red", "orange"]
        }
    }).on('circle-animation-progress', function (event, progress) {
        // Mengisi tag <strong> dengan nilai progres (bukan persentase)
        $(this).find('strong').html((progres * 100).toFixed(1) + '<i>%</i>');
    });


    document.getElementById('storeTransactionSolar').addEventListener('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        // Kirim data formulir menggunakan Ajax
        fetch('<?= base_url('SolarTransaction/store'); ?>', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    Swal.fire({
                        title: 'Success',
                        text: data.message, // Menampilkan nama pengguna
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function () {
                        window.location.href = '<?= base_url('dashboard'); ?>';
                    });
                } else {
                    Swal.fire({
                        title: 'Failed',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>