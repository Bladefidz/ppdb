<!DOCTYPE html>
<html lang="en">
<head>
    <title>403 error page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href=<?= SYS_ASSETS."css/bootstrap.min.css"; ?>>
    <link rel="stylesheet" media="screen" href=<?= SYS_ASSETS."css/bootstrap-theme.min.css"; ?>>

    <!-- Bootstrap Error Page -->
    <link rel="stylesheet" media="screen" href=<?= SYS_ASSETS."css/bootstrap-error-page.css"; ?>>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
       <script type="text/javascript" src="js/html5shiv.js"></script>
       <script type="text/javascript" src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- content -->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-lg-12">
                <div class="centering text-center error-container">
                    <div class="text-center">
                        <h2 class="without-margin"><span class="text-warning"><big>403</big></span></h2>
                        <h4 class="text-warning">Access denied</h4>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="navbar navbar-footer navbar-fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <footer role="contentinfo">
                        <p class="left">Simplex PHP Framework - 403 response</p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
