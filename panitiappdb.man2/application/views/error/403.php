<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(__DIR__ . '/../header.php'); ?>
</head>
<body>
<!-- small navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left bootstrap-admin-theme-change-size">
                        <li class="text">Change size:</li>
                        <li><a class="size-changer small">Small</a></li>
                        <li><a class="size-changer large active">Large</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- content -->
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-lg-12">
            <div class="centering text-center error-container">
                <div class="text-center">
                    <h2 class="without-margin">Don't worry. It's <span class="text-warning"><big>403</big></span> error only.</h2>
                    <h4 class="text-warning">Access denied</h4>
                </div>
                <div class="text-center">
                    <h3><small>Choose an option below</small></h3>
                </div>
                <hr>
                <ul class="pager">
                    <li><a href="about.html">&larr; About</a></li>
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li><a href="ui-and-interface.html">UI & Interface</a></li>
                    <li><a href="error-pages.html">Other error pages &rarr;</a></li>
                </ul>
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
                    <p class="left">Bootstrap 3.x Admin Theme</p>
                    <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>
<?php require_once "/../footer.php"; ?>
</body>
</html>
