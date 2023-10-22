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
                        <li class="breadcrumb-item active" aria-current="page">Form Layouts</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                            link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Vertical Form</h5>
                        <form form action="<?php echo base_url('barang/prosesbarang'); ?>" method="POST" enctype="multipart/form-data"  class="row g-3">
                            <div class="col-md-6">
                                <label for="input1" class="form-label">NAMA BARANG</label>
                                <input type="text" class="form-control" id="input1" name="Nama_Barang" placeholder="NAMA BARANG....">
                            </div>
                            <div class="col-md-6">
                                <label for="input2" class="form-label">STOK</label>
                                <input type="text" class="form-control" id="input2" name="Stok" placeholder="STOK....">
                            </div>
                           
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                <input type="hidden" name="tambah" value="tambah">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                    <button type="button" class="btn btn-danger  px-4">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>