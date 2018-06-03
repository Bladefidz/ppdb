/*
	JavaScript for backend programmer.
	Several Function Supported by AJAX.
	Created on 14-Dec-2014 10:46 PM.
	Updated on --.
	Creatde by Hafidz Jazuli Luthfi.
*/

// Konfirmasi
window.onload=function() {
	document.forms["form_daftar"].elements["tombol"].disabled=true;

	var checkboxs = document.forms["form_daftar"].elements["data_ok"];
	for (var i = 0; i < checkboxs.length; i++)
		checkboxs[i].onclick=checkboxChecked;
}
function checkboxChecked() {
	if (this.value == "woke") {
		document.forms["form_daftar"].elements["tombol"].disabled=false;
	}
}


// Menampilkan database sesuai kriteria yang dipilh
var myAjax;

function getData(by) {
	myAjax	= createAjax();
	var url	= "pilih_statistik.php";
	url		= url+"&kriteria="+by;
	url		= url+"$sid="+Math.random();
	myAjax.onreadystatechange = stateChanged;
	myAjax.open("GET",url,true);
	myAjax.send(null);
}

function createAjax() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}

function stateChanged() {
	var data;
	if (myAjax,readyState==4) {
		data = myAjax.responseText;
		if(data.lenght > 0) {
			document.getElementById("kriteria").value = data;
		} else {
			document.getElementById("kriteria").value = "";
		}
	}
}