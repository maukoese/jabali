<?php
/**
* Front Actions
*/

namespace Jabali\Classes;

class Renders 
{

	//Users
	function login( $provider ) {
		$theme = getOption( 'activetheme' );
		if ( file_exists( _ABSTHEMES_ . $theme . '/templates/login.php') ) {
			$themefile = _ABSTHEMES_ . $theme . '/templates/login.php';
		} elseif ( file_exists( _ABSTHEMES_ . $theme . '/templates/signin.php') ) {
			$themefile = _ABSTHEMES_ . $theme . '/templates/signin.php';
		} else {
			$themefile = "";
		}

		if ( $themefile !== "" ) {
			getHeader();
			require_once ( $themefile );
			getFooter();
		} else {
			theHeader();
			if ( $provider == "jabali" || empty( $provider ) ) { ?>
				  	<title>Sign In <?php if( isset( $_GET['alert'] )){ echo( ucfirst( $_GET['alert'] ) ); } ?> - <?php showOption( 'name' ); ?></title><?php
				  	renderView( 'login' );
			} elseif ( $provider == "facebook" || $provider == "twitter" || $provider == "github" || $provider == "google" ) { ?>
			  	<title>Sign In - <?php showOption( 'name' ); ?></title><?php
			  	include 'app/lib/hybridauth/config.php';
			  	require_once( 'app/lib/hybridauth/Hybrid/Auth.php' );
				try {
			    $hybridauth = new \Hybrid_Auth( $config );
			    $authProvider = $hybridauth -> authenticate( $provider );
			    $user_profile = $authProvider -> getUserProfile();
				    if ( $user_profile && isset( $user_profile->identifier ) ) {
				        echo "<b>Name</b> :".$user_profile->displayName."<br>";
				        echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
				        echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
				        echo "<img src='".$user_profile->photoURL."'/><br>";
				        echo "<b>Email</b> :".$user_profile->email."<br>";
				        echo "<br> <a href='logout.php'>Logout</a>";
				    }
			    }

			    catch( Exception $e ) {
			        switch( $e->getCode() )
			        {
			                case 0 : echo "Unspecified error."; break;
			                case 1 : echo "Hybridauth configuration error."; break;
			                case 2 : echo "Provider not properly configured."; break;
			                case 3 : echo "Unknown or disabled provider."; break;
			                case 4 : echo "Missing provider application credentials."; break;
			                case 5 : echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
			                         break;
			                case 6 : echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
			                         $authProvider->logout();
			                         break;
			                case 7 : echo "User not connected to the provider.";
			                         $authProvider->logout();
			                         break;
			                case 8 : echo "Provider does not support this feature."; break;
			        }

			        echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

			        echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
			    }
			} else { ?>
				<title>Sign In <?php if( isset( $_GET['alert'] )){ echo( ucfirst( $_GET['alert'] ) ); } ?> - <?php showOption( 'name' ); ?></title><?php
					renderView( 'login' );
				  }
			theFooter();
		}
	}

	function register( $type ){ ?>
		<title><?php echo( ucwords( $type ) ); ?> Sign Up - <?php showOption( 'name' ); ?></title><?php

		$theme = getOption( 'activetheme' );
		if ( file_exists( _ABSTHEMES_ . $theme . '/templates/signup.php') ) {
			$themefile = _ABSTHEMES_ . $theme . '/templates/signup.php';
		} elseif ( file_exists( _ABSTHEMES_ . $theme . '/templates/register.php') ) {
			$themefile = _ABSTHEMES_ . $theme . '/templates/register.php';
		} else {
			$themefile = "";
		}

		if ( $themefile !== "" ) {
			getHeader();
			require_once ( $themefile );
			getFooter();
		} else {
			theHeader();
			if ( isset( $_GET['register'] ) && $_GET['email'] !== "") {
				if ( emailExists( $_GET['email'] ) ) {
					header("Location: ./register?create=exists");
				} else {
					renderView( 'signup' );
				}
			} elseif (isset( $_GET['confirm'] ) && $_GET['key'] !== "" ) {
				$USERS -> confirmUser( $_GET['confirm'], $_GET['key'] );
			} else {
				renderView( 'checkmail' );
			}
			theFooter();
		}
	}

	function forgot() { ?>
	  	<title>Forgot Password - <?php showOption( 'name' ); ?></title>
		<?php
		$theme = getOption( 'activetheme' );
		if ( file_exists( _ABSTHEMES_ . $theme . '/templates/forgot.php') ) {
			getHeader();
			require_once( _ABSTHEMES_ . $theme . '/templates/forgot.php' );
			getFooter();
		} else {
			theHeader();
			renderView( 'forgot' );
			theFooter();
		}
	}

	function reset( $id, $key ){
	    $theUser = $GLOBALS['JBLDB'] -> select( 'users', array( 'id', 'authkey' ), array( 'id' => $id ));
	    if ( !isset( $theUser['error'] ) ) {
	      while ( $thisuser = $GLOBALS['JBLDB'] -> fetchArray( $theUser) ) {
	        $user[] = $thisuser;
	      }

	    if ( !empty( $user) && $user[0]['authkey'] = $_GET['key'] ) { ?>
	      	<title>Reset Password - <?php showOption( 'name' ); ?></title><?php
	    	$theme = getOption( 'activetheme' );
			if ( file_exists( _ABSTHEMES_ . $theme . '/templates/reset.php') ) {
				getHeader();
				require_once( _ABSTHEMES_ . $theme . '/templates/reset.php' );
				getFooter();
			} else {
				theHeader();
				renderView( 'forgot' );
				theFooter();
			}
	    }
	  }
	}

	//Posts

	function postTypes() {
		$getTypes = $GLOBALS['JBLDB'] -> query( "SELECT DISTINCT ilk FROM ". _DBPREFIX ."posts");
		$types = $GLOBALS['JBLDB'] -> fetchArray( $getTypes );
		return $types;
	}

	function fetchPosts( $slug ) {
		if ( getOption( 'postspage' ) == $slug ) {
			$this -> blog();
		} else {

			if ( is_numeric( $slug ) ) {
				$posty = $GLOBALS['POSTS'] -> getId( $slug );
			} else {
				$posty = $GLOBALS['POSTS'] -> getPost( $slug );
			}
			$GLOBALS['gpost'] = $posty;
			$post = (object)$posty;

			if ( !isset( $posty['error'] ) ) {
				if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/'.$post -> template .'.php' ) ) {
					require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/'.$post -> template .'.php' );
				} else {
					require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/post.php' );
				}
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		}
	}

	function blog() {
		$postsy = $GLOBALS['POSTS'] -> sweep();
		$posts = array();
		foreach ($postsy as $post) {
			array_push( $posts, (object)$post );
		}
		if ( !isset( $posts['error'] ) ) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
		}
	}

	function authors( $author ) { ?>
		<title>Author : @<?php echo( $author ); ?> - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['JBLDB'] -> select( 'posts', '*', array( 'state' => 'published', 'ilk' => 'article', 'author' => $author ), array( 'created', 'DESC') );
		if ( !isset( $post['error'] ) ) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
		}
	}

	function category( $category ) { ?>
		<title>Category : <?php echo( ucwords( $category ) ); ?> - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE state = 'published' AND ilk = 'article' AND categories LIKE '%".$category."%' ORDER BY created DESC" );
		if ( $posts && count( $posts ) > 0) {
			//$GLOBALS['gposts'] = (array)$posts;
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
		}
	}

	function portfolio( $elements ) {

		if ( empty( $elements[0] )) { ?>
			<title>Portfolio - <?php showOption( 'name' ); ?></title><?php
			$posts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ( state = 'published' AND ilk = 'project' ) ORDER BY created DESC" );
			if ( count( $posts ) > 0) {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		} elseif ( $elements[0] == "categories" ) { ?>
			<title>Category : <?php echo( ucwords( $elements[1] ) ); ?> - <?php showOption( 'name' ); ?></title><?php
			$posts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ( state = 'published' AND ilk = 'project' AND category LIKE '%".$elements[1]."%' ) ORDER BY created DESC" );
			if ( count( $posts ) > 0) {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		} elseif ( $elements[0] == "clients" ) { ?>
			<title>Category : <?php echo( ucwords( $elements[1] ) ); ?> - <?php showOption( 'name' ); ?></title><?php
			$posts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE ( state = 'published' AND ilk = 'client' AND username LIKE '".$elements[1]."' ) ORDER BY created DESC" );
			if ( count( $posts ) > 0) {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		} elseif ( $elements[0] == "projects" ) {
			$posts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ( state = 'published' AND ilk = 'project' AND slug LIKE '".$elements[1]."' ) ORDER BY created DESC" );
			if ( count( $posts ) > 0) {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/post.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		} else { ?>
			<title>Portfolio Project - <?php showOption( 'name' ); ?></title><?php
			$posts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ( state = 'published' AND ilk = 'project' ) ORDER BY created DESC" );
			if ( count( $posts ) > 0 ) {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		}
	}

	function tag( $tag ) { ?>
		<title>Tag : <?php echo( ucwords( $tag ) ); ?> - <?php showOption( 'name' ); ?></title><?php
		$posts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ( state = 'published' AND ilk = 'article' AND tags LIKE '%".$tag."%' ) ORDER BY created DESC" );
		if ( count( $posts ) > 0) {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/archive.php' );
		} else {
			require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
		}
	}

	function users( $profile ) {
		if ( $profile == 'all' || $profile == "" ) { ?>
			<title>All Users - <?php showOption( 'name' ); ?></title><?php
			$getProfiles = $GLOBALS['USERS'] -> getState( 'active' );
			if ( $getProfiles -> num_rows > 0) {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/users.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		} else {
			if ( is_numeric( $profile ) ) {
				$getProfile = $GLOBALS['USERS'] -> getId ( $profile );
			} else {
				$getProfile = $GLOBALS['USERS'] -> getUser ( $profile );
			}

			if ( !isset( $getProfile['error'] ) ) {
				$user = (object)$getProfile;
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/profile.php' );
			} else {
				require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
			}
		}
	}
}
