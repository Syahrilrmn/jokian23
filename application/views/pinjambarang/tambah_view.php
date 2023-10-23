<?php if (!defined('BASEPATH'))
	exit('No direct script acess allowed'); ?>
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
						<li class="breadcrumb-item active" aria-current="page">Input Group</li>
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
			<div class="col-xl-9 mx-auto">
				<h6 class="mb-0 text-uppercase">Tamabah Transaksi Peminjaman</h6>
				<hr />
				<div class="card">
					<div class="card-body">
						<form form action="<?php echo base_url('barang/prosesbarang'); ?>" method="POST"
							enctype="multipart/form-data" class="row g-3">
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Masukan Anggota_ID...."
									aria-label="Recipient's username" aria-describedby="button-addon2">
								<button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i
										class="fa fa-search"></i> Cari</button>
							</div>

							<label for="basic-url" class="form-label">Biodata *</label>
							<div class="input-group mb-3"> <span class="input-group-text"
									id="basic-addon3">Nomor Peminjaman</span>
								<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
							</div>

							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text" for="inputTanggalPinjam">Tanggal Pinjam</label>
								</div>
								<input type="date" class="form-control" id="inputTanggalPinjam"
									placeholder="Tanggal Pinjam" aria-label="Tanggal Pinjam">
								<div class="input-group-prepend">
									<span class="input-group-text">Tanggal Kembali</span>
								</div>
								<input type="date" class="form-control" id="inputTanggalKembali"
									placeholder="Tanggal Kembali" aria-label="Tanggal Kembali">
							</div>
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Masukan KOde Barang....."
									aria-label="Recipient's username" aria-describedby="button-addon2">
								<button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i
										class="fa fa-search"></i> Cari</button>
							</div>
							<div class="input-group"> <span class="input-group-text">Jumlah</span>
							<input type="text" class="form-control" id="inputjumlah"
									placeholder="Jumlah......" aria-label="Jumlah">
							</div>
							<div class="col-md-12">
								<div class="d-md-flex d-grid align-items-center gap-3">
									<input type="hidden" name="tambah" value="tambah">
									<button type="submit" class="btn btn-primary px-4">Submit</button>
									<a href="<?= base_url('Transaksibarang'); ?>" class="btn btn-danger  px-4">Kembali</a>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<!--end row-->
	</div>
</div>
<!--end page wrapper -->
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<footer class="page-footer">
	<p class="mb-0">Copyright © 2023. All right reserved.</p>
</footer>
</div>