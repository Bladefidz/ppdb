<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN PEDOMAN PPDB
        </h2>
        <p>
            Informasi Pedoman PPDB akan ditampilkan pada website PPDB
        </p>
    </div>
    <div class="col-lg-12">
        <div id="editor" contenteditable='true'>
            <?php echo $pedoman; ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4 col-lg-offset-8">
        <input type="submit" value="Simpan Perubahan Pedoman" class="btn btn-primary pull-right" onclick="simpanPedoman()"></input>
    </div>
</div>
