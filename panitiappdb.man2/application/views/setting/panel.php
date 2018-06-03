<div class="row">
    <div class="panel-heading">
        <h2>
            PANEL PENGATURAN SISTEM PPDB
        </h2>
    <?php if($validSetting === true): ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Sistem Siap Berjalan. Tahun Penerimaan Yang Saat Ini Aktif: <?php echo $thnAjar ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Sistem Belum Siap Berjalan. Ada Beberapa Pengaturan Yang Belum Diatur.
        </div>
    <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Tahun Penerimaan</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'/setting/tahun' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Gelombang</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'/setting/gelombang' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Jalur</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'/setting/jalur' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag-checkered fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Pagu</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'/setting/pagu' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Pedoman PPDB</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'setting/pedoman' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Alur PPDB</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'setting/alur' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-phone fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Kontak PPDB</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'setting/kontak' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Pengguna</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo HOME.'setting/pengguna' ?>" >
                <div class="panel-footer">
                    <span class="pull-left">Setting</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
