<?php 
/**
* Social Sharing & icons
*/

namespace Jabali\Classes;

class Widgets {

  	function dashRecents() { ?>
		  <div class="mdl-card__supporting-text" id="recents" draggable="true" ondragstart="dragStartH(event);" ondrop="dropH(event);" ondragover="dragOverH();" >
		    <h4>Recently Published</h4><?php 
		  $getRecents = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts ORDER BY created ASC LIMIT 6" );
		  if ( $getRecents -> num_rows > 0 ) {
		     while ( $recent = mysqli_fetch_assoc( $getRecents ) ) {
		       $posts[] = $recent;
		     }
		  }
		  if ( !empty( $posts ) ) {
		    foreach ($posts as $post) { ?>
		      <a href="<?php _show_( _ROOT.$post['link'] ); ?>" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">keyboard_arrow_right</i><span style="padding-left: 20px"><?php _show_( $post['name'] ); ?></span></a><?php 
		    } 
		  } ?>
		  </div>
		  <div class="mdl-card__menu">
		        <a href="./posts?view=list&type=article" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">open_in_new</i></a>
		  </div><?php
	}

  	function dashDrafts() { ?>
	    <div class="mdl-card__supporting-text" id="drafts" draggable="true" ondragstart="dragStartH(event);" ondragstart="dragStartH(event);" ondrop="dropH(event);" ondragover="dragOverH();"  >
		    <h3>Add New Draft</h3>
	    <form enctype="multipart/form-data" name="registerUser" method="POST" action="./index?page=dash">

	    <div class="input-field">
	    <i class="material-icons prefix">label</i>
	    <input id="name" name="name" type="text">
	    <label for="name">Title</label>
	    </div>

	    <div class="input-field">
	    <i class="material-icons prefix">description</i>
	    <textarea class="materialize-textarea col s12" rows="5" id="details" name="details" ></textarea>
	    <label for="details">Content</label>
	    </div>


	    <p><b><strong>Recent Drafts</strong></b></p>
	    <div class="mdl-grid">
	      <div class="mdl-cell mdl-cell--8-col">
	      	<?php global $hPost;
	        $hPost -> dashDrafts(); ?>
	      </div>
	      <div class="mdl-cell mdl-cell--4-col">
	        <button type="submit" name="draft" class="mdl-button mdl-button--fab mdl-button--colored alignright"><i class="material-icons">save</i></button>
	      </div>
	    </div>

	    </form>
	    </div>
		  <div class="mdl-card__menu">
	                <i class="material-icons">create</i>
		  </div><?php
	}

  	function quickLinks() { ?>
		<div class="mdl-card__supporting-text" id="quickLinks" draggable="true" ondragstart="dragStartH(event);" ondragstart="dragStartH(event);" ondrop="dropH(event);" ondragover="dragOverH();"  >
		    <h3>Quick Links</h3>
			<a href="<?php _show_(  'users?edit='. $_SESSION[JBLSALT.'Code'] .'&key='.$_SESSION[JBLSALT.'Alias'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">Edit Your Account</span></a>  
			<a href="options?settings=color" class="mdl-list__item"><i class="mdi mdi-palette mdl-list__item-icon"></i><span style="padding-left: 20px">Change Theme</span></a>  
			<a href="options?settings=general" class="mdl-list__item"><i class="mdi mdi-settings mdl-list__item-icon"></i><span style="padding-left: 20px">General Settings</span></a>  
			<a href="options?settings=user" class="mdl-list__item"><i class="mdi mdi-account-settings mdl-list__item-icon"></i><span style="padding-left: 20px">User Settings</span></a>  
			<a href="posts?create=page" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">New Page</span></a>  
			<a href="posts?create=article" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">New Article</span></a>  
		</div><?php
	}

	function stats(){ ?>
            <div class="mdl-card__supporting-text" id="stats" draggable="true" ondragstart="dragStartH(event);" ondragstart="dragStartH(event);" ondrop="dropH(event);" ondragover="dragOverH();"  ><?php
	$dataPoints = array();
	$y = 40;
	for($i = 0; $i < 10000; $i++){
		$y += rand(0, 10) - 5; 
		array_push($dataPoints, array("x" => $i, "y" => $y));
	}
?>
<div id="chartContainer"></div>
<script type="text/javascript">
$(function () {
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "theme2",
	zoomEnabled: true,
	animationEnabled: true,
	title: {
		text: "Performance Demo - 10000 DataPoints"
	},
	subtitles:[
		{   text: "(Try Zooming & Panning)" }
	],
	data: [
	{
		type: "line",                
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}
	]
});
chart.render();
});
</script>
            </div><?php
	}

	function jabaliCentral() { ?>
          <div class="mdl-card__supporting-text" id="central" draggable="true" ondragstart="dragStartH(event);" ondragstart="dragStartH(event);" ondrop="dropH(event);" ondragover="dragOverH();" >
          <h3>Jabali Central</h3><?php 
          $getRecents = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts ORDER BY created ASC LIMIT 5" );
          if ( $getRecents -> num_rows > 0 ) {
             while ( $recent = mysqli_fetch_assoc( $getRecents ) ) {
               $bposts[] = $recent;
             }
          }
          if ( !empty( $bposts ) ) {
            foreach ($bposts as $post) { ?>
              <a href="<?php _show_( $post['link'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px"><?php _show_( $post['name'] ); ?></span></a><?php 
            } 
          } ?>
          </div><?php
	}
}
 ?>