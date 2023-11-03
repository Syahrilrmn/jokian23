<?php if (!defined('BASEPATH'))
    exit('No direct script acess allowed'); ?>
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Forms</div>
        </div>
        <!--end breadcrumb-->

        <!--start stepper one-->


        <div id="stepper1" class="bs-stepper">
            <div class="card">


                <div class="card-body">

                    <div class="bs-stepper-content">
                        <form form action="<?php echo base_url('Notifikasi/store'); ?>" method="POST"
                            enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12 ">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                                </div>
                                <div id="pekerja-list" class="col-12">
                                    <!-- Tempat untuk menampilkan daftar pekerja -->
                                </div>
                                <div class="">
                                    <br>
                                    <div class="d-flex align-items-center gap-3">
                                        <button id="tambah-pekerja" type="button" class="btn btn-primary">Tambah
                                            Pekerja</button>
                                        <button class="btn btn-success px-4">Submit</button>
                                    </div>
                                </div>
                            </div><!---end row-->
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mendeteksi klik pada tombol "Tambah Pekerja"
        document.getElementById('tambah-pekerja').addEventListener('click', function () {
            // Membuat div untuk grup elemen input
            var divPekerja = document.createElement('div');
            divPekerja.setAttribute('class', 'col-12');

            // Membuat label untuk Nama
            var labelNama = document.createElement('label');
            labelNama.textContent = 'Nama Pekerja';
            labelNama.setAttribute('for', 'nama-pekerja');
            labelNama.setAttribute('class', 'form-label');

            // Membuat textarea untuk Nama
            var textareaNama = document.createElement('textarea');
            textareaNama.setAttribute('placeholder', 'Nama Pekerja');
            textareaNama.setAttribute('class', 'form-control');
            textareaNama.setAttribute('name', 'namaPegawai[]');
            textareaNama.setAttribute('id', 'nama-pekerja');
            textareaNama.setAttribute('rows', '3');

            // Membuat label untuk Deskripsi Pekerjaan
            var labelDeskripsi = document.createElement('label');
            labelDeskripsi.textContent = 'Deskripsi Pekerjaan';
            labelDeskripsi.setAttribute('for', 'deskripsi-pekerjaan');
            labelDeskripsi.setAttribute('class', 'form-label');

            // Membuat textarea untuk Deskripsi Pekerjaan
            var textareaDeskripsi = document.createElement('textarea');
            textareaDeskripsi.setAttribute('placeholder', 'Deskripsi Pekerjaan');
            textareaDeskripsi.setAttribute('class', 'form-control');
            textareaDeskripsi.setAttribute('id', 'deskripsi-pekerjaan');
            textareaDeskripsi.setAttribute('name', 'isiPengumuman[]');
            textareaDeskripsi.setAttribute('rows', '3');

            // Membuat tombol untuk menghapus pekerja
            var tombolHapus = document.createElement('button');
            tombolHapus.textContent = 'Hapus Pekerja';
            tombolHapus.setAttribute('class', 'btn btn-danger mt-3 mb-3');

            // Mendeteksi klik pada tombol "Hapus Pekerja"
            tombolHapus.addEventListener('click', function () {
                // Menghapus elemen pekerja saat tombol "Hapus Pekerja" diklik
                divPekerja.remove();
            });

            // Menambahkan elemen-elemen ke dalam div grup pekerja
            divPekerja.appendChild(labelNama);
            divPekerja.appendChild(textareaNama);
            divPekerja.appendChild(labelDeskripsi);
            divPekerja.appendChild(textareaDeskripsi);
            divPekerja.appendChild(tombolHapus);

            // Menambahkan div grup pekerja ke dalam daftar pekerja
            document.getElementById('pekerja-list').appendChild(divPekerja);
        });
    });

</script>