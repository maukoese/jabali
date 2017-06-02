<?php 
include './header.php';
if(!empty($_GET["buy"])) {
	switch($_GET["buy"]) {
		case "add":
			if(!empty($_POST["quantity"])) {
				$product = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles LEFT JOIN hproducts ON hproducts.h_code = harticles.h_code WHERE harticles.h_code='" . $_GET["code"] . "'");
				if ($product -> num_rows > 0) {
					while($row = mysqli_fetch_assoc($product)) {
						$product_array[] = $row;
					}
				}
				$itemArray = array($product_array[0]["h_code"]=>array('name'=>$product_array[0]["h_alias"], 'code'=>$product_array[0]["h_code"], 'quantity'=>$_POST["quantity"], 'price'=>$product_array[0]["h_price"]));
				
				if(!empty($_SESSION["cart_item"])) {
					if(in_array($product_array[0]["h_code"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($product_array[0]["h_code"] == $k) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
		break;
		case "remove":
			if(!empty($_SESSION["cart_item"])) {
				foreach($_SESSION["cart_item"] as $k => $v) {
						if($_GET["code"] == $k)
							unset($_SESSION["cart_item"][$k]);				
						if(empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);
				}
			}
		break;
		case "empty":
			unset($_SESSION["cart_item"]);
		break;	
	}
}
?>
<title>Shop [ <?php getOption('name'); ?> ]</title>
  <div class="mdl-grid">
  	<?php
  	if ($_GET["order"]) {
		if(isset($_SESSION["cart_item"])){
		    $item_total = 0; ?>
		<div class="mdl-layout__content mdl-cell mdl-cell--8-col mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>">
			<div class="mdl-card__title">
		    <i class="material-icons">shopping_cart</i>
		      <span class="mdl-button">Order Details</span>
		        <div class="mdl-layout-spacer"></div>
		        <div class="mdl-card__subtitle-text mdl-button">
		        <a id="btnEmpty" href="./shop?view=list&buy=empty">
		            <i class="material-icons">remove_shopping_cart</i>
		            Cancel Order
		        </a>
		        </div>
		    </div>
			<table class="mdl-data-table mdl-js-data-table mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>">
			<tbody>
			<tr>
			<th class="mdl-data-table__cell--non-numeric">ITEM</th>
			<th class="mdl-data-table__cell--non-numeric">QTY</th>
			<th class="mdl-data-table__cell--non-numeric">PRICE</th>
			<th class="mdl-data-table__cell--non-numeric">ACTION</th>
			</tr>	
			<?php		
			    foreach ($_SESSION["cart_item"] as $item){
					?>
							<tr>
							<td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
							<td style="text-align:left;" ><?php echo $item["quantity"]; ?></td>
							<td style="text-align:left;" ><?php echo "KSh ".$item["price"]; ?></td>
							<td style="text-align:left;" ><a href="./shop?order=<?php echo $_GET["order"]; ?>&buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
							</tr>

							<?php
					        $item_total += ($item["price"]*$item["quantity"]);
							}
							?>
			<tr>
			<td colspan="5" align=left ><h5><b>TOTAL: </b> <?php echo "KSh ".$item_total; ?></h5></td>
			</tr>

			</tbody>

			</table>
		</div>
		<div class="mdl-layout__content mdl-cell mdl-cell--4-col mdl-card mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>">

			<div class="mdl-card__title">
		    <i class="material-icons">monetization_on</i>
		      <span class="mdl-button">Select Payment Method</span>
		        <div class="mdl-layout-spacer"></div>
		        <div class="mdl-card__subtitle-text mdl-button">
		            <i class="material-icons">person_pin_circle</i>
		            <?php show( $_SESSION['myLocation'] ); ?>
		        </div>
		    </div>

		    <form class="" name="payForm" method="GET" action="./pay"><br>

		    	<input type="hidden" name="order" value="<?php show( $_GET['order'] ); ?>">

				<?php if(!empty($_SESSION["cart_item"])) { ?>

		    	<div class="input-field inline">
		    		<i class="mdi mdi-cellphone prefix"></i>
		    		<input type="radio" id="mpesa" name="method" value="mpesa">
		    		<label for="mpesa">M-PESA</label>
		    	</div>

		    	<div class="input-field inline">
		    		<i class="fa fa-cc-visa prefix"></i>
		    		<input type="radio" id="visa" name="method" value="visa">
		    		<label for="visa">VISA</label>
		    	</div>

		    	<div class="input-field inline">
		    		<i class="fa fa-paypal prefix"></i>
		    		<input type="radio" id="paypal" name="method" value="paypal">
		    		<label for="paypal">Paypal</label>
		    	</div><br>

		    	<div class="input-field inline">
		    		<i class="mdi mdi-cash-multiple prefix"></i>
		    		<input type="radio" id="cod" name="method" value="cod">
		    		<label for="cod">Cash on Delivery</label>
		    	</div>			    	

		    	<div class="input-field inline">
		    		<i class="mdi mdi-bank prefix"></i>
		    		<input type="radio" id="stripe" name="method" value="bank">
		    		<label for="bank">Bank</label>
		    	</div>
			<br><br>

			<center>
			<button class="mdl-button mdl-js-button mdl-button--colored mdl-js-ripple-effect" type="submit" name="pay" value="now">pay now <i class="material-icons">monetization_on</i></button><br>	
			</center>
			</form>
		</div><?php 
			}
		}
  	} else {

		if (isset($_GET['view'])) { 
			if ($_GET['view'] == "list") {
				$products = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles LEFT JOIN hproducts ON hproducts.h_code = harticles.h_code WHERE h_type = 'product'");
				if ($products -> num_rows > 0) {
					while($row = mysqli_fetch_assoc($products)) {
						$products_array[] = $row;
					}
				}

				if (!empty($products_array)) { 
					foreach($products_array as $key=>$value){ ?>
					<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>">
						<div class="mdl-card-media">
							<img src="<?php echo $products_array[$key]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
						</div>
						<form method="post" action="./shop?view=list&buy=add&code=<?php echo $products_array[$key]["h_code"]; ?>">
							<div class="mdl-card__title mdl-card--expand">
							    <div class="mdl-card__title-text">
							    	<?php echo $products_array[$key]["h_alias"]; ?>
							    </div>
							    <div class="mdl-layout-spacer"></div>
		        				<div class="mdl-card__subtitle-text">
								<?php echo "KSh ".$products_array[$key]["h_price"]; ?>
									
								</div>
						  	</div>
							<div class="mdl-card__supporting-text">
								<div class="input-field inline">
									<input type="number" name="quantity" value="1" size="2" />
								</div>
								<div class="input-field inline" style="padding-left: 10px;">
									<button type="submit" class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright">
									<i class="material-icons">add_shopping_cart</i></button>
								</div>
							</div>
							<span style="padding: 20px;">
							<a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">thumb_up</i></a>

							<a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">comment</i></a>

							<a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">image</i></a>

							<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon alignright" id="prbtn">
					            <i class="material-icons">more_vert</i>
					          </button>
					          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="prtbtn">
						          <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
						          <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
						          <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
					          </ul>
					        </span>
					        
							<div class="mdl-card__menu">
							<a href="?fav=<?php echo $products_array[$key]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
							</div>
						</form>
					</div><?php
					}
				}

			} else {
			 	$product = mysqli_query($GLOBALS['conn'], "SELECT * FROM harticles LEFT JOIN hproducts ON hproducts.h_code = harticles.h_code WHERE harticles.h_code='". $_GET["view"] ."'");
				if ($product -> num_rows > 0) { 
					while($product_array = mysqli_fetch_assoc($product)) {
					}
				} 
		 	}
	 	} ?>



  <span class="cartfab mdl-button mdl-button--fab notification mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>" id="cartbtn" >
    <i class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo count($_SESSION["cart_item"]); ?>">shopping_cart</i>
  </span><div class="mdl-tooltip" for="cartbtn">My Cart</div>

	<div class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right option-drop mdl-card mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" for="cartbtn" style="width: 250px">
	  <div class="mdl-card__title"><?php 
	  if (!empty($_SESSION["cart_item"])) { ?>
	    <a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="./shop?order=<?php echo substr(md5($_SESSION['myEmail'].date(Ymd)), 0, 12); ?>">checkout now<i class="material-icons">forward</i></a>
	        <div class="mdl-layout-spacer"></div>
	        <div class="mdl-card__subtitle-text">
	            
	        <a class="mdl-badge mdl-badge--overlap notification" id="btnEmpty" href="./shop?view=list&buy=empty">
	            <i class="material-icons">remove_shopping_cart</i>
	        </a>
	        </div><?php
	  	} else { echo "MY CART";} ?>
	    </div>

	    <div class="mdl-card__supporting-text">
	          	<?php
		if(isset($_SESSION["cart_item"])){
		    $item_total = 0; ?>
		<table class="mdl-data-table mdl-js-data-table">
		<tbody>	
		<?php		
		    foreach ($_SESSION["cart_item"] as $item){
				?>
						<tr><td style="text-align:left;" ><a href="./shop?view=list&buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
						<td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
						</tr>

						<?php
		        $item_total += ($item["price"]*$item["quantity"]);
				}
				?>
		</tbody>
		</table><?php
		} else { echo "<center><br>Your Cart Is Empty</center>";}
		?>
		<?php if(!empty($_SESSION["cart_item"])) { ?>
		<center>
			<h5><b>TOTAL: </b> <?php echo "KSh ".$item_total; ?></h5>
		</center>
		<?php } ?>  
		</div>
	</div>

</div><?php 
	}
include './footer.php';
?>