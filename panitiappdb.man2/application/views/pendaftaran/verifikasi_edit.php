<div class="row">
    <div class="panel-heading">
        <h2>
            EDIT DATA VERIFIKASI
        </h2>
    </div>
<?php if(!empty($notif)): ?>
    <div class="col-lg-12">
        <div class="alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo $notif ?></strong>.
            <a class='btn btn-default btn-xs' href="<?php echo HOME.'/pendaftaran/data/1' ?>" >Lihat Data Verifikasi</a>
        </div>
    </div>
<?php endif; ?>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'id' => 'form_verifikasi',
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('pendaftaran/verifikasi/edit/'.$cpd[0]['id_pendaftaran'].'/'.$cpd[0]['id_validasi'], $attributes);
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
                            <input value="<?php echo $cpd[0]['nisn'] ?>" class="form-control" name="nisn" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                        <div class="col-lg-10">
                            <input value="<?php echo $cpd[0]['nama'] ?>" class="form-control" name="nama" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">SMP/MTs Asal</label>
                        <div class="col-lg-4">
                            <input value="<?php echo $cpd[0]['nama_skl'] ?>" class="form-control" name="skl" required="required" type="text">
                        </div>
                        <label class="col-lg-2 control-label">Kabupaten</label>
                        <div class="col-lg-4">
                            <input value="<?php echo $cpd[0]['kabupaten_skl'] ?>" class="form-control" name="skl_kab" required="required" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            <input value="<?php echo $cpd[0]['nilai_un_bi'] ?>" class="form-control" name="nilai_un_bi" required="required" type="text">
                        </div>
                        <label class="col-lg-2 control-label">Bahasa Inggris</label>
                        <div class="col-lg-2">
                            <input value="<?php echo $cpd[0]['nilai_un_bing'] ?>" class="form-control" name="nilai_un_bing" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Matematika</label>
                        <div class="col-lg-2">
                            <input value="<?php echo $cpd[0]['nilai_un_mat'] ?>" class="form-control" name="nilai_un_mat" required="required" type="text">
                        </div>
                        <label class="col-lg-2 control-label">IPA</label>
                        <div class="col-lg-2">
                            <input value="<?php echo $cpd[0]['nilai_un_ipa'] ?>" class="form-control" name="nilai_un_ipa" required="required" type="text">
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
            <?php $no=0; ?>
            <?php
                if(count($prestasi) === 0) {
                    $selNull = "selected";
                } else {
                    $selNull = "";
                }
            ?>
            <?php foreach ($prestasi as $pres): ?>
                <?php $num = $no++ ?>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="hidden" >
                        <label class="col-lg-2 control-label">Nama Lomba</label>
                        <div class="col-lg-10">
                            <input class="form-control" value="<?php echo $pres['nama_prestasi'] ?>" name="nama_lomba<?php echo $num ?>" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Juara</label>
                        <div class="col-lg-1">
                            <select class="form-control" name="pres_juara<?php echo $num ?>">
                                <option <?php echo $selNull ?> value="0"></option>
                                <?php foreach ($pilJuara as $pj): ?>
                                    <?php
                                        if($pj['id_prestasi_juara'] === $pres['id_prestasi_juara']){
                                            $selt = "selected";
                                        } else {
                                            $selt = "";
                                        }
                                    ?>
                                    <option <?php echo $selt ?> value='<?php echo $pj['id_prestasi_juara'] ?>'><?php echo $pj['no_juara'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-lg-2 control-label">Tingkat</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="pres_tngkt<?php echo $num ?>">
                               <option <?php echo $selNull ?> value="0" selected="selected"></option>
                                <?php foreach ($pilTingkat as $pt): ?>
                                    <?php
                                        if($pt['id_prestasi_tingkat'] === $pres['id_prestasi_tingkat']){
                                            $selt = "selected";
                                        } else {
                                            $selt = "";
                                        }
                                    ?>
                                    <option <?php echo $selt ?> value='<?php echo $pt['id_prestasi_tingkat'] ?>'><?php echo $pt['nama_tingkat'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div id="prestasi0">
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-2 pull-right">
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
                                <?php
                                    if ($pt['tahun_ajaran'] == $cpd[0]['id_tahun_ajaran']) {
                                        $selt = "selected";
                                    } else {
                                        $selt = "";
                                    }
                                ?>
                                <option selected="<?php echo $selt ?>" value='<?php echo $pt['tahun_ajaran'] ?>'><?php echo $pt['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-lg-2 control-label">Gelombang</label>
                        <div class="col-lg-3">
                            <select class="form-control" name="idGel" id="gel" required="required">
                                <option value="<?php echo $cpd[0]["id_gel"] ?>"><?php echo $cpd[0]["gelombang"] ?></option>
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
            <center><input type="submit" class="btn btn-primary btn-lg" name="Edit" value="Selesai Edit Data Verifikasi" id="tombol"></center>
        </div>
    </div>
<?php echo $this->formHelper->formClose(); ?>
</div>
