<?php 
if ( !isset($_SESSION) ) { session_start(); } ?>
</main>
<footer class="mdl-footer mdl-color--<?php primaryColor(); ?>">
	<div style="float:left;padding-left:20px;"><?php showOption( 'adfooter' ); ?></div>
	<span style="float:right;padding-right:20px;"><a href="<?php showOption( 'attribution_link' ); ?>"><?php showOption( 'attribution' ); ?></a></span>
</footer>
<?php mysqli_close( $GLOBALS['conn'] ); ?>
    <script type="text/javascript">
      $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
    </script>
<script src="<?php echo hSCRIPTS ?>d3.js"></script>
<script src="<?php echo hSCRIPTS ?>getmdl-select.min.js"></script>
<script src="<?php echo hSCRIPTS ?>material.js"></script>
<script src="<?php echo hSCRIPTS ?>materialize.min.js"></script>
<script src="<?php echo hSCRIPTS ?>nv.d3.js"></script>
<script src="<?php echo hSCRIPTS ?>widgets/employer-form/employer-form.js"></script>
<script src="<?php echo hSCRIPTS ?>widgets/line-chart/line-chart-nvd3.js"></script>
<script src="<?php echo hSCRIPTS ?>list.js"></script>
<script src="<?php echo hSCRIPTS ?>widgets/pie-chart/pie-chart-nvd3.js"></script>
<script src="<?php echo hSCRIPTS ?>widgets/table/table.js"></script>
<script src="<?php echo hSCRIPTS ?>widgets/todo/todo.js"></script>
</div>
</body>
</html>