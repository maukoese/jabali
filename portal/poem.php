<?php include './header.php';
include '../extensions/zahra/class.poems.php';
$hPoem = new _hPoems();
$hPoem -> getPoems();
include './footer.php'; ?>