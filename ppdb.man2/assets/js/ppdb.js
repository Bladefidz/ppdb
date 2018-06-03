var ajaxku;
var ajaxPres;
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

function ajaxkota(id) {
    ajaxku = buatajax();
    var url="/ppdb.man2/ppdbonline/kota/";
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
    var url="/ppdb.man2/ppdbonline/kecamatan/";
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
    var url="/ppdb.man2/ppdbonline/kelurahan/";
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
