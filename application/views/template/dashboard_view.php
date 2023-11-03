<!--end header -->
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        
            <div class="card radius-10 w-100">
                <div class="card-body d-flex justify-content-center align-items-center">
                        <input id="speed" type="text" />
                    <div class="speedbox">
                        <div class="speedbox__score" id="speedbox-score"></div>
                        <div class="speedbox__groove"></div>
                        <div class="speedbox__odo">
                            <div class="speedbox__ping"><i class="fa fa-clock-o"></i> 28<span>ms</span></div>
                            <div class="speedbox__up"><i class="fa fa-arrow-circle-up"></i> 1.1<span>mb/s</span></div>
                            <div class="speedbox__down"><i class="fa fa-arrow-circle-down"></i> 8.7<span>mb/s</span>
                            </div>
                        </div>
                        <div class="speedbox__base"></div>
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

    </div>
</div>