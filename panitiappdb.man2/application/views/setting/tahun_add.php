<div class="row">
    <div class="panel-heading">
        <h2>
            Tambah Tahun PPDB
        </h2>
    </div>
</div>
<div class="row">
    <?php
        $attributes = array(
            'class' => "form-horizontal",
            'role' => "form",
            'enctype' => "multipart/form-data"
        );
        echo $this->formHelper->formOpen('setting/tahun/add', $attributes);
    ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body" style="background: #FFF">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tahun PPDB</label>
                            <div class="col-lg-10">
                                <input class="form-control" name="thn" value="" required="required" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body" style="background: #FFF">
                    <center><input type="submit" class="btn btn-primary btn-lg" name="add" value="Tambah Tahun"></center>
                </div>
            </div>
        </div>
    <?php echo $this->formHelper->formClose() ?>
</div>
