<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		/* CSS pada bagian header atau di dalam file .css terpisah */
		.btn-hover {
			/* Gaya tombol saat tidak dihover */
			background-color: #f8f9fa;
			color: #343a40;
			border: 1px solid #343a40;
			transition: background-color 0.3s ease;
		}

		.btn-hover:hover {
			/* Gaya tombol saat dihover */
			background-color: #27E1C1;
			/* Atur warna sesuai keinginan */
			color: white;
			/* Atur warna teks sesuai keinginan */
		}
	</style>
</head>

<body>
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				<i class="fa fa-edit" style="color:green"></i> <?= $title_web; ?>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a></li>
				<li class="active"><i class="fa fa-file-text"></i>&nbsp; <?= $title_web; ?></li>
			</ol>
		</section>
		<section class="content">
			<?php if (!empty($this->session->flashdata())) {
				echo $this->session->flashdata('pesan');
			} ?>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">

							<?php if ($this->session->userdata('level') == 'Petugas') { ?>
								<a href="<?= base_url('transaksi/booking'); ?>"> <button class="btn btn-light btn-hover">
										<i class="fa-regular fa-paper-plane"></i> Daftar Booking Buku
									</button></a>
							<?php } ?> 
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<br>
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped table" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>No Pinjam</th>
											<th>ID Anggota</th>
											<th>Nama Peminjam</th>
											<th>Nama_buku</th>
											<th>Nama kategori</th>
											<th>Pinjam</th>
											<th>Balik</th>
											<th style="width:10%">Status</th>
											<th>Denda</th>
											<th>Jumlah Pinjam</th>
											<th style="text-align: center;">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$namaBulan = [
											1 => 'Januari',
											2 => 'Februari',
											3 => 'Maret',
											4 => 'April',
											5 => 'Mei',
											6 => 'Juni',
											7 => 'Juli',
											8 => 'Agustus',
											9 => 'September',
											10 => 'Oktober',
											11 => 'November',
											12 => 'Desember'
										];

										foreach ($pinjam->result_array() as $isi) {
											$anggota_id = $isi['anggota_id'];
											// $ang = $this->db->query("SELECT * FROM tbl_login WHERE anggota_id = '$anggota_id'")->row();
											$pinjam_id = $isi['pinjam_id'];
											$denda = $this->db->query("SELECT * FROM tbl_denda WHERE pinjam_id = '$pinjam_id'");
											$total_denda = $denda->row();
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $isi['pinjam_id']; ?></td>
												<td><?= $isi['anggota_id']; ?></td>
												<td><?= $isi['nama'] ?></td>
												<td><?= $isi['title']; ?></td>
												<td><?= $isi['nama_kategori']; ?></td>
												<td><?= date('d', strtotime($isi['tgl_pinjam'])); ?> <?= $namaBulan[date('n', strtotime($isi['tgl_pinjam']))]; ?> <?= date('Y', strtotime($isi['tgl_pinjam'])); ?></td>
												<td><?= date('d', strtotime($isi['tgl_balik'])); ?> <?= $namaBulan[date('n', strtotime($isi['tgl_balik']))]; ?> <?= date('Y', strtotime($isi['tgl_balik'])); ?></td>
												<?php if ($isi['status'] == 'Booking') : ?>
													<td style="color: red;"><?= $isi['status']; ?></td>
												<?php elseif ($isi['status'] == 'Dipinjam') : ?>
													<td style="color: green;"><?= $isi['status']; ?></td>
												<?php else : ?>
													<td><?= $isi['status']; ?></td>
												<?php endif; ?>

												<!-- <td>
													<?php
													if ($isi['status'] == 'Di Kembalikan') {
														echo $this->M_Admin->rp($total_denda->denda);
													} else {
														$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();
														$date1 = date('Ymd');
														$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']);
														$diff = $date1 - $date2;
														if ($diff > 0) {
															echo $diff . ' hari';
															$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
															echo '<p style="color:red;font-size:18px;">' . $this->M_Admin->rp($jml * ($dd->harga_denda * $diff)) . '</p><small style="color:#333;">* Untuk ' . $jml . ' Buku</small>';
														} else {
															echo '<p style="color:green;">Tidak Ada Denda</p>';
														}
													}
													?>
												</td> -->
												<!-- menghitung denda perhari -->
												<td>
													<?php
													if ($isi['status'] == 'Di Kembalikan') {
														echo $this->M_Admin->rp($total_denda->denda);
													} elseif ($isi['status'] == 'Booking' || $isi['status'] == 'Batal') {
														echo '<p style="color:green;">Denda Tidak Aktif</p>';
													} else {
														$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();
														$date1 = date('Ymd');
														$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']);
														$diff = $date1 - $date2;
														if ($diff > 0) {
															echo $diff . ' hari';
															$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
															echo '<p style="color:red;font-size:18px;">' . $this->M_Admin->rp($jml * ($dd->harga_denda * $diff)) . '</p><small style="color:#333;">* Untuk ' . $jml . ' Buku</small>';
														} else {
															echo '<p style="color:green;">Tidak Ada Denda</p>';
														}
													}
													?>
												</td>
												<!-- <td>
												 <?php
													$id = $isi['buku_id'];
													$dd = $this->db->query("SELECT * FROM tbl_pinjam WHERE buku_id = '$id' AND status = 'Dipinjam'");
													if ($dd->num_rows() > 0) {
														echo $dd->num_rows();
													} else {
														echo '0';
													}
													?>
											    </td> -->

												<!-- memghitung denda new 7 hari -->

												<!-- <td>
													<?php
													if ($isi['status'] == 'Di Kembalikan') {
														echo $this->M_Admin->rp($total_denda->denda);
													} elseif ($isi['status'] == 'Booking' || $isi['status'] == 'Batal') {
														echo '<p style="color:green;">Denda Tidak Aktif</p>';
													} else {
														$jml = $this->db->query("SELECT * FROM tbl_pinjam WHERE pinjam_id = '$pinjam_id'")->num_rows();
														$date1 = date('Ymd');
														$date2 = preg_replace('/[^0-9]/', '', $isi['tgl_balik']); // Mengambil tanggal pengembalian

														$dueDate = date('Ymd', strtotime("+7 days", strtotime($date2)));

														if ($date1 > $dueDate) {
															$diff = $date1 - $dueDate;
															echo $diff . ' hari';
															$dd = $this->M_Admin->get_tableid_edit('tbl_biaya_denda', 'stat', 'Aktif');
															echo '<p style="color:red;font-size:18px;">' . $this->M_Admin->rp($jml * ($dd->harga_denda * $diff)) . '</p><small style="color:#333;">* Untuk ' . $jml . ' Buku</small>';
														} else {
															echo '<p style="color:green;">Tidak Ada Denda</p>';
														}
													}
													?>
												</td> -->



												<td style="text-align: center;"><?= $isi['jml_pinjam']; ?></td>
												<td>
													<?php if ($this->session->userdata('level') == 'Petugas') { ?>
														<?php if ($isi['status'] == 'Booking') : ?>
															<form action="<?= base_url('transaksi/ubahStatus/' . $isi['pinjam_id']); ?>" method="POST">
																<button type="submit" class="btn btn-success btn-sm" title="Ubah Status">
																	<i class="fa fa-check"></i> Dipinjamkan
																</button>
															</form>
														<?php endif; ?>

														<?php if ($isi['tgl_kembali'] == '0') { ?>
															<a href="<?= base_url('transaksi/kembalipinjam/' . $isi['pinjam_id']); ?>" class="btn btn-warning btn-sm" title="pengembalian buku">
																<i class="fa fa-sign-out"></i> Kembalikan
															</a>
														<?php } else { ?>
															<a href="javascript:void(0)" class="btn btn-success btn-sm" title```="pengembalian buku">
																<i class="fa fa-check"></i> kembalikan
															</a>
														<?php } ?>

														<a href="<?= base_url('transaksi/edit/' . $isi['pinjam_id']); ?>" class="btn btn-success btn-sm" title="edit pinjam">
															<i class="fa fa-edit"></i> Perpanjang
														</a>

														<?php if ($isi['tgl_kembali'] == '0') { ?>
															<a href="<?= base_url('transaksi/hilangpinjam/' . $isi['pinjam_id']); ?>" class="btn btn-primary btn-sm" title="pengembalian buku">
															<i class="fa-solid fa-book-skull"></i>  Hilang
															</a>
														<?php } else { ?>
															<a href="javascript:void(0)" class="btn btn-success btn-sm" title```="pengembalian buku">
															<i class="fa-solid fa-book-skull"></i>  Hilang
															</a>
														<?php } ?>

														<!-- <a href="<?= base_url('transaksi/edit/' . $isi['pinjam_id']); ?>" class="btn btn-primary btn-sm" title="edit pinjam">
															<i class="fa-solid fa-handshake-slash"></i> Hilang
														</a> -->
														<!-- <a href="<?= base_url('transaksi/detailpinjam/' . $isi['pinjam_id'] . '?pinjam=yes'); ?>" class="btn btn-primary btn-sm" title="detail pinjam">
														<i class="fa fa-eye"></i>
													</a> -->
														<a href="<?= base_url('transaksi/prosespinjam?pinjam_id=' . $isi['pinjam_id']); ?>" onclick="return confirm('Anda yakin Peminjaman Ini akan dihapus ?');" class="btn btn-danger btn-sm" title="Batal">
															<i class="fa fa-trash"></i> Hapus
														</a>
													<?php } else { ?>
														<div class="btn-group" role="group" style="display: flex;">
															<!-- <?php if ($isi['tgl_kembali'] == '0') { ?>
															<a href="<?= base_url('transaksi/kembalipinjam/' . $isi['pinjam_id']); ?>" class="btn btn-warning btn-sm" title="pengembalian buku">
																<i class="fa fa-sign-out"></i> Kembalikan
															</a>
														<?php } else { ?>
															<a href="javascript:void(0)" class="btn btn-success btn-sm" title="pengembalian buku">
																<i class="fa fa-check"></i> Dikembalikan
															</a>
														<?php } ?> -->

															<a href="<?= base_url('transaksi/detailpinjam/' . $isi['pinjam_id']); ?>" class="btn btn-primary btn-sm" title="detail pinjam">
																<i class="fa fa-eye"></i> Detail
															</a>
														<?php } ?>
														<?php if ($isi['status'] == 'Booking') : ?>
															<form action="<?= base_url('transaksi/UpdateStatus/' . $isi['pinjam_id']); ?>" method="POST">
																<button type="submit" class="btn btn-danger btn-sm" title="Ubah Status">
																	<i class="fa-solid fa-xmark"></i> Batal
																</button>
															</form>
														<?php endif; ?>
														</div>
												</td>
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

		</section>
	</div>

</body>

</html>