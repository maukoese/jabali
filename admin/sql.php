<?php 
/*
*For Carrying out test SQLs
* TO-Do: Remove in dist
*/
session_start();
require_once( '../init.php' );
require_once( 'header.php' );
?>
<title>Jabali SQL Sandbox</title>
<div class="mdl-grid">
<div class="mdl-cell mdl-cell--12-col mdl-color--blue"><?php
 if ( hasPosts() ) {
  while ( hasPosts() ) {
    thePost();

    theTitle();
    echo( '<br>');
    theContent();
    echo( '<br>');
    echo( '<br>');
  }
 } ?>
   
 </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.search input[type="text"]').on("keyup input", function(){
			var inputVal = $(this).val();
			var resultDrop = $(this).siblings(".result");

			if (inputVal.length) {
				$.get("search.php", {term: inputVal}).done(function(data){
					resultDrop.html(data);
				});
			} else {
				resultDrop.empty();
			}
		});

		$(document).on("click", "result", function(){
			$(this).parents(".search").find('input[type="text"]').val($(this).text());
			$(this).parents(".result").empty();
		});
	});
</script>

<?php
require_once( 'footer.php' );