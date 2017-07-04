<?php 
include './header.php';
if ( $_GET["order"] ) {
		if ( isset( $_SESSION["cart_item"] )){
		    $item_total = 0; ?>
		<div class="mdl-layout__content mdl-cell mdl-cell--8-col mdl-card mdl-color--<?php primaryColor(); ?>">
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
			<table class="mdl-data-table mdl-js-data-table mdl-color--<?php primaryColor(); ?>">
			<tbody>
			<tr>
			<th class="mdl-data-table__cell--non-numeric">ITEM</th>
			<th class="mdl-data-table__cell--non-numeric">QTY</th>
			<th class="mdl-data-table__cell--non-numeric">PRICE</th>
			<th class="mdl-data-table__cell--non-numeric">ACTION</th>
			</tr>	
			<?php 		
			    foreach ( $_SESSION["cart_item"] as $item){
					?>
							<tr>
							<td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
							<td style="text-align:left;" ><?php echo $item["quantity"]; ?></td>
							<td style="text-align:left;" ><?php echo "KSh ".$item["price"]; ?></td>
							<td style="text-align:left;" ><a href="./shop?order=<?php echo $_GET["order"]; ?>&buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
							</tr>

							<?php 
					        $item_total += ( $item["price"]*$item["quantity"] );
							}
							?>
			<tr>
			<td colspan="5" align=left ><h5><b>TOTAL: </b> <?php echo "KSh ".$item_total; ?></h5></td>
			</tr>

			</tbody>

			</table>
		</div>
		<div class="mdl-layout__content mdl-cell mdl-cell--4-col mdl-card mdl-color--<?php primaryColor(); ?>">

			<div class="mdl-card__title">
		    <i class="material-icons">monetization_on</i>
		      <span class="mdl-button">Select Payment Method</span>
		        <div class="mdl-layout-spacer"></div>
		        <div class="mdl-card__subtitle-text mdl-button">
		            <i class="material-icons">person_pin_circle</i>
		            <?php _show_( $_SESSION['myLocation'] ); ?>
		        </div>
		    </div>

		    <form enctype="multipart/form-data" class="" name="payForm" method="GET" action="./pay"><br>

		    	<input type="hidden" name="order" value="<?php _show_( $_GET['order'] ); ?>">

				<?php if ( !empty( $_SESSION["cart_item"] ) ) { ?>

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
  	} 
include './footer.php';
?>