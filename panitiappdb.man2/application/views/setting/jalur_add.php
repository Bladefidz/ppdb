<div class="row">
    <div class="panel-heading">
        <h2>
            Jalur PPDB Baru
        </h2>
    </div>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'id' => 'form_verifikasi',
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('setting/jalur/add', $attributes);
?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kode Jalur</label>
                        <div class="col-lg-2">
                            <input class="form-control" name="kj" value="" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Jalur</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="nj" value="" data-validate="required" required="required" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <center><input type="submit" class="btn btn-primary btn-lg" name="add" value="Selesai Buat Jalur Baru"></center>
            </div>
        </div>
    </div>
<?php echo $this->formHelper->formClose() ?>
