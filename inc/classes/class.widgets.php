<?php 
/**
* Social Sharing & icons
*/
class _hWidgets {

  	function dashRecents() { ?>
		<div class="mdl-card__title mdl-card--expand">
		  <div class="mdl-card__title-text">
		    Recently Published
		  </div>
		      <div class="mdl-layout-spacer"></div>
		      <div class="mdl-card__subtitle-text">
		        <a href="./post?view=list&type=articles" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">open_in_new</i></a>
		      </div>
		</div>
		  <div class="mdl-card__supporting-text"><?php 
		  $getRecents = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts ORDER BY h_created ASC LIMIT 6" );
		  if ( $getRecents -> num_rows > 0 ) {
		     while ( $recent = mysqli_fetch_assoc( $getRecents ) ) {
		       $posts[] = $recent;
		     }
		  }
		  if ( !empty( $posts ) ) {
		    foreach ($posts as $post) { ?>
		      <a href="<?php _show_( hROOT.$post['h_link'] ); ?>" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i><span style="padding-left: 20px"><?php _show_( $post['h_alias'] ); ?></span></a><?php 
		    } 
		  } ?>
		  </div><?php
	}

  	function dashDrafts() { ?>
	  	<div class="mdl-card__title mdl-card--expand">
	          <div class="mdl-card__title-text">
	            Add New Draft
	          </div>
	              <div class="mdl-layout-spacer"></div>
	              <div class="mdl-card__subtitle-text">
	                <i class="material-icons">create</i>
	              </div>
	    </div>
	    <div class="mdl-card__supporting-text">
	    <form enctype="multipart/form-data" name="registerUser" method="POST" action="./index?page=dash">

	    <div class="input-field">
	    <i class="material-icons prefix">label</i>
	    <input id="h_alias" name="h_alias" type="text">
	    <label for="h_alias">Title</label>
	    </div>

	    <div class="input-field">
	    <i class="material-icons prefix">description</i>
	    <textarea class="materialize-textarea col s12" rows="5" id="h_description" name="h_description" ></textarea>
	    <label for="h_description">Content</label>
	    </div>


	    <p><b><strong>Recent Drafts</strong></b></p>
	    <div class="mdl-grid">
	      <div class="mdl-cell mdl-cell--8-col">
	      	<?php $hPost = new _hPosts();
	        $hPost -> dashDrafts(); ?>
	      </div>
	      <div class="mdl-cell mdl-cell--4-col">
	        <button type="submit" name="draft" class="mdl-button mdl-button--fab alignright"><i class="material-icons">save</i></button>
	      </div>
	    </div>

	    </form>
	    </div><?php
	}

  	function quickLinks() { ?>
		<div class="mdl-card__title mdl-card--expand">
			<div class="mdl-card__title-text">
			  Quick Links
			</div>
			<div class="mdl-layout-spacer"></div>
			<div class="mdl-card__subtitle-text">
			</div>
		</div>
		<div class="mdl-card__supporting-text">
			<a href="<?php _show_(  './user?edit='. $_SESSION['myCode'] .'&key='.$_SESSION['myAlias'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">Edit Your Account</span></a>  
			<a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-palette mdl-list__item-icon"></i><span style="padding-left: 20px">Change Theme</span></a>  
			<a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-settings mdl-list__item-icon"></i><span style="padding-left: 20px">General Settings</span></a>  
			<a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account-settings mdl-list__item-icon"></i><span style="padding-left: 20px">User Settings</span></a>  
			<a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">New Page</span></a>  
			<a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">New Article</span></a>  
		</div><?php
	}

	function stats(){ ?>
		<div class="mdl-card__title mdl-card--expand">
            <div class="mdl-card__title-text">
              Stats
            </div>
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-card__subtitle-text">
                  v 17.06
                </div>
          </div>
            <div class="mdl-card__supporting-text"">
            </div><?php
	}

	function jabaliCentral() { ?>
		<div class="mdl-card__title mdl-card--expand">
          <div class="mdl-card__title-text">
            Jabali Central
          </div>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                v 17.06
              </div>
        </div>
          <div class="mdl-card__supporting-text"><?php 
          $getRecents = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts ORDER BY h_created ASC LIMIT 5" );
          if ( $getRecents -> num_rows > 0 ) {
             while ( $recent = mysqli_fetch_assoc( $getRecents ) ) {
               $bposts[] = $recent;
             }
          }
          if ( !empty( $bposts ) ) {
            foreach ($bposts as $post) { ?>
              <a href="<?php _show_( $post['h_link'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px"><?php _show_( $post['h_alias'] ); ?></span></a><?php 
            } 
          } ?>
          </div><?php
	}
}
 ?>