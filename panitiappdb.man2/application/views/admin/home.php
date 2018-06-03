<div class="row">
    <div class="panel-heading">
        <h2>
            SISTEM INFORMASI PPDB
        </h2>
<?php if($readyForNowYear === true): ?>
        <div class="alert alert-success-flat">
            <h4>Tahun Aktif: <?php echo $thnAjaran ?></h4>
            Sistem Siap Untuk Menyelenggarakan PPDB Tahun Ajaran <strong><?php echo $thnAjaran ?></strong>.
            Untuk melihat detail pengaturan sistem informasi PPDB silahkan lihat
            <a class="alert-link" href="#">Pengaturan Sistem</a>
        </div>
<?php else: ?>
        <div class="alert alert-danger-flat">
            Sistem Belum Siap Untuk Menyelenggarakan PPDB Tahun Ajaran <strong><?php echo $thnAjaran ?></strong>.
            Hal ini dikarekan sistem akan melakukan pengecekan berdasarkan pergantian tahun.
            Untuk sementara anda hanya diperbolehkan mengakses data pada tahun ajaran sebelumnya.
            Silahkan lakukan <a class="alert-link" href="#">Pengaturan Sistem</a>
        </div>
<?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $numGels ?></div>
                        <div>Gelombang</div>
                    </div>
                </div>
            </div>
            <a href=<?php echo HOME."/setting/gelombang" ?>>
                <div class="panel-footer">
                    <span class="pull-left">Lihat Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $numJalur ?></div>
                        <div>Jalur</div>
                    </div>
                </div>
            </div>
            <a href=<?php echo HOME."/setting/jalur" ?>>
                <div class="panel-footer">
                    <span class="pull-left">Lihat Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag-checkered fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $pagu ?></div>
                        <div>Pagu</div>
                    </div>
                </div>
            </div>
            <a href=<?php echo HOME."/setting/pagu" ?>>
                <div class="panel-footer">
                    <span class="pull-left">Lihat Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-child fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $numPendf ?></div>
                        <div>Pendaftar</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'/pendaftaran/data/1' ?>">
                <div class="panel-footer">
                    <span class="pull-left">Lihat Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-child fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $numComplete ?></div>
                        <div>Data Lengkap</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'/pendaftaran/data/3' ?>">
                <div class="panel-footer">
                    <span class="pull-left">Lihat Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-child fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $numRecieve ?></div>
                        <div>Diterima</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'/seleksi/data' ?>">
                <div class="panel-footer">
                    <span class="pull-left">Lihat Detail</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
