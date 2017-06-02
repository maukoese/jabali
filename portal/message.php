<?php

include './header.php';

if (isset($_GET['create'])) {
	$hForm -> messageForm($_GET['create'], $_GET['code']);
}

if (isset($_GET['chat'])) {
	if ($_GET['chat'] == "list") {
		$hMessage -> getMessagesType('chat');
	} else {
		$hMessage -> getChatCode($_GET['chat']);

	}
}

if (isset($_GET['delete'])) {
	mysqli_query($GLOBALS['conn'], "DELETE FROM hmessages WHERE id=".$_GET['delete']."");
	header("location:javascript://history.go(-1)");
}

if (isset($_GET['edit']) && $_GET['view'] !=="") {
	$hMessage -> editMessageForm($_GET['view']);
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hMessage -> getMessagesType($_GET['type']);
		} else {
			$hMessage -> getMessages();
		}
	} else {
		$hMessage -> getMessageCode($_GET['view']);
	}

}

if (isset($_POST['create'])) {
	$hMessage -> createMessage();
}

?>
<a href="./message?create" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">message</i></a>
<?php
include './footer.php';
