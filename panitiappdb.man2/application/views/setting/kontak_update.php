<div class="row">
    <div class="panel-heading">
        <h2>
            Update Kontak PPDB
        </h2>
    </div>
<?php if(!empty($notif)): ?>
    <div class="col-lg-12">
        <div class="alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo $notif ?></strong>.
            <a class='btn btn-default btn-xs' href="<?php echo HOME.'/pendaftaran/data/terverifikasi/'.$year.'/1' ?>" >Lihat Data Verifikasi</a>
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
    echo $this->formHelper->formOpen('setting/kontak/update/'.$id, $attributes);
?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Kontak</label>
                        <div class="col-lg-10">
                            <input class="form-control" name="nama" value="<?php echo $kontak[0]['nama_kontak'] ?>" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Alamat</label>
                        <div class="col-lg-10">
                            <input class="form-control" name="alamat" value="<?php echo $kontak[0]['alamat'] ?>" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Telepon</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="tlp" value="<?php echo $kontak[0]['telepon'] ?>" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">HP</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="hp" value="<?php echo $kontak[0]['hp'] ?>" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-3">
                            <input class="form-control" name="email" value="<?php echo $kontak[0]['email'] ?>" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: #FFF">
                <center><input type="submit" class="btn btn-primary btn-lg" name="edit" value="Selesai Edit Kontak"></center>
            </div>
        </div>
    </div>
<?php echo $this->formHelper->formClose() ?>
