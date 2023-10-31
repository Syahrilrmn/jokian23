<?php if (!defined('BASEPATH')) exit('No direct script acess allowed'); ?>
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Wizard</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <!--start stepper one-->

        <h6 class="text-uppercase">Non Linear</h6>
        <hr>
        <div id="stepper1" class="bs-stepper">
            <div class="card">


                <div class="card-body">

                    <div class="bs-stepper-content">
                        <form form action="<?php echo base_url('pengguna/add'); ?>" method="POST" enctype="multipart/form-data">
                            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                <h5 class="mb-1">Your Personal Information</h5>
                                <p class="mb-4">Enter your personal information to get closer to copanies</p>

                            </div>

                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <label for="Experience1" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="Experience1" placeholder="Experience 1" name="user">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Position1" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="Position1" placeholder="masukan Gmail...." required name="email">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Experience2" class="form-label">password</label>
                                    <input type="text" class="form-control" id="Experience2" placeholder="Experience 2" name="pass">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="PhoneNumber" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="PhoneNumber" placeholder="Position" name="alamat">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Experience3" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="Experience3" accept="image/*" name="foto">
                                    <!-- 'accept="image/*"' akan membatasi unggahan hanya pada file gambar -->
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="Position" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="Position" aria-label="Position" name="jenkel">
                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        <!-- Tambahkan opsi lainnya sesuai kebutuhan --> 
                                    </select>
                                </div>
                                <div class="col-12">
                                    <br>
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-success px-4">Submit</button>
                                    </div>
                                </div>
                                <!-- <button class="btn btn-primary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button> -->
                            </div><!---end row-->

                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>