<div class="row">
    <div class="panel-heading">
        <h2>
            Perbarui Nilai Tes Masuk Calon Peserta Didik
        </h2>
    </div>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('tes/update/'.$id , $attributes);
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
                        <label class="col-lg-2 control-label">Rasio Nilai</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="nt" value="<?php echo $cpd[0]['nilai_tes'] ?>" data-validate="required" required="required" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <center><input type="submit" class="btn btn-primary btn-lg" name="update" value="Selesai Merubah Nilai Tes"></center>
            </div>
        </div>
    </div>
<?php echo $this->formHelper->formClose() ?>
