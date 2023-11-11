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
			
		</div>
		<!--end breadcrumb-->
		<div class="row">
			<div class="col-xl-9 mx-auto">
				<h6 class="mb-0 text-uppercase">Tambah Transaksi Peminjaman</h6>
				<hr />
				<div class="card">
					<div class="card-body">
						<?php
						$d = $this->db->query("SELECT * FROM tbl_login WHERE id_login")->row();
						?>
						<form form action="<?php echo base_url('TransaksiBarang/prosespinjam'); ?>" method="POST" enctype="multipart/form-data" class="row g-3">
							<div class="input-group">
								<span class="input-group-text" id="basic-addon3">Nomor Peminjaman</span>
								<input type="text" name="Pinjam_id" value="<?= $nop; ?>" class="form-control" readonly>
							</div>
							<div class="input-group mb-3">
								<tr>
									<td>
										<div class="input-group"><span class="input-group-text" id="basic-addon3">Masukan NRP Pengguna :</span>
											<input type="text" class="form-control" required autocomplete="off" name="anggota_id" id="search-box" placeholder="Masukan atau cari kode NRP" type="text" value="<?= $d->anggota_id; ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
											<span class="input-group-btn">
												<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#TableAnggota"><i class="fa fa-search"></i> Cari </button>
											</span>
										</div>
									</td>
								</tr>
							</div>
							<div class="container-fluid ">
								<div class="input-group ">
									<table class="table table-striped">
										<tr>
											<td>Biodata</td>
											<td>:</td>
											<td>
												<div id="result_tunggu">
													<p style="color:red">* Belum Ada Hasil</p>
												</div>
												<div id="result"></div>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-md-6">
								<label for="input1" class="form-label">Tanggal Pinjam</label>
								<input type="date" name="Tanggal_Peminjaman" class="form-control" id="input1" value="<?= date('Y-m-d'); ?>" required>
							</div>
							<div class="col-md-6">
								<label for="input2" class="form-label">Tanggal Kembali</label>
								<input type="date" name="Tanggal_Pengembalian" class="form-control" id="input2" placeholder="Last Name" required>
							</div>
							<div class="input-group mb-3">

								<tr>
									<td>
										<div class="input-group"><span class="input-group-text" id="basic-addon3">Masukan Kode Barang :</span>
											<input type="text" class="form-control" required autocomplete="off" name="kode_barang" id="barang-search" placeholder="Masukan atau pilih Kode Barang " type="text" aria-label="Recipient's username" aria-describedby="button-addon2">
											<span class="input-group-btn">
												<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#TableBarang"><i class="fa fa-search"></i> Cari </button>
											</span>
										</div>
									</td>
								</tr>
							</div>
							<div class="container-fluid ">
								<div class="input-group ">
									<table class="table table-striped">
										<tr>
											<td>Data Barang</td>
											<td>:</td>
											<td>
												<div id="result_tunggu_barang">
													<p style="color:red">* Belum Ada Hasil</p>
												</div>
												<div id="result_barang"></div>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="input-group"> <span class="input-group-text">Jumlah</span>
								<input type="text" class="form-control" name="Jumlah" id="inputjumlah" placeholder="Jumlah......" aria-label="Jumlah" required>
							</div>
							<div class="col-md-12">
								<div class="d-md-flex d-grid align-items-center gap-3">
									<input type="hidden" name="tambah" value="tambah">
									<button type="submit" class="btn btn-primary px-4">Submit</button>
									<a href="<?= base_url('Transaksibarang'); ?>" class="btn btn-danger  px-4">Kembali</a>
									<button type="reset" class="btn btn-secondary">Reset</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<!--end row-->
	</div>
	<!-- modal anggota -->

	<div class="modal fade" id="TableAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Daftar Anggota</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div id="modal_body" class="modal-body fileSelection1">
					<table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>NRP</th>
								<th>User</th>
								<th>Alamat</th>
								<th>Jenkel</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($user as $isi) {
								// Periksa apakah level pengguna adalah 'User'
								if ($isi['level'] == 'User') {
							?>
									<tr>
										<td>
											<?= $no; ?>
										</td>
										<td>
											<?= $isi['anggota_id']; ?>
										</td>
										<td>
											<?= $isi['user']; ?>
										</td>
										<td>
											<?= $isi['alamat']; ?>
										</td>
										<td>
											<?= $isi['jenkel']; ?>
										</td>
										<td style="width:20%;">
											<button class="btn btn-primary" id="Select_File1" data-id="<?= $isi['anggota_id']; ?>">
												<i class="fa fa-check"></i> Pilih
											</button>
										</td>
									</tr>
							<?php
									$no++;
								}
							}
							?>
						</tbody>

					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	<!-- modal barang -->
	<div class="modal fade" id="TableBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Daftar Barang</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div id="modal_body" class="modal-body fileSelection2">
					<table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah Stok</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($databarang as $isi) {
							?>
								<tr>
									<td>
										<?= $no; ?>
									</td>
									<td>
										<?= $isi['kode_barang']; ?>
									</td>
									<td>
										<?= $isi['Nama_Barang']; ?>
									</td>
									<td>
										<?= $isi['Stok']; ?>
									</td>
									<td style="width:20%;">
										<button class="btn btn-primary" id="Select_File2" data-id="<?= $isi['kode_barang']; ?>">
											<i class="fa fa-check"></i> Pilih
										</button>
									</td>

								</tr>

							<?php $no++;
							} ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<!-- script barang -->
	<script>
		$(".fileSelection2 #Select_File2").click(function(e) {
			document.getElementsByName('kode_barang')[0].value = $(this).attr("data-id");
			$('#TableBarang').modal('hide');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('TransaksiBarang/barang'); ?>",
				data: 'kode_buku=' + $(this).attr("data-id"),
				beforeSend: function() {
					$("#result_barang").html("");
					$("#result_tunggu_barang").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
				},
				success: function(html) {
					$("#result_barang").load("<?= base_url('TransaksiBarang/barang_list'); ?>");
					$("#result_tunggu_barang").html('');
				}
			});
		});
	</script>

	<script>
		// AJAX call for autocomplete 
		$(document).ready(function() {
			$("#barang-search").keyup(function() {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('TransaksiBarang/barang'); ?>",
					data: 'kode_buku=' + $(this).val(),
					beforeSend: function() {
						$("#result_tunggu_barang").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
					},
					success: function(html) {
						$("#result_barang").load("<?= base_url('TransaksiBarang/barang_list'); ?>");
						$("#result_tunggu_barang").html('');
					}
				});
			});
		});
	</script>
	<!-- script otomatis anggota -->
	<script>
		$(".fileSelection1 #Select_File1").click(function(e) {
			document.getElementsByName('anggota_id')[0].value = $(this).attr("data-id");
			$('#TableAnggota').modal('hide');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('TransaksiBarang/result'); ?>",
				data: 'kode_anggota=' + $(this).attr("data-id"),
				beforeSend: function() {
					$("#result").html("");
					$("#result_tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
				},
				success: function(html) {
					$("#result").html(html);
					$("#result_tunggu").html('');
				}
			});
		});
	</script>

	<script>
		// AJAX call for autocomplete 
		$(document).ready(function() {
			$("#search-box").keyup(function() {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('TransaksiBarang/result'); ?>",
					data: 'kode_anggota=' + $(this).val(),
					beforeSend: function() {
						$("#result").html("");
						$("#result_tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
					},
					success: function(html) {
						$("#result").html(html);
						$("#result_tunggu").html('');
					}
				});
			});
		});
	</script>
	<!--end script anggota -->



	<!--start overlay-->
	<div class="overlay toggle-icon"></div>
	<!--end overlay-->
	<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	<!--End Back To Top Button-->
	<footer class="page-footer">
		<p class="mb-0">Copyright © 2023. All right reserved.</p>
	</footer>
</div>