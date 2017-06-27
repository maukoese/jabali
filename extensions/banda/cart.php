<?php
if ( isset( $_POST['pay'] ) && $_POST['amount'] !== "" && $_POST['h_phone'] !== "" ) {
    $AMOUNT = $_POST['amount'];
    $NUMBER = $_POST['h_phone']; //format 254700000000
    $PRODUCT_ID = $_GET['order'];
    //init MPESA class
    $mpesa = new MPESA(ENDPOINT, CALLBACK_URL, CALL_BACK_METHOD, PAYBILL_NO, TIMESTAMP, PASSWORD, $GLOBALS['conn'] );
    $mpesa->setProductID( $PRODUCT_ID );
    $mpesa->setAmount( $AMOUNT );
    $mpesa->setNumber( $NUMBER ); // replaces 0 with 254
    $mpesa->init();
}

if ( !empty( $_GET["cart"] ) ) {
  switch( $_GET["cart"] ) {
    case "add":
      if ( !empty( $_POST["quantity"] ) ) {
        $product = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hproducts ON hproducts.h_code = hposts.h_code WHERE hposts.h_code='" . $_GET["code"] . "'" );
        if ( $product -> num_rows > 0) {
          while( $row = mysqli_fetch_assoc( $product) ) {
            $product_array[] = $row;
          }
        }
        $itemArray = array( $product_array[0]["h_code"]=>array('name'=>$product_array[0]["h_alias"], 'code'=>$product_array[0]["h_code"], 'quantity'=>$_POST["quantity"], 'price'=>$product_array[0]["h_price"] ) );
        
        if ( !empty( $_SESSION["cart_item"] ) ) {
          if ( in_array( $product_array[0]["h_code"],array_keys( $_SESSION["cart_item"] )) ) {
            foreach( $_SESSION["cart_item"] as $k => $v) {
                if ( $product_array[0]["h_code"] == $k) {
                  if ( empty( $_SESSION["cart_item"][$k]["quantity"] ) ) {
                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                  }
                  $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                }
            }
          } else {
            $_SESSION["cart_item"] = array_merge( $_SESSION["cart_item"],$itemArray );
          }
        } else {
          $_SESSION["cart_item"] = $itemArray;
        }
      }
    break;
    case "remove":
      if ( !empty( $_SESSION["cart_item"] ) ) {
        foreach( $_SESSION["cart_item"] as $k => $v) {
            if ( $_GET["code"] == $k)
              unset( $_SESSION["cart_item"][$k] );        
            if ( empty( $_SESSION["cart_item"] ))
              unset( $_SESSION["cart_item"] );
        }
      }
    break;
    case "empty":
      unset( $_SESSION["cart_item"] );
    break;  
  }
} ?>