<span class="input-group-btn">
    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#TableAnggota">
        <i class="fa fa-search"></i>
    </button>
</span>

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

<div class="modal fade" id="TableAnggota">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Anggota</h4>
			</div>
			<div id="modal_body" class="modal-body fileSelection1">
				<table id="example3" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>ID</th>
							<th>Nama</th>
							<th>Jenkel</th>
							<th>Telepon</th>
							<th>Level</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($user as $isi) {
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
									<button class="btn btn-primary" id="Select_File1" data_id="<?= $isi['anggota_id']; ?>">
										<i class="fa fa-check"> </i> Pilih
									</button>
								</td>
							</tr>

							<?php $no++;

						} ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	$(".fileSelection1 #Select_File1").click(function (e) {
		document.getElementsByName('anggota_id')[0].value = $(this).attr("data_id");
		$('#TableAnggota').modal('hide');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('transaksi/result'); ?>",
			data: 'kode_anggota=' + $(this).attr("data_id"),
			beforeSend: function () {
				$("#result").html("");
				$("#result_tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
			},
			success: function (html) {
				$("#result").html(html);
				$("#result_tunggu").html('');
			}
		});
	});
</script>

<script>
	// AJAX call for autocomplete 
	$(document).ready(function () {
		$("#search-box").keyup(function () {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('transaksi/result'); ?>",
				data: 'kode_anggota=' + $(this).val(),
				beforeSend: function () {
					$("#result").html("");
					$("#result_tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
				},
				success: function (html) {
					$("#result").html(html);
					$("#result_tunggu").html('');
				}
			});
		});
	});
</script>