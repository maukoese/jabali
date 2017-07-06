<?php 
/*
*For Carrying out test SQLs
* TO-Do: Remove in dist
*/ 
include '../inc/config.php';
include '../inc/jabali.php';
include './header.php';
$hMenu = new _hMenus();
$hMenu -> create ( 'Comments', 'jabali', 'comment', 'comments', '', '#', 'drawer', 'visible', 'drop' );
		//Messages SubMenus
		$hMenu -> create ( 'All Comments', 'jabali', 'comment', 'allcomments', 'comments', './comments?view=list&key=all comments', 'drawer', 'visible', 'null' );
		$hMenu -> create ( 'Pending Comments', 'jabali', 'comment', 'pendingcomments', 'comments', './comments?view=pending&key=pending comments', 'drawer', 'visible', 'null' );

include './footer.php'; ?>
<?php ?>