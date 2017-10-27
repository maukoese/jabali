<?php

include _ABSX_.'wapi/class.events.php';
$hEvent = new _hEvents();

if ( isset( $_GET['event'] ) ) { 
  if ( $_GET['event'] == "list" ) {
    $hEvent -> getEvents();
  } elseif ( $_GET['event'] == "drafts" ) {
    $hPoem -> getDrafts();
  } else {
    $hPoem -> getEvent( $_GET['event'] );
  }
}

if ( isset( $_GET['page_id'] ) ) { 
  if ( $_GET['page'] == "drafts" ) {
    $hPoem -> getDrafts();
  } else {
    $hPoem -> getPage( $_GET['page_id'] );
  }
}
if ( isset( $_GET['create'] ) ) { 
  $hForm -> postForm();
  $hEvent -> eventFields();
}
?>