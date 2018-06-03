<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load("common/header"); ?>
</head>
<body style="">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-static-top" role="navigation" style="background-color: #FFF; border-color: #F8F8F8;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=<?php echo HOME; ?>>PPDB Online MAN2 Ponorogo</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['username']; ?> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li class="divider"></li>
                            <li><a href="<?php echo HOME."/logout" ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
                <?php $this->load($page); ?>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    <?php $this->load("common/footer"); ?>
</body>
</html>
