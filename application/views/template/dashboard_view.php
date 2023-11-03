<!--end header -->
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content container">

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
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i
                                    class='bx bxs-group'></i>
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

        <div class="card p-3">
            <?php
            
            
            foreach ($dataPengumuman as $item) {
                $isiPengumuman = json_decode($item->Isi_Pengumuman, true);
                
               
                   
                    foreach ($isiPengumuman as $pengumuman) {
                        $pegawaiTujuan = $pengumuman['Pegawai_Tujuan'];
                        $isi = $pengumuman['Isi_Pengumuman'];
                        ?>
                        <details>
                            <summary class="display-6">
                                <?= $pegawaiTujuan; ?>
                            </summary>
                            <p>Deskripsi Job:
                                <?= $isi; ?>
                            </p>
                        </details>
                        <?php
                    }
                    ?>
               
                <?php
            }
            ?>
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
        $(this).find('strong').html(Math.round(progres * 100) + '<i>%</i>');
    });
</script>