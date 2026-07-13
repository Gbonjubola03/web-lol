<!-- =========================
    	AJAX CALLS
    ============================== -->
    <?php require_once ('ajax.js.php'); ?>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo do_config(14); ?>assets/inc/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo do_config(14); ?>assets/inc/js/popper.min.js"></script>
    <script src="<?php echo do_config(14); ?>assets/inc/js/bootstrap.min.js"></script>
    <script src="<?php echo do_config(14); ?>assets/inc/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo do_config(14); ?>assets/inc/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo do_config(14); ?>assets/inc/js/plugins/chart.js"></script>
    <!-- Page specific javascripts-->
     <script>
      $('.bs-component [data-toggle="popover"]').popover();
      $('.bs-component [data-toggle="tooltip"]').tooltip();
    </script>
  </body>
</html>