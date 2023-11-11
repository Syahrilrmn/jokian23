<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?php echo base_url(); ?>assets/images/logo.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SIM United Tractors</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li class="menu-label">Main navigation</li>
        <li>
            <a href="<?php echo base_url("Dashboard"); ?>">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <?php if ($this->session->userdata('level') == 'Admin') { ?>
            <li>
                <a href="<?php echo base_url("pengguna"); ?>">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title">Data Pengguna</div>
                </a>
            </li>
        <?php } ?>

        <li class="menu-label">Data Master</li>
        <li>
            <a href="<?php echo base_url("barang"); ?>">
                <div class="parent-icon"><i class='bx bx-briefcase'></i>
                </div>
                <div class="menu-title">Data Barang</div>
            </a>
        </li>
        <?php if ($this->session->userdata('level') == 'Admin') { ?>
            <li>
            <li>
                <a href="<?php echo base_url("Solar"); ?>">
                    <div class="parent-icon"><i class='bx bx-color-fill'></i>
                    </div>
                    <div class="menu-title">Data Solar</div>
                </a>
            </li>
            </li>
            <li>
                <a href="<?php echo base_url("Notifikasi"); ?>">
                    <div class="parent-icon"><i class='bx bx-message-rounded-check'></i>
                    </div>
                    <div class="menu-title">Data Pengumuman Tugas</div>
                </a>
            </li>
        <?php } ?>
        <li class="menu-label">Data Transaksi</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-shuffle'></i>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="<?php echo base_url("TransaksiBarang"); ?>"><i class='bx bx-radio-circle'></i>Peminjaman
                        Barang</a>
                </li>
                <li> <a href="<?php echo base_url("TransaksiBarang/kembali"); ?>"><i
                            class='bx bx-radio-circle'></i>Pengembalian Barang</a>
                </li>
                <li> <a href="<?php echo base_url("SolarTransaction"); ?>"><i class='bx bx-radio-circle'></i>Transaksi
                        Solar</a>
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


    </ul>
    <!--end navigation-->
</div>