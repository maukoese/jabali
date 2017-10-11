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
<?php
 if ( hasPosts() ) {
 	while ( hasPosts() ) {
 		thePost();

 		theTitle();
 	}
 } ?>

<!-- <div class="search input-field">
	<input type="text" name="searchterm" autocomplete="off" placeholder="Search">
	<div class="result"></div>
</div> -->

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