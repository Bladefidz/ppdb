<div class="navbar-collapse collapse" id="navbar-main">
    <ul class="nav navbar-nav">
        <li>
            <a href="<?php echo HOME ?>"><i class="fa fa-home"></i> Halaman Utama</a>
        </li>
        <li>
            <a href="<?php echo HOME.'/pedoman' ?>"><i class="fa fa-warning"></i> Pedoman</a>
        </li>
        <li>
            <a href="<?php echo HOME.'/alur'?>"><i class="fa fa-exchange"></i> Alur</a>
        </li>
        <li>
            <a href="<?php echo HOME.'/jadwal'?>"><i class="fa fa-calendar"></i> Jadwal</a>
        </li>
        <li>
            <a href="<?php echo HOME.'/kontak'?>"><i class="fa fa-phone"></i> Kontak Panitia</a>
        </li>
    <?php if(!isset($_SESSION['id'])): ?>
        <li>
            <a href="<?php echo HOME.'/login'; ?>"><i class="fa fa-edit"></i> Pendaftaran Online</a>
        </li>
    <?php else: ?>
        <li>
            <a href="<?php echo HOME."/logout" ?>"><i class="fa fa-sign-out fa-fw"></i> Logout PPDB Online</a>
        </li>
    <?php endif; ?>
    </ul>
</div>
