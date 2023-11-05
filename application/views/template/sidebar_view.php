<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?php echo base_url(); ?>assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Syndron</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <?php if ($this->session->userdata('level') == 'Admin') { ?>
            <li class="menu-label">Main navigation</li>
            <li>
                <a href="<?php echo base_url("Dashboard"); ?>">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url("pengguna"); ?>">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Data Pengguna</div>
                </a>
            </li>
            <li class="menu-label">Data Master</li>
            <li>
                <a href="<?php echo base_url("barang"); ?>">
                    <div class="parent-icon"><i class='bx bx-briefcase'></i>
                    </div>
                    <div class="menu-title">Data Barang</div>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url("Solar"); ?>">
                    <div class="parent-icon"><i class='bx bx-color-fill'></i>
                    </div>
                    <div class="menu-title">Data Solar</div>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url("Notifikasi"); ?>">
                    <div class="parent-icon"><i class='bx bx-message-rounded-check'></i>
                    </div>
                    <div class="menu-title">Data Pengumuman Tugas</div>
                </a>
            </li>
            <li class="menu-label">Data Transaksi</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-shuffle'></i>
                    </div>
                    <div class="menu-title">Transaksi</div>
                </a>
                <ul>
                    <li> <a href="<?php echo base_url("TransaksiBarang"); ?>"><i class='bx bx-radio-circle'></i>Peminjaman Barang</a>
                    </li>
                    <li> <a href="<?php echo base_url("SolarTransaction"); ?>"><i class='bx bx-radio-circle'></i>Transaksi Solar</a>
                    </li>
                </ul>
            </li>

            <!-- <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-repeat"></i>
                        </div>
                        <div class="menu-title">Content</div>
                    </a>
                    <ul>
                        <li> <a href="content-grid-system.html"><i class='bx bx-radio-circle'></i>Grid System</a>
                        </li>
                        <li> <a href="content-typography.html"><i class='bx bx-radio-circle'></i>Typography</a>
                        </li>
                        <li> <a href="content-text-utilities.html"><i class='bx bx-radio-circle'></i>Text Utilities</a>
                        </li>
                    </ul>
                </li> -->
            <li>
            <li>
                <a href="<?php echo base_url("Notifikasi/listPengumuman"); ?>">
                    <div class="parent-icon"><i class='bx bx-message-alt-detail'></i>
                    </div>
                    <div class="menu-title">Pengumuman Tugas</div>
                </a>
            </li>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"> <i class="bx bx-printer"></i>
                    </div>
                    <div class="menu-title">Laporan</div>
                </a>
                <ul>
                    <li> <a href="<?php echo base_url("barang/laporan"); ?>"><i class='bx bx-radio-circle'></i>Barang</a>
                    </li>
                    <li> <a href="icons-boxicons.html"><i class='bx bx-radio-circle'></i>Solar</a>
                    </li>
                    <li> <a href="icons-feather-icons.html"><i class='bx bx-radio-circle'></i>Peminjaman Barang</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url("login/logout"); ?>">
                    <div class="parent-icon"><i class='bx bx-log-out'></i>
                    </div>
                    <div class="menu-title">Logout</div>
                </a>
            </li>

            <?php } ?>
            <!-- Hak Akses User -->
            <?php if ($this->session->userdata('level') == 'User') { ?> 
                <li class="menu-label">Main navigation</li>
            <li>
                <a href="<?php echo base_url("Dashboard"); ?>">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <!-- <li>
                <a href="<?php echo base_url("pengguna"); ?>">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Data Pengguna</div>
                </a>
            </li> -->
            <li class="menu-label">Data Master</li>
            <li>
                <a href="<?php echo base_url("barang"); ?>">
                    <div class="parent-icon"><i class='bx bx-briefcase'></i>
                    </div>
                    <div class="menu-title">Data Barang</div>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url("Solar"); ?>">
                    <div class="parent-icon"><i class='bx bx-color-fill'></i>
                    </div>
                    <div class="menu-title">Data Solar</div>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url("Notifikasi"); ?>">
                    <div class="parent-icon"><i class='bx bx-message-rounded-check'></i>
                    </div>
                    <div class="menu-title">Data Pengumuman Tugas</div>
                </a>
            </li>
            <!-- <li class="menu-label">Data Transaksi</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-shuffle'></i>
                    </div>
                    <div class="menu-title">Transaksi</div>
                </a>
                <ul>
                    <li> <a href="<?php echo base_url("TransaksiBarang"); ?>"><i class='bx bx-radio-circle'></i>Peminjaman Barang</a>
                    </li>
                </ul>
            </li> -->

            <li>
            <li>
                <a href="<?php echo base_url("Notifikasi/listPengumuman"); ?>">
                    <div class="parent-icon"><i class='bx bx-message-alt-detail'></i>
                    </div>
                    <div class="menu-title">Pengumuman Tugas</div>
                </a>
            </li>
            </li>
            <!-- <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"> <i class="bx bx-printer"></i>
                    </div>
                    <div class="menu-title">Laporan</div>
                </a>
                <ul>
                    <li> <a href="<?php echo base_url("barang/laporan"); ?>"><i class='bx bx-radio-circle'></i>Barang</a>
                    </li>
                    <li> <a href="icons-boxicons.html"><i class='bx bx-radio-circle'></i>Solar</a>
                    </li>
                    <li> <a href="icons-feather-icons.html"><i class='bx bx-radio-circle'></i>Peminjaman Barang</a>
                    </li>
                </ul>
            </li> -->
            <li>
                <a href="<?php echo base_url("login/logout"); ?>">
                    <div class="parent-icon"><i class='bx bx-log-out'></i>
                    </div>
                    <div class="menu-title">Logout</div>
                </a>
            </li>

                <?php } ?>
    </ul>
    <!--end navigation-->
</div>