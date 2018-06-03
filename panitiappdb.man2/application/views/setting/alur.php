<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN ALUR PPDB
        </h2>
        <p>
            Informasi Alur PPDB akan ditampilkan pada website PPDB
        </p>
    </div>
    <div class="col-lg-12">
        <div id="editor" contenteditable='true'>
            <?php echo $alur; ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-lg-offset-8">
        <input type="submit" value="Simpan Perubahan Alur" class="btn btn-primary pull-right" onclick="simpanAlur()"></input>
    </div>
</div>
