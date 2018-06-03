<div class="row">
    <div class="panel-heading">
        <h2>
            Update Gelombang <?php echo $gel ?> Pada Tahun Aktif PPDB <?php echo $thn ?>
        </h2>
    </div>
<?php
    $attributes = array(
        'class' => "form-horizontal",
        'id' => 'form_verifikasi',
        'role' => "form",
        'enctype' => "multipart/form-data"
    );
    echo $this->formHelper->formOpen('setting/gelombang/update/'.$id, $attributes);
?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gelombang</label>
                        <div class="col-lg-10">
                            <input class="form-control" name="gel" value="<?php echo $gelData[0]['gelombang'] ?>" required="required" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Pendaftaran Dibuka</label>
                        <div class="col-lg-3">
                            <div class='input-group date datePicker'>
                                <input class="form-control datePicker" name="pbuka" value="<?php echo date('d-m-Y', strtotime($gelData[0]['open_date'])) ?>" data-validate="required" required="required" type="text">
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
                                <input class="form-control" name="ptutup" value="<?php echo date('d-m-Y', strtotime($gelData[0]['close_date'])) ?>" data-validate="required" required="required" type="text">
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
                                <input class="form-control" name="tes" value="<?php echo date('d-m-Y', strtotime($gelData[0]['test_date'])) ?>" type="text">
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
                                <input class="form-control" name="pengu" value="<?php echo date('d-m-Y', strtotime($gelData[0]['announcement_date'])) ?>" data-validate="required" required="required" type="text">
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
                                <input class="form-control" name="dulang" value="<?php echo date('d-m-Y', strtotime($gelData[0]['recieve_date'])) ?>" data-validate="required" required="required" type="text">
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
                <center><input type="submit" class="btn btn-primary btn-lg" name="edit" value="Selesai Edit Gelombang"></center>
            </div>
        </div>
    </div>
<?php echo $this->formHelper->formClose() ?>
