<?php
if ( !empty( $_GET["cart"] ) ) {
  switch( $_GET["cart"] ) {
    case "add":
      if ( !empty( $_POST["quantity"] ) ) {
        $product = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts LEFT JOIN hproducts ON hproducts.id = ". _DBPREFIX ."posts.id WHERE ". _DBPREFIX ."posts.id='" . $_GET["code"] . "'" );
        if ( $product -> num_rows > 0) {
          while( $row = mysqli_fetch_assoc( $product) ) {
            $product_array[] = $row;
          }
        }
        $itemArray = array( $product_array[0]["id"]=>array('name'=>$product_array[0]["name"], 'code'=>$product_array[0]["id"], 'quantity'=>$_POST["quantity"], 'price'=>$product_array[0]["h_price"] ) );
        
        if ( !empty( $_SESSION["cart_item"] ) ) {
          if ( in_array( $product_array[0]["id"],array_keys( $_SESSION["cart_item"] )) ) {
            foreach( $_SESSION["cart_item"] as $k => $v) {
                if ( $product_array[0]["id"] == $k) {
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