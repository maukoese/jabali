<?php 

namespace Jabali\Classes;

class Options {

	/**
	* Create menu
	**/
	function create ( $name, $code, $details, $updated ) {
		if( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."options (name, code, details, updated ) VALUES ( '".$name."', '".$code."', '".$details."', '".$updated."' )" ) ) {
			_shout_( "Setting Created Sucessfully!", "success");
          } else {
          	_shout_( "Error: " . $GLOBALS['JBLDB'] -> error(), "error");
          }
	}

    /**
    * Create initial menu
    * Suppress success message
    **/
    function install ( $name, $code, $details, $updated ) {
        if( !$GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."options (name, code, details, updated ) VALUES ( '".$name."', '".$code."', '".$details."', '".$updated."' )" ) ) {
            _shout_( "Error: " . $GLOBALS['JBLDB'] -> error(), "error");
        }
    }

	function update ( $code, $details, $updated ) {
		if( $GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."options SET details = '".$details."', updated = '".$updated."' WHERE code='".$code."'" ) ){
			_shout_( "Setting Updated Sucessfully!", "success");
          } else {
          	_shout_( "Error: " . $GLOBALS['JBLDB'] -> error(), "error");
          }
	}

    function general(){ ?>
        <title>General Site Options [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
            <form enctype="multipart/form-data" name="optionForm" method="POST" action="">

                    <h5>Basic Details</h5>

                    <div class="input-field">
                            <i class="material-icons prefix">label</i>
                        <input id="name" type="text" name="name" value="<?php showOption( 'name' ); ?>">
                        <label for="name" data-error="wrong" data-success="right" class="center-align">Site Name </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">details</i>
                        <input id="description" type="text" name="description" value="<?php showOption( 'description' ); ?>">
                        <label for="description" class="center-align">Short Description </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">details</i>
                        <input id="description" type="text" name="about" value="<?php showOption( 'about' ); ?>">
                        <label for="description" class="center-align">Long Description </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">mail</i>
                        <input id="email" type="text" name="email" value="<?php showOption( 'email' ); ?>">
                        <label for="email" class="center-align">Admin Email </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">phone</i>
                        <input id="phone" type="text" name="phone" value="<?php showOption( 'phone' ); ?>">
                        <label for="phone" class="center-align">Admin Phone </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">copyright</i>
                        <input id="copyright" type="text" name="copyright" value="<?php showOption( 'copyright' ); ?>">
                        <label for="copyright" class="center-align">Footer Copyright </label>
                    </div>

                    <div class="input-field">
                            <i class="mdi mdi-format-color-text prefix"></i>
                        <input id="attribution" type="text" name="attribution" value="<?php showOption( 'attribution' ); ?>">
                        <label for="attribution" class="center-align">Footer Attribution </label>
                    </div>

                    <div class="input-field">
                            <i class="mdi mdi-link prefix"></i>
                        <input id="attribution_link" type="text" name="attribution_link" value="<?php showOption( 'attribution_link' ); ?>">
                        <label for="attribution_link" class="center-align">Footer Attribution Link</label>
                    </div>

                    <h5>Language</h5>

                    <div class="input-field">
                            <i class="material-icons prefix">details</i>
                        <input id="language" type="text" name="language" value="<?php showOption( 'language' ); ?>">
                        <label for="language" class="center-align">Site Language </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">details</i>
                        <input id="language" type="text" name="charset" value="<?php showOption( 'charset' ); ?>">
                        <label for="language" class="center-align">Site Charset </label>
                    </div>

                    <h5>Location</h5>

                    <?php $GLOBALS['hGlobal'] -> countries(); ?>

                    <?php $GLOBALS['hGlobal'] -> regions( strtolower( getOption( 'country' ) ) ); ?>

                    <div class="input-field">
                            <i class="material-icons prefix">room</i>
                        <input id="attribution_link" type="text" name="city" value="<?php showOption( 'city' ); ?>">
                        <label for="attribution_link" class="center-align">City</label>
                    </div>

                    <?php $GLOBALS['hGlobal'] -> timeZone(); ?>

                    <div class="mdl-cell mdl-cell--6-col">
                      <input type="checkbox" id="registration" name="registration" <?php showOption( 'registration' ); ?> value="checked" />
                      <label for="registration">Allow User Registrations?</label>
                    </div>

            </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <script>
                   function chooseHeader() {
                      $( "#header_logo" ).click();
                   }

                   function chooseHome() {
                      $( "#home_logo" ).click();
                   }

                   function chooseFavicon() {
                      $( "#my_favicon" ).click();
                   }
                </script>
            <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                    <div class="mdl-card__title--text">
                        Favicon
                    </div>
                </div>
                <div class="mdl-card__image">
                    <input type="hidden" name="favicon" value="<?php getOption( 'favicon' ); ?>">
                    <div style="height:0px;overflow:hidden">
                        <input id="my_favicon" type="file" name="newfavicon">
                    </div>
                    <?php if ( is_file( getOption( 'favicon' ) ) ) { $favicon = _IMAGES.'marker.png'; } else { $favicon = getOption( 'favicon' ); } ?>
                    <img src="<?php echo $favicon; ?>" width="50%" onclick="chooseFavicon();">
                </div>
            </div>
            <br>
            <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                    <div class="mdl-card__title--text">
                        Header Logo
                    </div>
                </div>
                <div class="mdl-card__image">
                    <input type="hidden" name="headerlogo" value="<?php getOption( 'headerlogo' ); ?>">
                    <div style="height:0px;overflow:hidden">
                        <input id="header_logo" type="file" name="newheaderlogo">
                    </div>
                    <?php $hl = getOption( 'headerlogo' );  if ( file_exists( $hl ) ) { $headerlogo = _IMAGES.'marker.png'; } else { $headerlogo = getOption( 'headerlogo' ); } ?>
                    <img src="<?php echo $headerlogo; ?>" width="100%" onclick="chooseHeader();">
                </div>
            </div>
            <br>
            <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                    <div class="mdl-card__title--text">
                        Home Logo
                    </div>
                </div>
                <div class="mdl-card__image">
                    <input type="hidden" name="homelogo" value="<?php getOption( "homelogo" ); ?>">
                    <div style="height:0px;overflow:hidden">
                    <input id="home_logo" type="file" name="newhomelogo">
                    </div>
                    <img src="<?php if ( file_exists( getOption( 'homelogo' ) ) ){ echo _IMAGES.'marker.png'; } else {  showOption( 'homelogo' ); } ?>" width="100%" onclick="chooseHome();">
                </div>
            </div>
            <?php csrf(); ?>
        <button class="mdl-button mdl-button--fab mdl-button--colored addfab" type="submit" name="preferences"><i class="material-icons">save</i></button>
        </form>
        </div><?php 
    }

    function misc(){ ?>
        <title>Misc. Site Options [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
            <form enctype="multipart/form-data" name="optionForm" method="POST" action="">

                    <div class="input-field">
                            <i class="material-icons prefix">description</i>
                        <input id="name" type="text" name="name" value="<?php showOption( 'homepage' ); ?>">
                        <label for="name" data-error="wrong" data-success="right" class="center-align">Home Page </label>
                    </div>
                    <div class="input-field">
                            <i class="material-icons prefix">description</i>
                        <input id="name" type="text" name="name" value="<?php showOption( 'postspage' ); ?>">
                        <label for="name" data-error="wrong" data-success="right" class="center-align">Posts Page </label>
                    </div>

                    <?php $GLOBALS['hGlobal'] -> currencyCode(); ?>

                    <div class="input-field">
                            <i class="material-icons prefix">room</i>
                        <textarea class="materialize-textarea" id="map" name="map" value="<?php showOption( 'map' ); ?>"></textarea>
                        <label for="map" class="center-align">Map Embed Link (iframe) </label>
                    </div>



                <div class="input-field">
                    <textarea id="h_tos" name="tos" class="materialize-textarea col s12"><?php showOption( 'tos' ); ?></textarea><script>CKEDITOR.replace( "h_tos" );</script>
                    <label for="h_tos" data-error="wrong" data-success="right" class="center-align">Terms of Service </label>
                </div>

            </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">

                <button class="mdl-button mdl-button--fab mdl-button--colored addfab" type="submit" name="preferences"><i class="material-icons">save</i></button>
            </div>
        </form>
        </div><?php 
    }

	function types(){
		if ( isset( $_GET['table'] ) ) { ?>
            <title><?php echo ucwords( $_GET['table'] ); ?> Options [ <?php showOption( 'name' ); ?> ]</title>
            <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                <div class="mdl-card mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__supporting-text mdl-card--expand">
                <div class="mdl-grid mdl-card">
                    <div class="mdl-cell mdl-cell--6-col" >
                    <h6>Inbuilt Types</h6><?php
                    global $hMenu;
                    $types = $hMenu -> allTypes( $_GET['table'] );
                    foreach ( $types as $type ) {
                         echo '<a href="'. _ADMIN.'/'.$_GET['table'].'?view=list&type='. $type .'" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">bubble_chart</i><span style="padding-left: 20px">'. ucwords( $type ) .'</span></a>';
                     } ?>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col" >
                    <h6>User Defined Types</h6><?php
                        $data = getOption( substr( $_GET['table'] , 0, -1).'types' );
                        $datatypes = json_decode( $data, true );
                        foreach ($datatypes as $type => $level ) {
                            echo '<a href="./users?view=list&type='.strtolower( $type ).'" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">people</i><span style="padding-left: 20px">'.$type.' -</span> '.$level.'</a>';
                         } ?>
                    </div>
                </div>
                        <h6>Add New <?php echo ucwords( $_GET['table'] ); ?> Type</h6>
                <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-grid ">

                        <div class="input-field mdl-cell">
                                <i class="material-icons prefix">label</i>
                            <input id="merchant" type="text" name="utype[]" placeholder="e.g Accountant">
                            <label for="merchant" data-error="wrong" data-success="right" class="center-align">Label</label>
                        </div>

                        <div class="input-field mdl-cell mdl-js-textfield getmdl-select">
                        <i class="material-icons prefix">lock</i>
                         <input class="mdl-textfield__input" id="ilk" name="ulevel[]" type="text" readonly tabIndex="-1" placeholder="Select Level" >
                          <label for="ilk">
                              <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                          </label>
                           <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk"><?php
                                global $hMenu;
                                $types = $hMenu -> allTypes( $_GET['table'] );
                                foreach ( $types as $type ) { ?>
                                    <li class="mdl-menu__item" data-val="<?php echo $type; ?>"><?php echo ucwords( $type ); ?></li>
                                <?php } ?>
                           </ul>
                        </div><?php
                        $users = getOption( substr( $_GET['table'] , 0, -1).'types' );
                        $usertypes = json_decode( $users, true );
                        foreach ($usertypes as $type => $level ) {
                            echo '<input type="hidden" name="utype[]'.$type.'" value=" '.$type.'" />';
                            echo '<input type="hidden" name="ulevel[]'.$type.'" value=" '.$level.'" />';
                         } ?>
                        <div class="input-field mdl-cell">
                            <?php csrf(); ?>
                            <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit"><i class="material-icons">save</i></button>
                        </div>
                </form>
                </div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                        <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                            <div class="mdl-card__title">
                            <i class="material-icons">group</i>
                              <span class="mdl-button">User Types & Permisions</span>
                            </div>
                            <div class="mdl-card__supporting-text mdl-card--expand">
                            <ul class="collapsible popout" data-collapsible="accordion">
                            <li>
                              <div class="collapsible-header active"><i class="material-icons">supervisor_account</i>Admin<b class="alignright">Level 1</b></div>
                              <div class="collapsible-body">
                              <span><b>Permisions</b></span>
                                <ul>
                                    <li>Create, Edit & Delete Users</li>
                                    <li>Create, Edit & Delete Posts</li>
                                    <li>Create, Edit & Delete Resources</li>
                                </ul>
                              </div>
                            </li>
                            <li>
                              <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Editor<b class="alignright">Level 2</b></div>
                              <div class="collapsible-body">
                              <span><b>Permisions</b></span>
                                <ul>
                                    <li>Create, Edit & Delete Posts</li>
                                    <li>Create, Edit & Delete Resources</li>
                                </ul>
                                </div>
                            </li>
                            <li>
                              <div class="collapsible-header"><i class="material-icons">create</i>Author<b class="alignright">Level 3</b></div>
                              <div class="collapsible-body">
                              <span><b>Permisions</b></span>
                                <ul>
                                    <li>Create, Edit & Delete Users</li>
                                    <li>Create, Edit & Delete Posts</li>
                                    <li>Create, Edit & Delete Resources</li>
                                </ul>
                                </div>
                            </li>
                            <li>
                              <div class="collapsible-header"><i class="material-icons">mail_outline</i>Subscriber<b class="alignright">Level 4</b></div>
                              <div class="collapsible-body">
                              <span><b>Permisions</b></span>
                                <ul>
                                    <li>Create, Edit & Delete Messages</li>
                                </ul>
                                </div>
                            </li>
                          </ul>
                            </div>
                        </div>
            </div><?php
    	} else { ?>
    	   <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
    			        <div class="mdl-card mdl-color--<?php primaryColor(); ?>">
    			        <div class="mdl-card__supporting-text mdl-card--expand">
    			        	<h1>The Jabali Types API</h1>
    			        	<article>
    			        		<p>Jabali provides users with the ability to add any type of content, even as it comes preinstalled with all the types you may need.</p>
    			        		<ul class="mdl-list">
    			        			<li class="mdl-list__item">
    								    <span class="mdl-list__item-primary-content">
    								    	<a href="?settings=types&table=users">
    								    	<i class="material-icons mdl-list__item-icon">group</i>
    								    User Types
    								</a>
    									</span>
    								 </li>
    			        			<li class="mdl-list__item">
    								    <span class="mdl-list__item-primary-content">
    								    	<a href="?settings=types&table=posts">
    								    	<i class="material-icons mdl-list__item-icon">description</i>Post Types</a>
    								</a>
    									</span>
    								 </li>
    			        			<li class="mdl-list__item">
    								    <span class="mdl-list__item-primary-content">
    								    	<a href="?settings=types&table=resource">
    								    	<i class="material-icons mdl-list__item-icon">business</i>Resource Types</a>
    								</a>
    									</span>
    								 </li>
    			        			<li class="mdl-list__item">
    								    <span class="mdl-list__item-primary-content">
    								    	<a href="?settings=types&table=message">
    								    	<i class="material-icons mdl-list__item-icon">message</i>Message Types</a>
    								</a>
    									</span>
    								 </li>
    			        			<li class="mdl-list__item">
    								    <span class="mdl-list__item-primary-content">
    								    	<a href="?settings=types&table=comments">
    								    	<i class="material-icons mdl-list__item-icon">comments</i>Comments Types</a>
    								</a>
    									</span>
    								 </li>
    			        		</ul>
    			        	</article>
    			        </div>
    			        </div>
    	   </div>
    	  <ul class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone collapsible <?php primaryColor(); ?>" data-collapsible="accordion">
            <li>
              	<div class="collapsible-header active"><i class="material-icons">group</i>Users</div>
              	<div class="collapsible-body">
              		<div class="mdl-list">
        		      	<span class="mdl-list__item-primary-content">
        			    	<a href="?settings=types&table=comments">
        				    	<i class="material-icons mdl-list__item-icon">supervisor_account</i>Admin</a>
        					</a>
        				</span>
        			</div>
        		</div>
            </li>
            <li>
              	<div class="collapsible-header"><i class="material-icons">description</i>Posts</div>
              	<div class="collapsible-body">
              		<div class="mdl-list">
        		      	<span class="mdl-list__item-primary-content">
        			    	<a href="?settings=types&table=comments">
        				    	<i class="material-icons mdl-list__item-icon">description</i>Articles</a>
        					</a>
        				</span>
        			</div>
        		</div>
            </li>
          </ul><?php
    	}
	}

	function social(){ ?>
        <title>Site Social Settings [ <?php showOption( 'name' ); ?> ]</title>
            <div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Social Networks
                    </div>
                    <div class="mdl-layout-spacer"></div>
                    <i class="material-icons">public</i>
                </div>
                <div class="mdl-card_supporting-text" style="padding: 20px;">
                     <form enctype="multipart/form-data" name="optionForm" method="POST" action="" ><?php 
                          $social = getOption( 'social' );
                          $social = json_decode( $social ); 
                          foreach ($social as $key => $value) { ?>

                        <div class="input-field">
                          <i class="fa fa-<?php _show_( $key ); ?> prefix"></i>
                          <input id="<?php _show_( $key ); ?>" name="network[]<?php _show_( $key ); ?>" type="text" value="<?php _show_( $value ); ?>">
                          <input name="link[]<?php _show_( $value ); ?>" type="hidden" value="<?php _show_( $value ); ?>">
                          <label for="<?php _show_( $key ); ?>"><?php _show_( ucwords( $key ) ); ?></label>
                        </div><?php } ?>
                        <h5>Add New Network</h5>
                        <div class="input-field">
                          <i class="fa fa-globe prefix"></i>
                          <input id="newsocial" name="network[]" type="text" value="">
                          <label for="newsocial">Network Name</label>
                        </div>
                        <div class="input-field">
                          <i class="fa fa-link prefix"></i>
                          <input id="newsocial" name="link[]" type="text" value="">
                          <label for="newsocial">Network Link</label>
                        </div>
                        <?php csrf(); ?><br>

                        <div class="input-field">
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored mdl-js-ripple-effect alignright" type="submit" name="social"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                        <div class="mdl-card__title-text">
                            Mauko by Design
                        </div>
                        <div class="mdl-layout-spacer"></div>
                        <i class="material-icons">public</i>
                    </div>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1084251448343450";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-page mdl-card_supporting-text" data-href="https://www.facebook.com/maukoese/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/maukoese/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/maukoese/">Mauko by Design</a></blockquote></div>
                    </div><?php
	}

    function editor(){ ?>
        <title>Ace Editor Settings [ <?php showOption( 'name' ); ?> ]</title>
            <div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card_supporting-text" style="padding: 20px;">
                     <form enctype="multipart/form-data" name="optionForm" method="POST" action="" >
                          <div class="input-field mdl-cell mdl-js-textfield getmdl-select  mdl-cell--6-col">
                            <i class="material-icons prefix">palette</i>
                             <input class="mdl-textfield__input" id="ilk" name="acetheme" type="text" readonly tabIndex="-1" placeholder="Select Theme" >
                              <label for="ilk">Ace Editor Theme</label>
                               <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk"><?php 
                                    $themes = array( "chrome", "crimson", "kuroir", "iplastic", "github", "monokai", "ambiance", "terminal", "twilight", "chaos" );
                                    foreach ( $themes as $theme ): ?>
                                        <div class="mdl-cell mdl-cell--6-col">
                                            <li class="mdl-menu__item" data-val="<?php echo $theme; ?>"><?php echo $theme; ?></li>
                                        </div><?php
                                    endforeach; ?>
                               </ul>
                            </div>

                            <div class="mdl-cell mdl-cell--6-col">
                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
                              <input type="checkbox" id="switch-2" class="mdl-switch__input" name="state" value="visible"> <span style="padding-left: 20px;">Hide Gutter</span>         
                            </label>
                            </div>

                            <div class="mdl-cell mdl-cell--6-col">
                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-3">
                              <input type="checkbox" id="switch-3" class="mdl-switch__input" name="state" value="visible"> <span style="padding-left: 20px;">Hide Line Numbers</span>         
                            </label>
                            </div>
                            <div class="mdl-cell mdl-cell--12-col">
                                <h4>Using Ace Editor</h4>
                                <textarea data-editor="html" data-gutter="1" data-theme="chrome" style="height: 300px;"><?php echo "\n\n//Add the following code to where you want the editor to show \n\n<textarea data-editor=\"html\" style=\"height: 100px\" ><//textarea>"; ?></textarea>
                            </div>
                    </form>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--12-col-phone">
            <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                        <div class="mdl-card__title-text">
                            Ace Editor Themes
                        </div>
                        <div class="mdl-layout-spacer"></div>
                        <i class="material-icons">public</i>
                    </div>
                <div class="mdl-card_supporting-text mdl-grid">

                    <?php $themes = array( "chrome", "crimson", "kuroir", "iplastic", "github", "monokai", "ambiance", "terminal", "twilight", "chaos" );
                    foreach ( $themes as $theme ): ?>
                        <div class="mdl-cell mdl-cell--6-col">
                            <textarea data-editor="php" data-theme="<?php echo $theme; ?>" style="height: 100px;"><?php echo "Theme: ".ucfirst( $theme )."\n\nSlug: ".$theme; ?></textarea>
                        </div><?php
                    endforeach; ?>
                </div>
           </div></div><?php
    }

	function colors(){ ?>
		<title>Skin Color Options [ <?php showOption( 'name' ); ?> ]</title>
	        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--9-col-tablet mdl-cell--12-col-phone">
	        	<div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
	        		<style type="text/css">
	                    .cholder {
	                        display: inline-flex;
	                        }

	                    .ccolor {
	                        height: 25px;
	                        width: 25px;
	                        border-radius: 50%;
	                        border: #eee 1px solid;
	                    }

	                    .clabel {
	                        padding-left: 20px;
	                    }
	                </style>
	                <div class="mdl-card__title">
	                    <div class="mdl-card__title-text">
	                        Select Skin
	                    </div>
	                    <div class="mdl-layout-spacer"></div>
	                    <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
	                        <i class="material-icons">color_lens</i>
	                    </div>
	                </div>
	                <div class="mdl-card_supporting-text">
	                <form enctype="multipart/form-data" name="themeForm" method="POST" action="" class="mdl-cell mdl-cell--12-col mdl-grid">

	                    <?php $skins = loadSkins();
	                    foreach ($skins as $skin => $color ) { ?>
	                         <div class="mdl-cell mdl-cell--2-col">
	                        <input type="radio" id="<?php echo $skin; ?>" name="theme" value="<?php echo $skin; ?>" <?php isTheme ('zahra' ); ?>>
	                        <label for="<?php echo $skin; ?>"><p class="cholder" for="<?php echo $skin; ?>">
	                            <span class="cholder" for="<?php echo $skin; ?>">
	                                <span class="ccolor mdl-color--<?php echo $color['primary']; ?>"></span>
	                                <span class="ccolor csec mdl-color--<?php echo $color['accent']; ?>"></span>
	                                <span class="ccolor csec mdl-color--<?php echo $color['textp']; ?>"></span>
	                                <span class="ccolor csec mdl-color--<?php echo $color['texts']; ?>"></span>
	                        </p></label>
	                    </div><div class="mdl-tooltip" for="<?php echo $skin; ?>"><?php echo $color['name']; ?></div><?php
	                     } ?>

	                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored alignright" type="submit" name="mystyle"><i class="material-icons">save</i></button>
	                    <?php csrf(); ?>
	                </form>
	                </div>
	        	</div><br>
	            <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
	                <div class="mdl-card__title">
	                    <div class="mdl-card__title-text">
	                        Custom Skin
	                    </div>

	                    <div class="mdl-layout-spacer"></div>
	                    <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
	                        <i class="material-icons">brush</i>
	                    </div>
	                </div>

	                <form enctype="multipart/form-data" name="themeForm" method="POST" action="" class="mdl-cell mdl-cell--12-col">
	                <div class="mdl-card_supporting-text">
	                    <div class="input-field">
	                        <i class="mdi mdi-format-paragraph prefix"></i>
	                        <input id="pri" type="text" name="primary">
	                        <label for="pri" data-error="wrong" data-success="right" class="center-align">Primary Color </label>
	                    </div>

	                    <div class="input-field">
	                        <i class="mdi mdi-format-color-text prefix"></i>
	                        <input id="secondary" type="text" name="accent">
	                        <label for="secondary" data-error="wrong" data-success="right" class="center-align">Accent Color </label>
	                    </div>

	                    <div class="input-field">
	                        <i class="mdi mdi-format-paragraph prefix"></i>
	                        <input id="textp" type="text" name="textp">
	                        <label for="textp" data-error="wrong" data-success="right" class="center-align">Text Primary Color </label>
	                    </div>

	                    <div class="input-field">
	                        <i class="mdi mdi-code-string prefix"></i>
	                        <input id="texts" type="text" name="texts">
	                        <label for="texts" data-error="wrong" data-success="right" class="center-align">Text Secondary Color </label>
	                    </div>

	                    <div class="input-field inline">
	                        <i class="mdi mdi-label prefix"></i>
	                        <input id="name" type="text" name="name">
	                        <label for="name" data-error="wrong" data-success="right" class="center-align">Skin Name </label>
	                    </div>
	                    <?php csrf(); ?>

	                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored alignright" type="submit" name="custom"><i class="material-icons">save</i></button>
	                </form>
	                </div>
	            </div>
	        </div>

	        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
	                <div class="mdl-card__title">
	                    <div class="mdl-card__title-text">
	                        Color Palette
	                    </div>

	                    <div class="mdl-layout-spacer"></div>
	                    <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
	                        <i class="material-icons">palette</i>
	                    </div>
	                </div>
	                <div class="mdl-card_supporting-text" style="margin: 5%;"><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--red"></span><span class="clabel"> Red</span><span class="clabel"> ( red )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--pink"></span><span class="clabel"> Pink</span><span class="clabel"> ( pink )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--purple"></span><span class="clabel"> Purple</span><span class="clabel"> ( purple )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--deep-purple"></span><span class="clabel"> Deep Purple</span><span class="clabel"> ( deep-purple )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--indigo"></span><span class="clabel"> Indigo</span><span class="clabel"> ( indigo )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--blue"></span><span class="clabel"> Blue</span><span class="clabel"> ( blue )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--light-blue"></span><span class="clabel"> Light Blue</span><span class="clabel"> ( light-blue )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--cyan"></span><span class="clabel"> Cyan</span><span class="clabel"> ( cyan )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--teal"></span><span class="clabel"> Teal</span><span class="clabel"> ( teal )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--green"></span><span class="clabel"> Green</span><span class="clabel"> ( green )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--light-green"></span><span class="clabel"> Light Green</span><span class="clabel"> ( light-green )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--lime"></span><span class="clabel"> Lime</span><span class="clabel"> ( green )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--yellow"></span><span class="clabel"> Yellow</span><span class="clabel"> ( yellow )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--amber"></span><span class="clabel"> Amber</span><span class="clabel"> ( amber )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--orange"></span><span class="clabel"> Orange</span><span class="clabel"> ( orange )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--deep-orange"></span><span class="clabel"> Deep Orange</span><span class="clabel"> ( deep-orange )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--brown"></span><span class="clabel"> Brown</span><span class="clabel"> ( brown )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--grey"></span><span class="clabel"> Grey</span><span class="clabel"> ( grey )</span>
	                    </p><br>
	                   <p class="cholder">
	                        <span class="ccolor mdl-color--blue-grey"></span><span class="clabel"> Blue Grey</span><span class="clabel"> ( blue-grey )</span>
	                    </p><br>
	                </div>
	        </div><?php 
	}

    function rest(){ ?>
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class="mdl-card__title">
            <span class="mdl-card__title-text">API Clients</span>
              <div class="mdl-layout-spacer"></div>
            </div>
            <div class="mdl-card__supporting-text">
              <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
                    <tr>
                        <thead>
                            <th>Client</th>
                            <th>ID</th>
                            <th>Key</th>
                            <th>Actions</th>
                        </thead>
                    </tr>
                    <tbody>
                    <form method="POST" action="">
                        <td data-title="Client"><input type="text" name="cname" value="<?php showOption( 'name' ); ?> Android"></ins></td>
                        <td data-title="Client"><input type="text" name="cid" value="<?php echo JBLSALT; ?>"></td>
                        <td data-title="Client"><input type="text" name="ckey" value="<?php echo JBLAUTH; ?>" ></td>
                        <td data-title="Client"><button type="submit" name="deleteclient" class="mdl-button mdl-button--icon"><i class="material-icons">delete</i></button><button type="submit" name="updateclient" class="mdl-button mdl-button--icon"><i class="material-icons">save</i></button></td>
                    <?php csrf(); ?>
                    </form>
                    </tbody>
                </table>

                <h5>Add New Client</h5>
                <form method="POST" action="">
                    <div class="input-field">
                        <i class="material-icons prefix">label</i>
                        <input id="cname" type="text" name="cname">
                        <label for="cname">Client Name</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">label_outline</i>
                        <input id="cid" type="text" name="cid" value="<?php echo substr( str_shuffle( md5( md5( date( 'Y-m-d H-i-s' ) ) ) ), 0, 16); ?>">
                        <label for="cid">Client ID</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input id="ckey" type="text" name="ckey" value="<?php echo md5(md5(date('Y-m-d H-i-s'))); ?>">
                        <label for="ckey">Client Key</label>
                    </div>
                    <?php csrf(); ?>

                    <button type="submit" name="newclient" class="mdl-button mdl-button--colored mdl-button--fab alignright"><i class="material-icons">save</i></button>
                </form>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
          
          <div class="mdl-card__title">
                <span class="mdl-card__title-text">The Jabali REST-API</span>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
                   <a href="<?php echo _API; ?>">
                       <i class="material-icons">open_in_new</i>
                    </a>
              </div>
          </div>
          <ul class="collapsible popout mdl-card__supporting-text" data-collapsible="accordion">
              <li>
                <div class="collapsible-header active"><i class="material-icons">group</i>
                    <b>Users</b>
                </div>
                <div class="collapsible-body">
                 <article>
                  <p>All Users: <a href="<?php echo _API.'users/view'; ?>"><?php echo 'users/view/'; ?></a></p>
                  <p>All Users: <a href="<?php echo _API.'users/view'; ?>"><?php echo 'users/view/id/'; ?></a></p>
                  <p>All Users: <a href="<?php echo _API.'users/view'; ?>"><?php echo 'users/view/username/'; ?></a></p>
                  <p>All Users: <a href="<?php echo _API.'users/view'; ?>"><?php echo 'users/view/type/'; ?></a></p>
                  <p>All Users: <a href="<?php echo _API.'users/view'; ?>"><?php echo 'users/view/categories/category/'; ?></a></p>
                  <p>All Users: <a href="<?php echo _API.'users/view'; ?>"><?php echo 'users/view/tags/tag/'; ?></a></p>
                 </article>
                </div>
              </li>
              <li>
                <div class="collapsible-header"><i class="material-icons">description</i>
                    <b>Posts</b>
                </div>
                <div class="collapsible-body">
                <article>
                  <p>To add a dropdown menu, fill all fields. Select the main menu for which you are adding a dropdown. Make sure the dropdown switch is not checked.</p>
                  <p>Remember to check the "Visible" box otherwise your menu won't show.</p>
                </article>
                </div>
              </li>
              <li>
                <div class="collapsible-header"><i class="material-icons">comments</i>
                    <b>Comments</b>
                </div>
                <div class="collapsible-body">
                <article>
                  <p>To add a dropdown menu, fill all fields. Select the main menu for which you are adding a dropdown. Make sure the dropdown switch is not checked.</p>
                  <p>Remember to check the "Visible" box otherwise your menu won't show.</p>
                </article>
                </div>
              </li>
        </ul>
        </div><?php
    }

}