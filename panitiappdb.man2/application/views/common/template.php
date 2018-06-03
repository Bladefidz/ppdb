<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load("common/header"); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default no-margin" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse" id="menu-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=<?php echo HOME; ?>>PPDB MAN 2 Ponorogo</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active" >
                    <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2" style="padding: 5px">
                        <span class="fa fa-toggle-left fa-fw" aria-hidden="true"></span>
                    </button>
                </li>
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['username']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo HOME."/logout" ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="wrapper">
    <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?php
            $this->load($menu);
            ?>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <?php $this->load($page); ?>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    <?php $this->load("common/footer"); ?>
</body>
</html>
