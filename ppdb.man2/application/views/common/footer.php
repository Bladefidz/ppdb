<!-- jQuery -->
<script src="<?php echo ASSETS_DIR."/js/jquery.js" ?>"></script>
<!-- JQuery.validate -->
<script src="<?php echo ASSETS_DIR."/js/jquery.validate.min.js" ?>" type="text/javascript"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/bootstrap.min.js" ?>"></script>
<!-- JS for uniform.default.css -->
<script src="<?php echo ASSETS_DIR."/js/jquery.uniform.min.js" ?>"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/plugins/dataTables/jquery.dataTables.js" ?>"></script>
<script src="<?php echo ASSETS_DIR."/js/plugins/dataTables/dataTables.bootstrap.js" ?>"></script>
<script src="<?php echo ASSETS_DIR."/js/plugins/dataTables/dataTables.bootstrap.js" ?>"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/plugins/metisMenu/metisMenu.min.js" ?>"></script>
<!-- Morris Charts JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/plugins/morris/raphael.min.js" ?>"></script>
<script src="<?php echo ASSETS_DIR."/js/plugins/morris/morris.min.js" ?>"></script>
<!-- My own JS function -->
<script scr="<?php echo ASSETS_DIR."/js/myjs.js" ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/sb-admin-2.js" ?>"></script>
<script src="<?php echo ASSETS_DIR."/js/ppdb.js" ?>"></script>
<!-- AJAX Engine -->
<script scr="<?php echo ASSETS_DIR."/js/ajax.js" ?>"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-siswa').dataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#dataTables-pendaftaran').dataTable();
    });
</script>
<script type="text/javascript">
    $('#close').click(function() {
        $('.alert_success').slideUp("fast");
        $('.alert_error').slideUp("fast");
    });
    generate_wysiwyg('halaman utama');
</script>
