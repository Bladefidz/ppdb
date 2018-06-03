<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load("common/header"); ?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href=<?php echo HOME; ?>>PPDB SIMAN2 Ponorogo</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <?php
                $this->set("title", $title);
                $this->load($menu);
                ?>
            </div>
        </nav>
        <div class="container">
            <?php $this->load($page); ?>
        </div>
    </div>
    <!-- /#wrapper -->
    <?php $this->load("common/footer"); ?>
</body>
</html>
