<?php 
if ( !isset($_SESSION) ) { session_start(); } ?>
</main>

<a href="<?php _show_( _ROOT.'/purchase' ); ?>" class="addfab mdl-button mdl-button--fab mdl-button--colored"><i class="material-icons">shopping_cart</i></a>
<footer class="mdl-footer mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
	<div style="float:left;padding-left:20px;"><?php showOption( 'copyright' ); ?></div>
	<span style="float:right;padding-right:20px;"><a href="<?php showOption( 'attribution_link' ); ?>"><?php showOption( 'attribution' ); ?></a></span>
</footer>
</main>
</div>
<script src="<?php echo _SCRIPTS ?>d3.js"></script>
<script src="<?php echo _SCRIPTS ?>getmdl-select.min.js"></script>
<script src="<?php echo _SCRIPTS ?>material.js"></script>
<script src="<?php echo _SCRIPTS ?>materialize.js"></script>
<script src="<?php echo _SCRIPTS ?>nv.d3.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/employer-form/employer-form.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/line-chart/line-chart-nvd3.js"></script>
<script src="<?php echo _SCRIPTS ?>list.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/pie-chart/pie-chart-nvd3.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/table/table.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/todo/todo.js"></script>
</body>
</div>
</html>