<?php
if ( !empty( $_GET["cart"] ) ) {
  switch( $_GET["cart"] ) {
    case "add":
      if ( !empty( $_POST["quantity"] ) ) {
        $product = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts LEFT JOIN hproducts ON hproducts.h_code = . hDBPREFIX ."posts.h_code WHERE . hDBPREFIX ."posts.h_code='" . $_GET["code"] . "'" );
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