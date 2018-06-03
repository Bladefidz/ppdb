<div class="row">
    <div class="col-lg-12">
        <div class="well well-sm">
            Pendaftaran Calon Peserta Didik Baru MAN 2 Ponorogo Gelombang <?php echo $gel ?> Tahun Ajaran <?php echo $thnAjar ?>
        </div>
    </div>
    <?php
    $attributes = array('class' => 'form-horizontal',
        'id' => 'form_daftar',
        'role' => 'form',
        'enctype' => 'multipart/form-data',
    );
    echo $this->formHelper->formOpen('', $attributes);
    ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Biodata Calon Peserta Didik
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">NISN</label>
                            <div class="col-lg-3">
                                <input class="form-control" value="<?php echo $nisn ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Lengkap</label>
                            <div class="col-lg-10">
                                <input class="form-control" value="<?php echo $nama ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Jenis Kelamin</label>
                            <div class="col-lg-10">
                                <div class="radio-inline">
                                    <label>
                                        <input name="jk" value="1" type="radio" required="required">Laki-Laki</input>
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input name="jk" value="2" type="radio" required="required">Perempuan</input>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tempat Lahir</label>
                            <div class="col-lg-2">
                                <input class="form-control" name="tmp_lahir" type="text" required="required">
                            </div>
                            <label class="col-lg-2 control-label">Tanggal Lahir</label>
                            <div class="col-lg-2">
                                <select class="form-control" name="tgl_lahir" required="required">
                                    <option value="">DD</option>
                                <?php for ($d = 1; $d <= 31; ++$d): ?>
                                    <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                                <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-control" name="bln_lahir" required="required">
                                    <option value="">MM</option>
                                <?php for ($m = 1; $m <= 12; ++$m): ?>
                                    <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
                                <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-control" name="thn_lahir" required="required">
                                    <option value="">YYYY</option>
                                <?php for ($y = date('Y'); $y >= 1990; --$y): ?>
                                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat Rumah</label>
                            <div class="col-lg-7">
                                <input class="form-control" name="alamat" required="required" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">RT</label>
                            <div class="col-lg-1">
                                <input class="form-control" name="rt" type="text" required="required">
                            </div>
                            <label class="col-lg-1 control-label">RW</label>
                            <div class="col-lg-1">
                                <input class="form-control" name="rw" type="text" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Provinsi</label>
                            <div class="col-lg-3">
                                <select class="form-control" id="prop" name="prop" required="required" onchange="ajaxkota(this.value)">
                                    <option value="">Pilih Provinsi</option>
                                <?php foreach ($wilayah as $wil): ?>
                                    <option value='<?php echo $wil['lokasi_propinsi'] ?>'><?php echo $wil['lokasi_nama'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kabupaten/Kota</label>
                            <div class="col-lg-3">
                                <select class="form-control" id="kota" name="kota" required="required" onchange="ajaxkec(this.value)">
                                    <option value="">Pilih Kota/Kab</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kecamatan</label>
                            <div class="col-lg-3">
                                <select class="form-control" id="kec" name="kec" required="required" onchange="ajaxkel(this.value)">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kelurahan/Desa</label>
                            <div class="col-lg-3">
                                <select class="form-control" id="kel" name="kel" required="required">
                                    <option value="">Pilih Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor Telepon</label>
                            <div class="col-lg-3">
                                <input class="form-control" name="no_telp" required="required" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nomor Handphone</label>
                            <div class="col-lg-3">
                                <input class="form-control" name="no_hp" required="required" type="text">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-lg-2 control-label">Foto</label>
                            <div class="col-lg-4">
                                <input class="input-file uniform_on" name="foto" type="file">
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Orang Tua
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Ayah</label>
                            <div class="col-lg-4">
                                <input class="form-control" name="nama_ay" required="required" type="text">
                            </div>
                            <label class="col-lg-2 control-label">Pekerjaan Ayah</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="pkj_ay" required="required">
                                <?php foreach ($pkjAy as $pa): ?>
                                    <option value='<?php echo $pa['id_pkj']; ?>'><?php echo $pa['pkj']; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Ibu</label>
                            <div class="col-lg-4">
                                <input class="form-control" name="nama_ib" required="required" type="text">
                            </div>
                            <label class="col-lg-2 control-label">Pekerjaan Ibu</label>
                            <div class="col-lg-3">
                                <select class="form-control" name="pkj_ib" required="required">
                                <?php foreach ($pkjIb as $pi): ?>
                                    <option value='<?php echo $pi['id_pkj'] ?>'><?php echo $pi['pkj'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sekolah Asal
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">MTs/SMP Asal</label>
                            <div class="col-lg-4">
                                <input class="form-control" value="<?php echo $skl ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                            <label class="col-lg-2 control-label">Kabupaten</label>
                            <div class="col-lg-4">
                                <input class="form-control" value="<?php echo $sklKab ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nilai SKHUN/SKHUN Sementara
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Bahasa Inggris</label>
                            <div class="col-lg-2">
                                <input class="form-control" value="<?php echo $nbing ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                            <label class="col-lg-2 control-label">Bahasa Indonesia</label>
                            <div class="col-lg-2">
                                <input class="form-control" value="<?php echo $nbi ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Matematika</label>
                            <div class="col-lg-2">
                                <input class="form-control" value="<?php echo $nmat ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                            <label class="col-lg-2 control-label">I P A</label>
                            <div class="col-lg-2">
                                <input class="form-control" value="<?php echo $nipa ?>" id="disabledInput" disabled="disabled" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Jenis Pilihan
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Jalur</label>
                            <div class="col-lg-10">
                            <?php foreach ($pilJalur as $pj): ?>
                                <div class="radio-inline">
                                    <label>
                                        <input name="jlr_pndftrn" value="<?php echo $pj['id_jalur']; ?>" type="radio" required="required"><?php echo $pj['nama_jalur']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Konfirmasi Data Pendaftar
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="data_ok">
                                    <label>Dengan menekan tombol "Cetak Bukti Pendaftaran", data yang telah anda isi tidak dapat diganggu gugat lagi. Jika anda belum yakin dengan data yang anda isikan, lebih baik cek kembali sampai anda benar-benar yakin.</label>
                                </label>
                            </div>
                        </div>
                        <center><input type="submit" class="btn btn-primary btn-lg" name="daftar" value="CETAK BUKTI PENDAFTARAN" id="tombol"></center>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $this->formHelper->formClose(); ?>
</div>
<script type="text/javascript">
var ajaxku;
var provTmp;
var kotaTmp;
var kecTmp;

function ajaxkota(id){
    ajaxku = buatajax();
    var url="<?php echo HOME.'/pendaftaran/input/kota/' ?>";
    url=url+id;
    url=url+"&sid="+Math.random();
    provTmp = id;
    ajaxku.onreadystatechange=stateChanged;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function ajaxkec(id){
    ajaxku = buatajax();
    var url="<?php echo HOME.'/pendaftaran/input/kecamatan/' ?>";
    url=url+provTmp+"/"+id;
    url=url+"&sid="+Math.random();
    kotaTmp = id;
    ajaxku.onreadystatechange=stateChangedKec;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function ajaxkel(id){
    ajaxku = buatajax();
    var url="<?php echo HOME.'/pendaftaran/input/kelurahan/' ?>";
    url=url+provTmp+"/"+kotaTmp+"/"+id;
    url=url+"&sid="+Math.random();
    kecTmp = id;
    ajaxku.onreadystatechange=stateChangedKel;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function buatajax(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}
function stateChanged(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>=0){
            document.getElementById("kota").innerHTML = data
        }else{
            document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
        }
    }
}

function stateChangedKec(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>=0){
            document.getElementById("kec").innerHTML = data
        }else{
            document.getElementById("kec").value = "<option selected>Pilih Kecamatan</option>";
        }
    }
}

function stateChangedKel(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>=0){
            document.getElementById("kel").innerHTML = data
        }else{
            document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
        }
    }
}
</script>
