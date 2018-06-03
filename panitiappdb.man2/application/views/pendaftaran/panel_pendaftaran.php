<div class="row">
    <div class="col-lg-12">
        <div class="panel-heading">
            <h2>Panel Pendaftaran</h2>
            Calon Peserta Didik Harus Melalui Proses <span class="label label-primary">Verifikasi</span>
            Terlebih Dahulu Sebelum Melakukan Proses <span class="label label-primary">Pendaftaran</span></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4">
            <div class="bs-component">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Verifikasi Calon Peserta Didik</h3>
                    </div>
                    <div class="panel-body">
                        Input Data proses verifikasi:
                        <ul>
                            <li>Input Nama Lengkap</li>
                            <li>Input NISN</li>
                            <li>Input Data Sekolah Asal</li>
                            <li>Input Data Akademik</li>
                            <li>Input Data Prestasi</li>
                        </ul>
                        <a href="<?php echo HOME.'/pendaftaran/verifikasi' ?>" class="btn btn-primary btn-lg btn-block">Proses Verifikasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="bs-component">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pendaftaran Calon Peserta Didik</h3>
                    </div>
                    <div class="panel-body">
                        Input Data proses pendataan:
                        <ul>
                            <li>Input Biodata Calon Peserta Didik</li>
                            <li>Input Biodata Wali Calon Peserta Didik</li>
                            <li>Pilih Jalur Pedaftaran</li>
                        </ul>
                        <br></br>
                        <a href="<?php echo HOME.'/pendaftaran/data/terverifikasi' ?>" class="btn btn-primary btn-lg btn-block">Proses Pendaftaran</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="bs-component">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Calon Peserta Didik</h3>
                    </div>
                    <div class="panel-body">
                        Data:
                        <ul>
                            <li>Data Calon Peserta Didik Terdaftar</li>
                        </ul>
                        <br></br>
                        <br></br>
                        <a href="<?php echo HOME.'/pendaftaran/data/terdaftar' ?>" class="btn btn-primary btn-lg btn-block">Lihat Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->formHelper->formClose(); ?>
