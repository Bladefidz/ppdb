var ajaxku;
var ajaxPres;
var pres_countTmp = 1;
var thnTmp;
var provTmp;
var kotaTmp;
var kecTmp;

function buatajax() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}

function tambahPrestasi(pres_countTmp) {
    ajaxPres = buatajax();
    ajaxPres.onreadystatechange = function() {
        if (ajaxPres.readyState == 4 && ajaxPres.status == 200) {
            document.getElementById("prestasi"+(pres_countTmp-1)).innerHTML = ajaxPres.responseText;
            document.getElementById("count").value = pres_countTmp;
        }
    }
    ajaxPres.open("GET", "/panitiappdb.man2/pendaftaran/prestasi/"+pres_countTmp, true);
    ajaxPres.send();
}

$(document).ready(function() {
    $('#tmbPres').click(function() {
        tambahPrestasi(pres_countTmp);
        pres_countTmp = pres_countTmp + 1;
    });
});

$(document).ready(function(){
    $("#hpsPres").click(function(){
        if (pres_countTmp > 1) {
            pres_countTmp = pres_countTmp - 1;
            $("#pres"+(pres_countTmp)).remove();
            $("#prestasi"+(pres_countTmp)).remove();
            $("#count").val(pres_countTmp - 1);
        }
    });
});

function ajaxgel(id) {
    ajaxku = buatajax();
    var url="gelombang/";
    url=url+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChangedGel;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function stateChangedGel(){
    var data;
    if (ajaxku.readyState==4){
        data=ajaxku.responseText;
        if(data.length>0){
            document.getElementById("gel").innerHTML = data
        }else{
            document.getElementById("gel").value = "<option selected>pilih tahun dulu</option>";
        }
    }
}

function ajaxkota(id) {
    ajaxku = buatajax();
    var url="/panitiappdb.man2/pendaftaran/kota/";
    url=url+id;
    url=url+"&sid="+Math.random();
    provTmp = id;
    ajaxku.onreadystatechange=stateChangedKota;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function stateChangedKota() {
    var data;
    if (ajaxku.readyState==4) {
        data=ajaxku.responseText;
        if(data.length>=0) {
            document.getElementById("kota").innerHTML = data
        }else {
            document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
        }
    }
}

function ajaxkec(id) {
    ajaxku = buatajax();
    var url="/panitiappdb.man2/pendaftaran/kecamatan/";
    url=url+provTmp+"/"+id;
    url=url+"&sid="+Math.random();
    kotaTmp = id;
    ajaxku.onreadystatechange=stateChangedKec;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
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

function ajaxkel(id) {
    ajaxku = buatajax();
    var url="/panitiappdb.man2/pendaftaran/kelurahan/";
    url=url+provTmp+"/"+kotaTmp+"/"+id;
    url=url+"&sid="+Math.random();
    kecTmp = id;
    ajaxku.onreadystatechange=stateChangedKel;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
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

function simpanPedoman() {
    var data = CKEDITOR.instances.editor.getData();
    $.post('pedoman', {
        content : data
    })
    alert("Pedoman PPDB telah diperbarui");
}

function simpanAlur() {
    var data = CKEDITOR.instances.editor.getData();
    $.post('alur', {
        content : data
    })
    alert("Alur PPDB telah diperbarui");
}

$(document).ready(function() {
    $('.datePicker') .datetimepicker({
        format: 'DD-MM-YYYY',
        showClear: true
    });
});

// $(document).ready(function() {
//     $('#testDate').datetimepicker({
//         format: 'DD-MM-YYYY',
//         showClear: true
//     });
// });

// $("#clearTestDate").click(function(){
//     $('#testDate').datetimepicker()
//         .on(clearDate, function(e){

//         });
// })
