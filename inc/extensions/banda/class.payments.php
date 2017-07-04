<?php 
/**
* 
*/
class _hPayments
{
	function transactPay()
	{  ?><div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor(); ?>">

	<div class="mdl-card__title">
    <i class="material-icons">print</i>
      <span class="mdl-button">Order <?php _show_( $_GET['order'] ); ?></span>
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
						<td style="text-align:left;" ><a href="./shop?order=<?php _show_( $_GET['order'] ); ?>&method=<?php _show_( $_GET['method'] ); ?>&pay=now&buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
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
		<div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor(); ?>">

			<div class="mdl-card__title">
		    <i class="material-icons">perm_identity</i>
		      <span class="mdl-button">Your Details</span>
		        <div class="mdl-layout-spacer"></div>
		        <div class="mdl-card__subtitle-text mdl-button">
		            <i class="mdi mdi-truck-delivery mdi-24px"></i>
		            <?php _show_( $_SESSION['myLocation'] ); ?>
		        </div>
		    </div>

			    <form enctype="multipart/form-data" class="" name="payForm" method="POST" action=""><br>
			    	<div class="input-field inline">
			    		<i class="material-icons prefix">label</i>
			    		<input type="text" name="h_by" value="<?php _show_( $_SESSION['myAlias'] ); ?>">
			    		<label>Full Names</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">mail</i>
			    		<input type="text" name="h_email" value="<?php _show_( $_SESSION['myEmail'] ); ?>">
			    		<label>Email</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">phone</i>
			    		<input type="text" name="h_phone" value="<?php _show_( $_SESSION['myPhone'] ); ?>">
			    		<label>Phone</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">room</i>
			    		<input type="text" name="h_location" value="<?php _show_( ucwords( $_SESSION['myLocation'] ) ); ?>">
			    		<label>Location</label>
			    	</div>

			    	<div class="input-field inline">
			    		<i class="material-icons prefix">monetization_on</i>
			    		<input type="text" name="h_location" value="<?php _show_( strtoupper( $_GET['method'] ) ); ?>">
			    		<label>Pay Via</label>
			    	</div>
			    	<input type="hidden" name="amount" value="<?php echo $item_total; ?>">

			    	<div class="input-field inline">
					<button class="mdl-button mdl-js-button mdl-button--colored mdl-js-ripple-effect" type="submit" name="pay">pay now <i class="material-icons">send</i></button>
					</div>
			</form>

		</div><?php
	}
}