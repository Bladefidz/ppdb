<div class="row">
    <div class="panel-heading">
        <h2>
            Tambah Kontak PPDB
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
        echo $this->formHelper->formOpen('setting/kontak/add', $attributes);
    ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body" style="background: #FFF">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Kontak</label>
                            <div class="col-lg-10">
                                <input class="form-control" name="nama" value="" required="required" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat</label>
                            <div class="col-lg-10">
                                <input class="form-control" name="alamat" value="" required="required" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Telepon</label>
                            <div class="col-lg-3">
                                <input class="form-control" name="tlp" value="" required="required" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">HP</label>
                            <div class="col-lg-3">
                                <input class="form-control" name="hp" value="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-3">
                                <input class="form-control" name="email" value="" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body" style="background: #FFF">
                    <center><input type="submit" class="btn btn-primary btn-lg" name="add" value="Tambah Kontak"></center>
                </div>
            </div>
        </div>
    <?php echo $this->formHelper->formClose() ?>
</div>
