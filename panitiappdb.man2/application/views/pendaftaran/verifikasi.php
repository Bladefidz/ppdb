<div class="row">
    <div class="panel-heading">
        <h2>
            PROSES VERIFIKASI PPDB TAHUN <?php echo $thn ?>
        </h2>
    </div>
<?php if(!empty($notif)): ?>
    <div class="col-lg-12">
    <?php if($valid): ?>
        <div class="alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo $notif ?></strong>.
            <a class='btn btn-default btn-xs' href="<?php echo HOME.'/pendaftaran/data/1' ?>" >Lihat Data Verifikasi</a>
        </div>
    <?php else: ?>
        <div class="alert alert-dismissable alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo $notif ?></strong>.
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'id' => 'form_verifikasi',
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('pendaftaran/verifikasi', $attributes);
?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Verifikasi Data Dasar
            </div>
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">NISN</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="nisn" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                        <div class="col-lg-10">
                            <input class="form-control" name="nama" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">SMP/MTs Asal</label>
                        <div class="col-lg-4">
                            <input class="form-control" name="skl" placeholder="Contoh: SMPN 1 Ponorogo / SMPS 1 Ponorogo" required="required" type="text">
                        </div>
                        <label class="col-lg-2 control-label">Kabupaten</label>
                        <div class="col-lg-4">
                            <input class="form-control" name="skl_kab" placeholder="Contoh: Ponorogo" required="required" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--     <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Verifikasi Data Asal Sekolah
            </div>
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Provinsi</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="prov_skl" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kabupaten</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="kab_skl" required="required" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Status</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="stat_skl" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Sekolah</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="nm_skl" required="required" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Verifikasi Nilai UN Calon Peserta Didik
            </div>
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Bahasa Indonesia</label>
                        <div class="col-lg-2">
                            <input class="form-control" name="nilai_un_bi" placeholder="00.00" required="required" type="text">
                        </div>
                        <label class="col-lg-2 control-label">Bahasa Inggris</label>
                        <div class="col-lg-2">
                            <input class="form-control" name="nilai_un_bing" placeholder="00.00" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Matematika</label>
                        <div class="col-lg-2">
                            <input class="form-control" name="nilai_un_mat" placeholder="00.00" required="required" type="text">
                        </div>
                        <label class="col-lg-2 control-label">IPA</label>
                        <div class="col-lg-2">
                            <input class="form-control" name="nilai_un_ipa" placeholder="00.00" required="required" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Verifikasi Prestasi Calon Peserta Didik
            </div>
            <div class="panel-body" style="background: #FFF">
                <div id="pres0">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="hidden" >
                            <label class="col-lg-2 control-label">Nama Lomba</label>
                            <div class="col-lg-10">
                                <input class="form-control" name="nama_lomba0" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Juara</label>
                            <div class="col-lg-1">
                                <select class="form-control" name="pres_juara0">
                                    <option value="0" selected="selected"></option>
                                    <?php foreach ($pilJuara as $pj): ?>
                                        <option value='<?php echo $pj['id_prestasi_juara'] ?>'><?php echo $pj['no_juara'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label class="col-lg-2 control-label">Tingkat</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="pres_tngkt0">
                                   <option value="0" selected="selected"></option>
                                    <?php foreach ($pilTingkat as $pt): ?>
                                        <option value='<?php echo $pt['id_prestasi_tingkat'] ?>'><?php echo $pt['nama_tingkat'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prestasi0">
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-2 col-lg-offset-8">
                        <input type="button" class="btn btn-warning btn-md btn-block" name="hapus_pres" value="Hapus Prestasi" id="hpsPres">
                    </div>
                    <div class="col-lg-2">
                        <input type="button" class="btn btn-default btn-md btn-block" name="tambah_pres" value="Tambah Prestasi" id="tmbPres">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Informasi Penerimaan
            </div>
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tahun Masuk</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="thn" id="thn" required="required" onchange="ajaxgel(this.value)">
                                <option value=''>pilih tahun penerimaan</option>
                            <?php foreach ($pilThn as $pt): ?>
                                <option value='<?php echo $pt['tahun_ajaran'] ?>'><?php echo $pt['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-lg-2 control-label">Gelombang</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="id_gel" id="gel" required="required">
                                <option value="">pilih tahun dulu</option>
                            </select>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div style="background: #FFF; margin-bottom: 5px">
            <input type="hidden" value="0" id="count" name="count"></div>
            <center><input type="submit" class="btn btn-primary btn-lg" name="validasi" value="Selesai" id="tombol"></center>
        </div>
    </div>
<?php echo $this->formHelper->formClose(); ?>
</div>
