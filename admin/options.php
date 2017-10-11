<?php
session_start();
require_once( '../init.php' );

addSetting( "general", array( $hOpt, "general" ), array() );
addSetting( "types", array( $hOpt, "types"), array() );
addSetting( "social", array( $hOpt, "social" ), array() );
addSetting( "color", array( $hOpt, "colors" ), array() );
addSetting( "editor", array( $hOpt, "editor" ), array() );
addSetting( "restful", array( $hOpt, "rest" ), array() );
addSetting( "misc", array( $hOpt, "misc" ), array() );

if ( isset( $_POST['settings'] ) ) {
    foreach ($GLOBALS['GSettingsField'][$_POST['settings']] as $name => $value) {
        $date = date( "Y-m-d" );
        if ( !isOption( $name ) ) {
            $hOpt -> create ( ucwords( $name ), $name, $_POST[$name], $date );
        } else {
            $hOpt -> update ( $name, $_POST[$name], $date );
        }
    }
}

if ( isset( $_POST['mystyle'] ) ) {
    $theme = $_POST['theme'];
    $GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."users SET style = '".$theme."' WHERE id = '". $_SESSION[JBLSALT.'Code'] ."'" );
}

if ( isset( $_POST['preferences'] ) ) {
    $date = date('Y-m-d' );
    $uploads = _ABSUP_.date('Y' ).'/'.date('m' ).'/'.date('d' )."/";

    if ( !empty( $_FILES['newheaderlogo'] ) ) {
        $headerlogo = $uploads . basename( $_FILES['newheaderlogo']['name'] );
        if ( !move_uploaded_file( $_FILES['newheaderlogo']["tmp_name"], $headerlogo ) ) {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $header_logo = $_POST['headerlogo'];
    }

    if ( !empty( $_FILES['newhomelogo'] ) ) {
        $homelogo = $uploads . basename( $_FILES['newhomelogo']['name'] );
        if ( !move_uploaded_file( $_FILES['newhomelogo']["tmp_name"], $homelogo ) ) {
            echo "Sorry, there was an error uploading your file.";
        }

        $home_logo = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['newhomelogo']['name'];
    } else {
        $home_logo = $_POST['homelogo'];
    }

    if ( !empty( $_FILES['newfavicon'] ) ) {
        $favicon = $uploads . basename( $_FILES['newfavicon']['name'] );
        if ( !move_uploaded_file( $_FILES['newfavicon']["tmp_name"], $headerlogo ) ) {
            echo "Sorry, there was an error uploading your file.";
        }
        $favicon = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['newfavicon']['name'];
    } else {
        $favicon = $_POST['favicon'];
    }


    $hOpt -> update ( 'name', $_POST['name'], $date );
    $hOpt -> update ( 'description', $_POST['description'], $date );
    $hOpt -> update ( 'language', $_POST['language'], $date );
    $hOpt -> update ( 'charset', $_POST['charset'], $date );
    $hOpt -> update ( 'email', $_POST['email'], $date );
    $hOpt -> update ( 'phone', $_POST['phone'], $date );
    $hOpt -> update ( 'copyright', $_POST['copyright'], $date );
    $hOpt -> update ( 'attribution', $_POST['attribution'], $date );
    $hOpt -> update ( 'attribution_link', $_POST['attribution_link'], $date );
    $hOpt -> update ( 'headerlogo', $header_logo, $date );
    $hOpt -> update ( 'homelogo', $home_logo, $date );
    $hOpt -> update ( 'favicon', $favicon, $date );
    $hOpt -> update ( 'registration', $_POST['registration'], $date );
    $hOpt -> update ( 'timezone', $_POST['timezone'], $date );
    $hOpt -> update ( 'country', $_POST['country'], $date );
    $hOpt -> update ( 'region', $_POST['region'], $date );
    $hOpt -> update ( 'city', $_POST['city'], $date );
}

if ( isset( $_POST['utype'] ) ) {
    $date = date('Y-m-d' );
    $hUserType = new Jabali\Classes\Options();

    $type = $_POST['utype'];
    $level = $_POST['ulevel'];

    $utype = array_combine( $type, $level );
    $utype = json_encode( $utype );

    $hUserType -> update ( 'usertypes', $utype, $date );
}

if ( isset( $_POST['ptype'] ) ) {
    $date = date('Y-m-d' );
    $hUserType = new Jabali\Classes\Options();

    $type = $_POST['ptype'];
    $level = $_POST['plevel'];

    $utype = array_combine( $type, $level );
    $utype = json_encode( $utype );

    $hUserType -> update ( 'posttypes', $utype, $date );
}

if ( isset( $_POST['social'] ) ) {
    $name = $_POST['network'];
    $link = $_POST['link'];

    $social = array_combine( $name, $link );
    $social = json_encode( $social );

    $hSocial = new Jabali\Classes\Options();
    $hSocial -> update ( 'social', $social, date('Y-m-d') );
}

require_once( 'header.php' ); ?>
    <div class="mdl-grid" ><?php
        if ( isset( $_GET['settings'] )) {
            doSetting( $_GET['settings'] );
        } elseif ( isset( $_GET['options'] )) {
            renderSettingsForm( $_GET['options'] );
        } ?>
    </div><?php
require_once( 'footer.php' );
