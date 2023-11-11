<?php if (!defined('BASEPATH'))
	exit('No direct script acess allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		.label-column {
			width: 170px;
			/* Lebar kolom label */
			font-weight: bold;
			/* Teks label bold */
		}

		.separator-column {
			width: 40px;
		}
	</style>
</head>

<body>
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
						<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
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
							<?php
							$d = $this->db->query("SELECT * FROM tbl_login WHERE id_login")->row();
							?>
							<form form action="<?php echo base_url('TransaksiBarang/prosespinjam'); ?>" method="POST" enctype="multipart/form-data" class="row g-3">
								<div class="input-group">
									<span class="input-group-text" id="basic-addon3">Nomor Peminjaman</span>
									<input type="text" name="Pinjam_id" value="<?= $this->data['pinjam']->Pinjam_id; ?>" class="form-control" readonly>
								</div>
								<div class="input-group mb-3">
									<tr>
										<td>
											<div class="input-group"><span class="input-group-text" id="basic-addon3">Masukan ID Pengguna :</span>
												<input type="text" class="form-control" required autocomplete="off" name="anggota_id" value="<?= $this->data['pinjam']->anggota_id; ?>" aria-label="Recipient's username" aria-describedby="button-addon2">

											</div>
										</td>
									</tr>
								</div>
								<div class="container-fluid">
									<div class="input-group">
										<table class="table table-striped">
											<tr>
												<td class="label-column">Biodata</td>
												<td class="separator-column">:</td>
												<td class="info-column"></td>
											</tr>
											<tr>
												<td class="label-column">Nama</td>
												<td class="separator-column">:</td>
												<td class="info-column"><?= $this->data['pinjam']->user; ?></td>
											</tr>
											<tr>
												<td class="label-column">Jenis Kelamin</td>
												<td class="separator-column">:</td>
												<td class="info-column"><?= $this->data['pinjam']->jenkel; ?></td>
											</tr>
											<tr>
												<td class="label-column">Alamat</td>
												<td class="separator-column">:</td>
												<td class="info-column"><?= $this->data['pinjam']->alamat; ?></td>
											</tr>
										</table>
									</div>
								</div>

								<div class="col-md-6">
									<label for="input1" class="form-label">Tanggal Pinjam</label>
									<input type="date" name="Tanggal_Peminjaman" class="form-control" id="input1" value="<?= $this->data['pinjam']->Tanggal_Peminjaman; ?>">
								</div>
								<div class="col-md-6">
									<label for="input2" class="form-label">Tanggal Kembali</label>
									<input type="date" name="Tanggal_Pengembalian" class="form-control" id="input2" value="<?= $this->data['pinjam']->Tanggal_Pengembalian; ?>">
								</div>
								<div class="input-group mb-3">

									<tr>
										<td>
											<div class="input-group"><span class="input-group-text" id="basic-addon3">Masukan Kode Barang :</span>
												<input type="text" class="form-control" required autocomplete="off" name="kode_barang" id="barang-search" value="<?= $this->data['pinjam']->kode_barang; ?>" type="text" aria-label="Recipient's username" aria-describedby="button-addon2">
												<span class="input-group-btn">
													<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#TableBarang"><i class="fa fa-search"></i> Cari </button>
												</span>
											</div>
										</td>
									</tr>
								</div>
								<div class="container-fluid">
									<div class="input-group">
										<table class="table table-striped">
											<tr>
												<td class="label-column">Data Barang</td>
												<td class="separator-column">:</td>
												<td class="info-column"></td>
											</tr>
											<tr>
												<td class="label-column">Nama Barang</td>
												<td class="separator-column">:</td>
												<td class="info-column"><?= $this->data['pinjam']->Nama_Barang; ?></td>
											</tr>
											<tr>
												<td class="label-column">Stock</td>
												<td class="separator-column">:</td>
												<td class="info-column"><?= $this->data['pinjam']->stok; ?></td>
											</tr>
										</table>
									</div>
								</div>

								<div class="input-group"> <span class="input-group-text">Jumlah</span>
									<input type="text" class="form-control" name="Jumlah" value="<?= $this->data['pinjam']->Jumlah; ?>" id="inputjumlah" placeholder="Jumlah......" aria-label="Jumlah">
								</div>
								<!-- tombol -->
								<div class="col-md-12">
									<div class="d-md-flex d-grid align-items-center gap-3">

										<!-- <input type="hidden" name="tambah" value="tambah">
										<button type="submit" class="btn btn-primary px-4">Submit</button> -->
										<a href="<?= base_url('TransaksiBarang'); ?>" class="btn btn-danger  px-4">Kembali</a>
										<span class="input-group-btn">
											<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#TableBarang"><i class="fa fa-sign-out"></i> Kembalikan </button>
										</span>
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
			<!--end row-->
		</div>

		<div class="modal fade" id="TableBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Detail Peminjaman</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div id="modal_body" class="modal-body fileSelection2">
						<table id="example2" class="table table-bordered table-striped">
							<tr style="background:yellowgreen">
								<td colspan="3">Data Peminjaman Barang</td>
							</tr>
							<tr>
								<td>No Peminjaman</td>
								<td>:</td>
								<td>
									<?= $this->data['pinjam']->Pinjam_id; ?>
								</td>
							</tr>
							<tr>
								<td>Nama Peminjam</td>
								<td>:</td>
								<td>
									<?= $this->data['pinjam']->user; ?>
								</td>
							</tr>
							<tr>
								<td>Nama Barang</td>
								<td>:</td>
								<td>
									<?= $this->data['pinjam']->Nama_Barang; ?>
								</td>
							</tr>
							<tr>
								<td>Tgl Peminjaman</td>
								<td>:</td>
								<td>
									<?= $this->data['pinjam']->Tanggal_Peminjaman; ?>
								</td>
							</tr>
							<tr>
								<td>Tgl Pengembalian</td>
								<td>:</td>
								<td>
									<?= $this->data['pinjam']->Tanggal_Pengembalian; ?>
								</td>
							</tr>

							<tr>
								<td>Tanggal Dikembalikan</td>
								<td>:</td>
								<td>
									<?= date('Y-m-d'); ?> ( Sekarang )
								</td>
							</tr>

						</table>
					</div>
					<div class="modal-footer">
						<!--  -->
						<a href="<?= base_url('TransaksiBarang/prosespinjam?kembali=' . $this->data['pinjam']->Pinjam_id); ?>">
							<button class="btn btn-primary"> Proses Pengembalian</button></a>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>