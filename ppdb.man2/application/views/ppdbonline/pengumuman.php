<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h2 id="forms">Pengumuman Hasil Seleksi PPDB MAN 2 Ponorogo</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="well bs-component">
            <?php
                $attributes = array(
                    'class' => "form-horizontal",
                    'role' => "form",
                    'enctype' => "multipart/form-data"
                );
                echo $this->formHelper->formOpen('pengumuman', $attributes);
            ?>
                <fieldset>
                    <legend>Pencarian Berdasarkan Nomor Pendaftaran</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Nomor Pendaftaran</label>
                        <div class="col-lg-4">
                            <input class="form-control" name="nopend" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">NISN</label>
                        <div class="col-lg-4">
                            <input class="form-control" name="nisn" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </fieldset>
            <?php echo $this->formHelper->formClose(); ?>
        </div>
    </div>
</div>
