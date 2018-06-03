<div class="row">
    <div class="panel-heading">
        <h2>
            Gelombang Baru Pada Tahun Aktif PPDB <?php $thn ?>
        </h2>
    </div>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'id' => 'form_verifikasi',
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('setting/gelombang/add', $attributes);
?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gelombang</label>
                        <div class="col-lg-10">
                            <input class="form-control" name="gel" value="" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Pendaftaran Dibuka</label>
                        <div class="col-lg-3">
                            <div class='input-group date datePicker'>
                                <input class="form-control datePicker" name="pbuka" value="" data-validate="required" required="required" type="text">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Pendaftaran Ditutup</label>
                        <div class="col-lg-3">
                            <div class='input-group input-append date datePicker'>
                                <input class="form-control" name="ptutup" value="" data-validate="required" required="required" type="text">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tes</label>
                        <div class="col-lg-3">
                            <div class='input-group input-append date datePicker' >
                                <input class="form-control" name="tes" value="" type="text">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <span class="label label-warning">Klik Tombol Tempat Sampah Jika Tanpa Tes</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Pengumuman</label>
                        <div class="col-lg-3">
                            <div class='input-group input-append date datePicker'>
                                <input class="form-control" name="pengu" value="" data-validate="required" required="required" type="text">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Daftar Ulang</label>
                        <div class="col-lg-3">
                            <div class='input-group input-append date datePicker'>
                                <input class="form-control" name="dulang" value="" data-validate="required" required="required" type="text">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
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
                <center><input type="submit" class="btn btn-primary btn-lg" name="add" value="Selesai Buat Gelombang"></center>
            </div>
        </div>
    </div>
<?php echo $this->formHelper->formClose() ?>
