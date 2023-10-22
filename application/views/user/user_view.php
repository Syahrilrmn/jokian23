<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="<?php echo base_url("pengguna/tambah");?>" class="btn btn-success px-5">
                        <i class='fa fa-plus mr-1'></i> Tambah Data
                    </a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        <h6 class="mb-0 text-uppercase">DataTable Import</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                                <th>No</th>
                               
                                <th>Foto</th>
                                <th>Nama Pengguna</th>
                                <th>Gmail</th>
                                <th>Jenis kelamin</th>
                                <th>Alamat</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;foreach($user as $isi){?>
                            <tr>
                                <td><?= $no;?></td>
                               
                                <td>
                                    <center>
                                        <?php if(!empty($isi['foto'] !== "-")){?>
                                        <img src="<?php echo base_url();?>assets/images/pengguna/<?php echo $isi['foto'];?>" alt="#" 
                                        class="img-responsive" style="height:100px;width:100px;"/>
                                        <?php }else{?>
                                            <!--<img src="" alt="#" class="user-image" style="border:2px solid #fff;"/>-->
                                            <i class="fa fa-user fa-3x" style="color:#333;"></i>
                                        <?php }?>
                                    </center>
                                </td>
                                <td><?= $isi['user'];?></td>
                                <td><?= $isi['email'];?></td>
                                <td><?= $isi['jenkel'];?></td>
                                <td><?= $isi['alamat'];?></td>
                                <td >
                                    <center>
                                    <a href="<?= base_url('pengguna/edit/'.$isi['id_login']);?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    <a href="<?= base_url('pengguna/del/'.$isi['id_login']);?>" onclick="return confirm('Anda yakin Anggota akan dihapus ?');">
									<button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                    </center>
                                </td>
                            </tr>
                        <?php $no++;}?>
                        </tbody>
                        <!-- <tfoot>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
									</tr>
								</tfoot> -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>