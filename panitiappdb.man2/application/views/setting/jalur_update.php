<div class="row">
    <div class="panel-heading">
        <h2>
            Edit Jalur PPDB
        </h2>
    </div>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'id' => 'form_update',
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('setting/jalur/update/'.$id , $attributes);
?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kode Jalur</label>
                        <div class="col-lg-2">
                            <input class="form-control" name="kj" value="<?php echo $jalur[0]['kode_jalur'] ?>" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Jalur</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="nj" value="<?php echo $jalur[0]['nama_jalur'] ?>" data-validate="required" required="required" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <center><input type="submit" class="btn btn-primary btn-lg" name="update" value="Selesai Merubah Jalur"></center>
            </div>
        </div>
    </div>
<?php echo $this->formHelper->formClose() ?>
