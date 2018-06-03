<!-- Jquery -->
<script src="<?php echo ASSETS_DIR."/js/jquery.min.js" ?>" type="text/javascript"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/bootstrap.min.js" ?>"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/plugins/metisMenu/metisMenu.min.js" ?>"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/plugins/dataTables/jquery.dataTables.min.js" ?>"></script>
<script src="<?php echo ASSETS_DIR."/js/plugins/dataTables/dataTables.bootstrap.js" ?>"></script>
<script src="<?php echo ASSETS_DIR."/js/plugins/dataTables/dataTables.tableTools.js" ?>"></script>
<!-- Moment JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/plugins/moment/moment.min.js" ?>"></script>
<!-- Bootstrap Datepicker JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/plugins/bootstrap-datepicker/bootstrap-datetimepicker.min.js" ?>"></script>
<!-- CKeditor -->
<script src="<?php echo ASSETS_DIR."/js/plugins/ckeditor/ckeditor.js" ?>" type="text/javascript"></script>
<script src="<?php echo ASSETS_DIR."/js/plugins/ckeditor/edit.js" ?>" type="text/javascript"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/sidebar_menu.js" ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo ASSETS_DIR."/js/sb-admin-2.js" ?>"></script>
<!-- AJAX Engine -->
<script src="<?php echo ASSETS_DIR."/js/ajax.js" ?>"></script>
<!-- ppdb AJAX -->
<script src="<?php echo ASSETS_DIR."/js/ppdb.js" ?>" type="text/javascript"></script>
<!-- DataTable Scripts - Tables - Use for reference -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-pendaftaran').dataTable({
            responsive: true
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-seleksi').dataTable({
            responsive: true
        });
    });
</script>
<!-- js buatan orang -->
<script type="text/javascript">
    function konfirmasi(apa) {
        tanya = confirm('Anda yakin ingin  : \r\r --- '+ apa + ' --- \r\r?');
        if (tanya == true) return true;
        else return false;
    }

    function buka(file) {
        window.open(file);
    }
</script>
<!-- CKeditor -->
<script>
    initEdit();
</script>
