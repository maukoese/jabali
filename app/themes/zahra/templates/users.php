<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col mdl-grid"><?php 
					while ( $profilesDetails = mysqli_fetch_assoc( $getProfiles)){ ?>
						<div class="mdl-cell card">
							<div class="card-image waves-effect waves-block waves-light">
								<img class="activator" src="<?php _show_( $profilesDetails['avatar'] ); ?>">
							</div>

							<div class="card-content mdl-color-text--black">
								<a href="<?php _show_( _ROOT.'users/'.$profilesDetails['username'] ); ?>"><span class="card-title grey-text text-darken-4"><?php _show_( $profilesDetails['name'] ); ?><i class="material-icons right">arrow_forward</i></span></a>
							</div>

							<div class="card-reveal mdl-color-text--black">
								<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span><br>
								<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">perm_identity</i><span style="padding-left: 20px"></span>@<?php _show_( $profilesDetails['username'] ); ?></span>
								<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">label_outline</i><span style="padding-left: 20px"><?php _show_( ucwords( $profilesDetails['ilk'] ) ); ?></span></span>
								<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">label_outline</i><span style="padding-left: 20px"><?php _show_( ucwords( $profilesDetails['ilk'] ) ); ?></span></span>
								<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">business</i><span style="padding-left: 20px"><?php _show_( ucwords( $profilesDetails['company'] ) ); ?></span></span>
								<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">room</i><span style="padding-left: 20px"><?php _show_( ucwords( $profilesDetails['location'] ) ); ?></span></span>
								<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">today</i><span style="padding-left: 20px"><?php $date = $profilesDetails['created'];
								$date = explode(" ", $date); _show_( $date[0] ); ?></span></span><br><?php
		                          $social = json_decode( $profilesDetails['social'] ); 
		                          foreach ($social as $key => $value) { ?>
		                          <div style="display: inline;">
		                          <a href="<?php _show_( $value ); ?>" type="text" value="<?php _show_( $value ); ?>">
		                          <i class="fa fa-<?php _show_( $key ); ?> fa-2x"></i></a>
		                          </div><?php } ?>
		                          	<a href="tel:<?php _show_( $profilesDetails['phone'] ); ?>"><i class="fa fa-phone fa-2x"></i></a>
		                          	<a href="mailto:<?php _show_( $profilesDetails['email'] ); ?>"><i class="fa fa-envelope fa-2x"></i></a>
		                          <span class="">
									<a class="mdl-button mdl-button--colored" href="<?php _show_( _ROOT.'users/'.$profilesDetails['username'] ); ?>">view full profile</a>
		                          </span>
								<center>
								</center><br>
							</div>
						</div><?php 
					} ?>
					</div>
				</div>