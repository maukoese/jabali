<?php 
if ( $_GET['settings'] ) { ?>
  <title>Shop Options [ <?php showOption( 'name' ); ?> ]</title>
  <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-color--<?php primaryColor(); ?>">
  <div class=" mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone ">
  <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
  <div class="mdl-card__title">
  <i class="mdi mdi-cellphone"></i>
    <span class="mdl-button">M-PESA Settings</span>
  </div>
  <div class="mdl-card__supporting-text mdl-card--expand">
          <span><b>Required Fields Are Marked <span style="color:red;">*</span></b></span><br>

          <div class="input-field">
                  <i class="material-icons prefix">label</i>
              <input id="merchant" type="text" name="merchant" value="<?php showOption( 'merchant' ); ?>">
              <label for="merchant" data-error="wrong" data-success="right" class="center-align">Merchant Name <b style="color:red;">*</b></label>
          </div>

          <div class="input-field">
                  <i class="material-icons prefix">public</i>
              <input id="callback" type="text" name="callback" value="<?php showOption( 'callback' ); ?>">
              <label for="callback" data-error="wrong" data-success="right" class="center-align">Callback URL <b style="color:red;">*</b></label>
          </div>

          <div class="input-field">
                  <i class="material-icons prefix">payment</i>
              <input id="paybill" type="text" name="paybill" value="<?php showOption( 'paybill' ); ?>">
              <label for="paybill" data-error="wrong" data-success="right" class="center-align">Paybill Number <b style="color:red;">*</b></label>
          </div>

          <div class="input-field">
                  <i class="material-icons prefix">query_builder</i>
              <input id="timestamp" type="text" name="timestamp" value="<?php showOption( 'timestamp' ); ?>">
              <label for="timestamp" data-error="wrong" data-success="right" class="center-align">Timestamp <b style="color:red;">*</b></label>
          </div>

          <div class="input-field">
                  <i class="material-icons prefix">lock</i>
              <textarea id="sag" name="sag" class="materialize-textarea col s12" ><?php showOption( 'sag' ); ?></textarea>
              <label for="sag" data-error="wrong" data-success="right" class="center-align">SAG Password <b style="color:red;">*</b></label>
          </div>

          <br>
          <button class="mdl-button mdl-button--fab alignright" type="submit" name="mpesa"><i class="material-icons">save</i></button>
  </div>
  </form>
  </div>
  <br>
  <div class=" mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
  <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
  <div class="mdl-card__title">
  <i class="fa fa-paypal"></i>
    <span class="mdl-button">Paypal Settings</span>
  </div>
  <div class="mdl-card__supporting-text mdl-card--expand">

          <div class="input-field inline">
                  <i class="material-icons prefix">mail</i>
              <input id="name" type="email" name="name" value="<?php showOption( 'email' ); ?>">
              <label for="name" data-error="wrong" data-success="right" class="center-align">Paypal Email <b style="color:red;">*</b></label>
          </div>

          <div class="input-field inline alignright">
          <button class="mdl-button mdl-button--fab" type="submit" name="paypal"><i class="material-icons">save</i></button>
          </div>

  </div>
  </form>

  <br>

  <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
  <div class="mdl-card__title">
  <i class="fa fa-cc-stripe"></i>
    <span class="mdl-button">Stripe Settings</span>
  </div>
  <div class="mdl-card__supporting-text mdl-card--expand">

          <div class="input-field inline">
                  <i class="material-icons prefix">mail</i>
              <input id="name" type="email" name="name" value="<?php showOption( 'email' ); ?>">
              <label for="name" data-error="wrong" data-success="right" class="center-align">Stripe Email <b style="color:red;">*</b></label>
          </div>
          
          <div class="input-field inline alignright">
          <button class="mdl-button mdl-button--fab" type="submit" name="stripe"><i class="material-icons">save</i></button>
          </div>
  </div>
  </form>

  <br>

  <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
  <div class="mdl-card__title">
  <i class="fa fa-cc-stripe"></i>
    <span class="mdl-button">Bank Settings</span>
  </div>
  <div class="mdl-card__supporting-text mdl-card--expand">

          <div class="input-field">
                  <i class="material-icons prefix">account_balance</i>
              <input id="name" type="text" name="baccount" value="<?php showOption( 'name' ); ?>">
              <label for="name" data-error="wrong" data-success="right" class="center-align">Bank Name<b style="color:red;">*</b></label>
          </div>

          <div class="input-field">
                  <i class="material-icons prefix">business</i>
              <input id="name" type="text" name="bname" value="<?php showOption( 'timestamp' ); ?>">
              <label for="name" data-error="wrong" data-success="right" class="center-align">Account Number<b style="color:red;">*</b></label>
          </div>

          <div class="input-field inline">
                  <i class="material-icons prefix">business</i>
              <input id="name" type="text" name="bname" value="<?php showOption( 'paybill' ); ?>">
              <label for="name" data-error="wrong" data-success="right" class="center-align">Branch Code<b style="color:red;">*</b></label>
          </div>
          
          <div class="input-field inline alignright">
          <button class="mdl-button mdl-button--fab align-right" type="submit" name="stripe"><i class="material-icons">save</i></button>
          </div>
  </div>
  </form>
  </div>

  </div>
  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                  <div class="mdl-card__title">
                  <i class="material-icons">info_outline</i>
                    <span class="mdl-button">Shop Settings Help</span>
                  </div>
                  <div class="mdl-card__supporting-text mdl-card--expand">
                  <ul class="collapsible popout" data-collapsible="accordion">
                  <li>
                    <div class="collapsible-header active"><i class="material-icons">message</i>Setting Up M-PESA</div>
                    <div class="collapsible-body">
                    <span><b>Required Constants</b></span>
                      <ul>
                          <li>Paybill Number</li>
                          <li>Paybill Number</li>
                          <li>Get Paybill Number</li>
                          <li>Get Paybill Number</li>
                          <li>Get Paybill Number</li>
                      </ul>
                      <span>More details can be found on <a href="https://safaricom.co.ke">Safaricom's website.</a></span>
                    </div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="fa fa-paypal"></i>Paypal Settings</div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">chat_bubble</i>M-PESA Settings</div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">description</i>M-PESA Settings</div>
                    <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                  </li>
                </ul>
                  </div>
              </div>
  </div><?php 
} ?>