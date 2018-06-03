<div class="sidebar" role="navigation" style="background-color: #FFF; border-color: #F8F8F8;">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><b><?php echo $title; ?></b><span style="vertical-align: middle;" class="label label-primary pull-right">Menu</span></a>
                <ul class="nav">
                    <li>
                        <a class="<?php if($this->uri->segments(2)==""){echo 'active';} ?>" href="<?php echo HOME; ?>"><i class="fa fa-home fa-fw"></i> Halaman Utama</a>
                    </li>
                    <li class="<?php if($this->uri->segments(2)=="pendaftaran"){echo 'active';} ?>">
                        <a><i class="fa fa-edit fa-fw"></i> Pendaftaran<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="<?php if($this->uri->segments(3)=="input"){echo 'active';} ?>" href="<?php echo HOME.'/pendaftaran/input' ?>">Input Calon Siswa</a>
                            </li>
                            <li>
                                <a class="<?php if($this->uri->segments(3)=="data"){echo 'active';} ?>" href="<?php echo HOME.'/pendaftaran/data' ?>">Data Pendaftar</a>
                            </li>
                            <li>
                                <a class="<?php if($this->uri->segments(3)=="statistik"){echo 'active';} ?>" href="<?php echo HOME.'/pendaftaran/statistik' ?>">Statistik Pendaftar</a>
                            </li>
                            <li class="<?php if($this->uri->segments(3)=="eksport"){echo 'active';} ?>" >
                                <a>Export<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a class="<?php if($this->uri->segments(4)=="excel"){echo 'active';} ?>" href="?p=ke_excel_att" onclick="return buka('pendaftaran/ke_excel.php');">Excel</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li class="<?php if($this->uri->segments(2)=="seleksi"){echo 'active';} ?>">
                        <a><i class="fa fa-gavel fa-fw"></i> Seleksi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="<?php if($this->uri->segments(3)=="prosesseleksi"){echo 'active';} ?>" href="<?php echo HOME.'/seleksi/proses' ?>">Proses Seleksi</a>
                            </li>
                            <li>
                                <a class="<?php if($this->uri->segments(3)=="hasilseleksi"){echo 'active';} ?>" href="<?php echo HOME.'/seleksi/hasil' ?>">Lolos Seleksi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if($this->uri->segments(2)=="pembayaran"){echo 'active';} ?>">
                        <a href=""><i class="fa fa-credit-card fa-fw"></i> Pembayaran<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="<?php if($this->uri->segments(3)=="reguler"){echo 'active';} ?>" href="/ppdbman2/reguler">Reguler</a>
                            </li>
                            <li>
                                <a class="<?php if($this->uri->segments(3)=="beasiswa"){echo 'active';} ?>" href="/ppdbman2/beasiswa">Beasiswa</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li class="<?php if($this->uri->segments(2)=="administrator"){echo 'active';} ?>">
                        <a href=""><i class="fa fa-wrench fa-fw"></i> Admin <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php if($this->uri->segments(3)){echo 'active';} ?>">
                                <a>Tools <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a class="<?php if($this->uri->segments(3)=="backup"){echo 'active';} ?>" href="/ppdbman2/backup">Backup Restore Data</a></li>
                                </ul>
                            </li>
                            <li><a class="<?php if($this->uri->segments(3)=="editadmin"){echo 'active';} ?>" href="/ppdbman2/editadmin">Setting</a></li>
                            <li><a href="<?php echo HOME.'/logout' ?>">Logout</a></li>
                        </ul>
                    </li>
                    <li class="<?php if($this->uri->segments(2)=="about"){echo 'active';} ?>">
                        <a href=<?php echo HOME."/about" ?>><i class="fa fa-support fa-fw"></i>Tentang Aplikasi</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
