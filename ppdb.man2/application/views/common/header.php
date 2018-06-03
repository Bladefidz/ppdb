<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Sistem Informasi Sekolah Untuk MAN 2 Ponorogo">
<meta name="author" content="Hafidz dkk">

<title>PPDB - SIMAN2 Ponorogo</title>

<!-- Bootstrap Core CSS -->
<link href="<?php echo ASSETS_DIR."/css/bootstrap.min.css" ?>" rel="stylesheet">
<!-- Bootstrap Error Page -->
<link href="<?php echo ASSETS_DIR."/css/bootstrap-error-page.css" ?>" rel="stylesheet" media="screen" >
<!-- Custom Fonts -->
<link href="<?php echo ASSETS_DIR."/font-awesome-4.3.0/css/font-awesome.min.css" ?>" rel="stylesheet" type="text/css">
<!-- MetisMenu CSS -->
<link href="<?php echo ASSETS_DIR."/css/plugins/metisMenu/metisMenu.min.css" ?>" rel="stylesheet">
<!-- DataTables CSS -->
<link href="<?php echo ASSETS_DIR."/css/plugins/dataTables.bootstrap.css" ?>" rel="stylesheet">
<!-- Timeline CSS -->
<link href="<?php echo ASSETS_DIR."/css/plugins/timeline.css" ?>" rel="stylesheet">
<!-- Morris Charts CSS -->
<link href="<?php echo ASSETS_DIR."/css/plugins/morris.css" ?>" rel="stylesheet">
<!--/.fluid-container-->
<link href="<?php echo ASSETS_DIR."/css/uniform.default.css" ?>" rel="stylesheet" media="screen">
<!-- Custom CSS -->
<link href="<?php echo ASSETS_DIR."/css/sb-admin-2.css" ?>" rel="stylesheet">
<!-- Modification CSS -->
<link href="<?php echo ASSETS_DIR."/css/modif.css" ?>" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script type="text/javascript">
    function konfirmasi(apa) {
        tanya = confirm('Anda yakin ingin  : \r\r --- '+ apa + ' --- \r\r?');
        if (tanya == true) return true;
        else return false;
    }

    function buka(file) {
        window.open(file);
    }

    $(document).ready(function() {
        $(".tablesorter").tablesorter();
     });

    $(document).ready(function() {
        //When page loads...
        $(".tab_content").hide(); //Hide all content
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $(".tab_content:first").show(); //Show first tab content

        //On Click Event
        $("ul.tabs li").click(function() {
            $("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content
            var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active ID content
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
