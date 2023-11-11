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
           
        </div>
        <!--end breadcrumb-->

        <!--start stepper one-->

        <h6 class="text-uppercase">Edit Data Pengguna</h6>
        <hr>
        <div id="stepper1" class="bs-stepper">
            <div class="card">


                <div class="card-body">

                    <div class="bs-stepper-content">
                    <?php if ($this->session->userdata('level') == 'Admin') { ?>
                        <form form action="<?php echo base_url('pengguna/upd'); ?>" method="POST" enctype="multipart/form-data">

                            <div class="row g-3">
                             
                                <div class="col-12 col-lg-6">
                                    <label for="NRP" class="form-label">NRP</label>
                                    <input type="text" class="form-control" value="<?= $user->anggota_id; ?>" id="NRP" placeholder="Experience 1" name="anggota_id">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Position1" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" value="<?= $user->tanggal_lahir; ?>" id="Position1"  required name="tanggal_lahir">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" value="<?= $user->user; ?>" id="username" placeholder="Username..." name="user">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Position1" class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?= $user->email; ?>" id="Position1" placeholder="Email..." required name="email">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="pass" class="form-label">password</label>
                                    <input type="text" class="form-control"  id="Experience2" placeholder="Password..." name="pass">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" value="<?= $user->alamat; ?>" id="alamat" placeholder="Alamat" name="alamat">
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
                                        <option <?php if ($user->jenkel == 'Laki-Laki') {
                                                    echo 'selected';
                                                } ?>>Laki-Laki</option>
                                        <option <?php if ($user->jenkel == 'Perempuan') {
                                                    echo 'selected';
                                                } ?>>Perempuan</option>
                                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" class="form-control" value="<?= $user->id_login; ?>" name="id_login">
                                    <input type="hidden" class="form-control" value="<?= $user->foto; ?>" name="foto">
                                    <br>
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-success px-4">Submit</button>
                                        <a href="<?= base_url('pengguna');?>" class="btn btn-danger btn-md">Kembali</a>
                                    </div>
                                    
                                </div>
                                <!-- <button class="btn btn-primary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button> -->
                            </div><!---end row-->

                    </div>
                    </form>
                    <?php } ?>
                    <?php if ($this->session->userdata('level') == 'User') { ?>
                    <form form action="<?php echo base_url('pengguna/upd'); ?>" method="POST" enctype="multipart/form-data">

                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <label for="Experience1" class="form-label">NRP</label>
                                    <input type="text" class="form-control" value="<?= $user->anggota_id; ?>" id="Experience1" placeholder="Experience 1" name="anggota_id" readonly>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Position1" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" value="<?= $user->tanggal_lahir; ?>" id="Position1" placeholder="masukan Gmail...." required name="tanggal_lahir" readonly>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Experience1" class="form-label">Username</label>
                                    <input type="text" class="form-control" value="<?= $user->user; ?>" id="Experience1" placeholder="Experience 1" name="user" readonly>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Position1" class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?= $user->email; ?>" id="Position1" placeholder="masukan Gmail...." required name="email" readonly>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Experience2" class="form-label">password</label>
                                    <input type="text" class="form-control"  id="Experience2" placeholder="Experience 2" name="pass" >
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="PhoneNumber" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" value="<?= $user->alamat; ?>" id="PhoneNumber" placeholder="Position" name="alamat" readonly>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="Experience3" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="Experience3" accept="image/*" name="foto">
                                    <!-- 'accept="image/*"' akan membatasi unggahan hanya pada file gambar -->
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="Position" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="Position" aria-label="Position" name="jenkel" readonly>
                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                        <option <?php if ($user->jenkel == 'Laki-Laki') {
                                                    echo 'selected';
                                                } ?>>Laki-Laki</option>
                                        <option <?php if ($user->jenkel == 'Perempuan') {
                                                    echo 'selected';
                                                } ?>>Perempuan</option>
                                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" class="form-control" value="<?= $user->id_login; ?>" name="id_login">
                                    <input type="hidden" class="form-control" value="<?= $user->foto; ?>" name="foto">
                                    <br>
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-success px-4">Submit</button>
                                        <?php if ($this->session->userdata('level') == 'Admin') { ?>
                                        <a href="<?= base_url('pengguna');?>" class="btn btn-danger btn-md">Kembali</a>
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                                <!-- <button class="btn btn-primary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button> -->
                            </div><!---end row-->

                    </div>
                    </form>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>