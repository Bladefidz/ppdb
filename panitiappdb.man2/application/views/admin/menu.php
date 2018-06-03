<ul class="sidebar-nav nav-pills nav-stacked" id="menu">
    <li class="<?php if($this->uri->segments(2)==""){echo 'active';} ?>">
        <a href="<?php echo HOME; ?>">
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-dashboard fa-stack-1x"></i>
            </span>
            Halaman Utama
        </a>
    </li>
    <li class="<?php if($this->uri->segments(2)=="pendaftaran"){echo 'active';} ?>">
        <a href="#">
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-edit fa-stack-1x"></i>
            </span>
            Pendaftaran
            <span class="fa-stack fa-lg arrow">
                <i class="fa fa-angle-down fa-stack-1x"></i>
            </span>
        </a>
        <ul class="nav-pills nav-stacked" style="list-style-type:none;">
            <li>
                <a href="<?php echo HOME."/pendaftaran"; ?>" >
                    Panel Pendaftaran
                </a>
            </li>
            <li>
                <a href="<?php echo HOME."/pendaftaran/data/1"; ?>">
                    Data Verifikasi
                </a>
            </li>
            <li>
                <a href="<?php echo HOME."/pendaftaran/data/3"; ?>">
                    Data Pendaftaran
                </a>
            </li>
        </ul>
    </li>
    <li class="<?php if($this->uri->segments(2)=="seleksi" || $this->uri->segments(2)=="tes"){echo 'active';} ?>">
        <a>
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-gavel fa-stack-1x"></i>
            </span>
            Seleksi
            <span class="fa-stack fa-lg arrow">
                <i class="fa fa-angle-down fa-stack-1x"></i>
            </span>
        </a>
        <ul class="nav-pills nav-stacked" style="list-style-type:none;">
            <li>
                <a href="<?php echo HOME."/tes"; ?>"> Tes Masuk</a>
            </li>
            <li>
                <a href="<?php echo HOME."/seleksi"; ?>"> Panel Seleksi</a>
            </li>
            <li>
                <a href="<?php echo HOME."/seleksi/data"; ?>"> Hasil Seleksi</a>
            </li>
            <!-- <li>
                <a href="<?php echo HOME."/seleksi/data/".date('Y'); ?>"> Seleksi Data Pendaftaran</a>
            </li> -->
        </ul>
    </li>
    <!-- <li class="">
        <a>
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-credit-card fa-stack-1x"></i>
            </span>
            Daftar Ulang
        </a>
        <ul class="nav-pills nav-stacked" style="list-style-type:none;">
            <li>
                <a href=""> Panel Daftar Ulang</a>
            </li>
        </ul>
    </li> -->
    <li class="<?php if($this->uri->segments(2)==="setting"){echo 'active';} ?>">
        <a>
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-wrench fa-stack-1x"></i>
            </span>
            Pengaturan Sistem
            <span class="fa-stack fa-lg arrow">
                <i class="fa fa-angle-down fa-stack-1x"></i>
            </span>
        </a>
        <ul class="nav-pills nav-stacked" style="list-style-type:none;">
            <li>
                <a href="<?php echo HOME."/setting" ?>">Panel Pengaturan</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/tahun" ?>">Pengaturan Tahun PPDB</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/gelombang" ?>">Pengaturan Gelombang</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/jalur" ?>">Pengaturan Jalur</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/pagu" ?>">Pengaturan Pagu</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/pedoman" ?>">Pengaturan Pedoman</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/alur" ?>">Pengaturan Alur</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/kontak" ?>">Pengaturan Kontak</a>
            </li>
            <li>
                <a href="<?php echo HOME."/setting/pengguna" ?>">Pengaturan Pengguna</a>
            </li>
        </ul>
    </li>
    <li class="<?php if($this->uri->segments(2)=="arsip"){echo 'active';} ?>">
        <a>
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-files-o fa-stack-1x"></i>
            </span>
            Arsip
            <span class="fa-stack fa-lg arrow">
                <i class="fa fa-angle-down fa-stack-1x"></i>
            </span>
        </a>
        <ul class="nav-pills nav-stacked" style="list-style-type:none;">
            <li>
                <a href="<?php echo HOME.""; ?>"> Arsip Pendaftaran</a>
            </li>
            <li>
                <a href="<?php echo HOME."" ?>"> Arsip Seleksi</a>
            </li>
        </ul>
    </li>
    <li class="<?php if($this->uri->segments(2)=="about"){echo 'active';} ?>">
        <a href=<?php echo HOME."/about" ?>>
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-support fa-stack-1x"></i>
            </span>
            Tentang Aplikasi
        </a>
    </li>
    <li class="<?php if($this->uri->segments(2)=="logout"){echo 'active';} ?>">
        <a href=<?php echo HOME."/logout" ?>>
            <span class="fa-stack fa-lg pull-left">
                <i class="fa fa-sign-out fa-stack-1x"></i>
            </span>
            Logout
        </a>
    </li>
</ul>
