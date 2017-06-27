<?php 
if ( !isset($_SESSION) ) { session_start(); } ?>
</main>
<footer class="mdl-footer mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
	<div style="float:left;padding-left:20px;"><?php showOption( 'copyright' ); ?></div>
	<span style="float:right;padding-right:20px;"><a href="<?php showOption( 'attribution_link' ); ?>"><?php showOption( 'attribution' ); ?></a></span>
</footer><?php mysqli_close( $GLOBALS['conn'] ); ?>
</main>
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
</div>
</html>