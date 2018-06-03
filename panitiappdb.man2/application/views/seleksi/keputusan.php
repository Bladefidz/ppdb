<div class="row">
    <div class="panel-heading">
        <h2>
            Keputusan Penerimaan Calon Peserta Didik Gelombang <?php echo $gel ?> Tahun Ajaran <?php echo $thn.'/'.($thn+1) ?>
        </h2>
    </div>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('seleksi/keputusan/'.$id.'/'.$idjalurRec.'/'.$idjalurKep , $attributes);
?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">No Pendaftaran</label>
                        <div class="col-lg-2">
                            <input class="form-control" name="np" value="<?php echo $cpd[0]['kode'] ?>" id="disabledInput" disabled="disabled" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="n" value="<?php echo $cpd[0]['nama'] ?>" id="disabledInput" disabled="disabled" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Rekomendasi</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="rec" value="<?php echo $rekomendasi ?>" id="disabledInput" disabled="disabled" data-validate="required" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Keputusan</label>
                        <div class="col-lg-10">
                            <?php foreach ($pilJalur as $pj): ?>
                                <?php
                                if(!empty($keputusan)) {
                                    if ($pj['id_jalur'] == $keputusan[0]['id_jalur']) {
                                        $check = "checked";
                                    } else {
                                        $check = "";
                                    }
                                } else {
                                    $check = "";
                                }
                                ?>
                                <div class="radio-inline">
                                    <label>
                                        <input <?php echo $check ?> name="kep" value="<?php echo $pj['id_jalur']; ?>" type="radio"><?php echo $pj['nama_jalur']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <center><input type="submit" class="btn btn-primary btn-lg" name="update" value="Selesai Memutuskan"></center>
            </div>
        </div>
    </div>
<?php echo $this->formHelper->formClose() ?>
