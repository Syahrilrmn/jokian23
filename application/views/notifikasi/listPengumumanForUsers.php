<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <div class="container">
            <div class="row">
                <?php $no = 1;
                foreach ($data as $isi) : ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <span class="badge text-bg-primary">
                                    <?= $isi->Pegawai_Tujuan; ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p> <?= $isi->Isi_Pengumuman; ?></p>
                                    <footer class="blockquote-footer"><?= $isi->Tanggal; ?></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <nav aria-label="Page navigation">
    <?php echo $this->pagination->create_links(); ?>
</nav>

        </div>
    </div>
</div>
<script>
    function closeAlert() {
        document.getElementById('alertBerhasil').style.display = 'none';
        document.getElementById('alertGagal').style.display = 'none';
    }

    // Tambahkan kode untuk menutup otomatis setelah 3 detik
    setTimeout(function() {
        closeAlert();
    }, 5000); // 5000 milidetik (5 detik)
</script>