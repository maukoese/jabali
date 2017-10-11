<?php 


namespace Jabali\Classes;

class Users {
  
 function emailUser( $email, $subject, $key) {
   if ( $subject == "create" ) { 
      error_reporting(-1 );

      $name = $_POST['name']; 
      $submit_links = $_POST['submit_links']; 

      if ( isset( $_POST['submit'] ))
      {
      $from_add = hEMAIL; 
      $to_add = "ben@webdesignrepo.com"; 
      $subject = "Your Subject Name";
      $message = "Name:$name \n Sites: $submit_links";

      $headers = 'From: submit@webdesignrepo.com' . "\r\n" .
      'Reply-To: ben@webdesignrepo.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

      if ( mail( $to_add,$subject,$message,$headers)) 
      {
          $msg = "Mail sent";

      echo $msg;

      } 
      }
   } elseif ( $subject == "confirm" ) {
   } elseif ( $subject == "forgot" ) {
   } elseif ( $subject == "reset" ) {
   }
 }
  
  function createUser() {

    $date = date( "YmdHms" );
    $email = $_SESSION[JBLSALT.'Email'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,3 );

    $name = $_POST['fname'].' '.$_POST['lname'];
    $author = substr( $hash, 20 );
    
    if ( $_FILES['avatar'] == "" ) {
      $avatar = _IMAGES.'avatar.svg';
    } else {
      $uploads = _ABSUP_.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';
      $upload = $uploads . basename( $_FILES['avatar']['name'] );

      if ( file_exists( $upload) ) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }

      if ( move_uploaded_file( $_FILES['avatar']["tmp_name"], $upload) ) {
          //Do nothing
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
      $avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['avatar']['name'];
    }

    $company = $GLOBALS['JBLDB'] -> clean( $_POST['company'] );
    $id = generateCode();
    $details = "";
    $created = date('Ymd' );
    $email  = $GLOBALS['JBLDB'] -> clean( $_POST['email'] );
    $gender = strtolower( $_POST['gender'] );
    $authkey = $hash;
    $level = $GLOBALS['JBLDB'] -> clean( $_POST['level'] );
    $link = _ADMIN."users?view=$id&key=$name";
    $location = strtolower( $_POST['location'] );
    $excerpt = "Account created on ".$date;
    $password = md5( $_POST['password'] );
    $phone = $GLOBALS['JBLDB'] -> clean( $_POST['phone'] );

    if ( !$_POST['state'] ) {
      $state = "pending";
    } else {
      $state = $_POST['state'];
    }
    $social = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}';
    $style = "zahra";
    $ilk = strtolower( $_POST['ilk'] );
    $username = strtolower( $_POST['fname'].$abbr );

    if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."users (name, author, avatar, company, id, created, details, email , gender, authkey, level, link, location, excerpt, password, phone, social, state, style, ilk, username) 
    VALUES ('".$name."', '".$author."', '".$avatar."', '".$company."', '".$id."', '".$created."', '".$details."', '".$email ."', '".$gender."', '".$authkey."', '".$level."', '".$link."', '".$location."', '".$excerpt."', '".$password."', '".$phone."', '".$social."', '".$state."', '".$style."', '".$ilk."', '".$username."' )" ) ) {
      echo "<script type = \"text/javascript\">
              alert(\"User Created Successfully!\" );
          </script>";
    } else {
        echo "Error: " . $GLOBALS['JBLDB'] -> error();
    } 

  }

  function updateUser( $code ) {
    
    $date = date( "YmdHms" );
    $email = $_SESSION[JBLSALT.'Email'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $name = $_POST['fname'].' '.$_POST['lname'];

    if ( !empty( $_FILES['avatar'] ) ) {

      $uploads = _ABSUP_.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';
      $upload = $uploads . basename( $_FILES['avatar']['name'] );
      move_uploaded_file( $_FILES['avatar']["tmp_name"], $upload );
      $avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['avatar']['name'];

    } else {
      $avatar = $_POST['avatar'];
    }
    $avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['avatar']['name'];

    $company = $GLOBALS['JBLDB'] -> clean( $_POST['company'] );
    $created = date('Ymd' );
    $details = $GLOBALS['JBLDB'] -> clean( $_POST['details'] );
    $email  = $_POST['email'];

    $gender = $GLOBALS['JBLDB'] -> clean( $_POST['gender'] );
    $gender = strtolower( $gender );

    $authkey = $hash;
    $level = $GLOBALS['JBLDB'] -> clean( $_POST['level'] );
    $link = _ADMIN."users?view=$id&key=$name";

    $location = $GLOBALS['JBLDB'] -> clean( $_POST['location'] );
    $location = strtolower( $location );

    $excerpt = "Account updated on ".$date;
    
    if ( $_POST['password'] !== "" ) {
      $password = md5( $_POST['password'] );
    } else {
      $password = $_POST['h_pass'];
    }

    $phone = $_POST['phone'];

    $h_fb = $GLOBALS['JBLDB'] -> clean( $_POST['facebook'] );
    $h_tw = $GLOBALS['JBLDB'] -> clean( $_POST['twitter'] );
    $h_ig = $GLOBALS['JBLDB'] -> clean( $_POST['instagram'] );
    $h_git = $GLOBALS['JBLDB'] -> clean( $_POST['github'] );
    $social = array('facebook' => $h_fb, 'twitter' => $h_tw, 'instagram' => $h_ig, 'github' => $h_git);
    $social = json_encode( $social );

    $ilk = $_POST['ilk'];
    $ilk = strtolower( $ilk );

    if ( $GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."users SET name = '".$name."', avatar = '".$avatar."', company = '".$company."', created = '".$created."', details = '".$details."', email  = '".$email ."', gender = '".$gender."', authkey = '".$authkey."', level = '".$level."', link = '".$link."', location = '".$location."', excerpt = '".$excerpt."', password = '".$password."', phone = '".$phone."', social ='".$social."', ilk = '".$ilk."' WHERE id = '".$code."'" ) ) {
      echo "<script type = \"text/javascript\">
              alert(\" $name Updated Successfully!\" );
          </script>";
    } else {
      echo '<script type = \"text/javascript\">
              alert(\"Error: "'.$GLOBALS['JBLDB']->error.'!\" );
          </script>';
    }

  }

  function deleteUser( $id) {
    
    $deleteUser = $GLOBALS['JBLDB'] -> query( "DELETE FROM ". _DBPREFIX ."users WHERE id='".$id."'" );
  }

  function getUsersType( $type) { ?>
    <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php showOption( 'name' ); ?> ]</title>
    <div class="mdl-cell mdl-cell--12-col"><?php 
    $getUsersBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE state = 'active' AND ilk='".$type."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="Username">
          <?php _show_( $usersDetails['username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Email">
          <?php _show_( $usersDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Phone">
          <?php _show_( $usersDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Location">
          <?php _show_( ucwords( $usersDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Actions">
        <a href="./users?view=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php _show_( $usersDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./users?edit=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./users?delete=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      <?php   } else { ?>
          <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
                <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
                <th class="mdl-data-table__cell--non-numeric">PHONE</th>
                <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
                <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <p>No <?php _show_( ucfirst( $type) ); ?>s Found</p>
                </td>
              </tr>
            </tbody>
          </table><?php 
    }
    ?></div><?php
  }

  function getUsersAuthor( $author) { ?>
    <title>Users List [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getUsersBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE state = 'active' AND author='".$author."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="Username">
          <?php _show_( $usersDetails['username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Email">
          <?php _show_( $usersDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Phone">
          <?php _show_( $usersDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Location">
          <?php _show_( ucwords( $usersDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="Actions">
        <a href="./users?view=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php _show_( $usersDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./users?edit=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./users?delete=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No <?php _show_( ucfirst( $type) ); ?>s Found</p>
          </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div><?php 
    }
  }

  function getUsersLoc( $location) { ?>
    <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getUsersBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE state = 'active' AND location='".$location."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">ORG</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['company'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( ucwords( $usersDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./users?view=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php _show_( $usersDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./users?edit=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./users?delete=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">ORG</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No <?php _show_( ucfirst( $type) ); ?>s Found In <?php _show_( ucfirst( $location) ); ?></p>
          </td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getUsersTypeLoc( $type, $location) { ?>
    <title><?php _show_( ucfirst( $type) ); ?>s List [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getUsersBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE state = 'active' AND location='".$location."'" );
    if ( $getUsersBy -> num_rows > 0) {
      ?>
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">ORG</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['company'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( ucwords( $usersDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./users?view=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php _show_( $usersDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./users?edit=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./users?delete=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">ORG</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No <?php _show_( ucfirst( $type) ); ?>s Found In <?php _show_( ucfirst( $location) ); ?></p>
          </td>
        </tr>
        </tbody>
        </table></div><?php 
    }
  }

  function getPendingUsers() { ?>
    <title>All Users [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getUsers = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE state = 'pending' ORDER BY created DESC" );

    if ( $getUsers -> num_rows > 0) { ?>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( "User" ); ?>">
            </div></center>
            </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsers)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( ucwords( $usersDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./users?view=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php _show_( $usersDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./users?edit=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./users?delete=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
        <a href="./users?activate=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">done</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <center><i class="material-icons">done_all</i> <p>No Pending Users Found</p></center>
          </td>
        </tr>
        </tbody>
        </table></div></div><?php 
    }
  }

  function getUsers() { ?>
    <title>All Users [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getUsers = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE state = 'active' ORDER BY created DESC" );

    if ( $getUsers -> num_rows > 0) { ?>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php _show_( "User" ); ?>">
            </div></center>
            </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?> mdl-card">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getUsers)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $usersDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( ucwords( $usersDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell">
        <a href="./users?view=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php _show_( $usersDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="#" id="<?php _show_( $usersDetails['id'] ); ?>" class="" ><i class="material-icons ">edit</i></a>
        <div id="editModal" class="modal">
          <div class="modal-content mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__title">
            <a href="./users?edit=<?php _show_( $usersDetails['id'] ); ?>&key=<?php _show_( $usersDetails['name'] ); ?>" class="material-icons mdl-button--icon">open_in_new</a>
            <span class="mdl-card__title-text">Edit <?php _show_( $usersDetails['name'] ); ?></span>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                  <span class="close">
                    <i class="material-icons">clear</i>
                  </span>
                  
              </div>
            </div>

            <div class="mdl-card__supporting-text">
              <form enctype="multipart/form-data" name="registerUser" method="POST" action="<?php _show_( _ADMIN.'users?view='.$usersDetails['id'].'&key='.$usersDetails['name'] ); ?>" >

                      <div class="input-field inline mdl-js-textfield getmdl-select">
                      <i class="material-icons prefix">donut_large</i>
                       <input class="mdl-textfield__input" id="ilk" name="ilk" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucfirst( $usersDetails['ilk'] ) ); ?>" value="<?php _show_( ucwords( $usersDetails['ilk'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk"><?php 
                           if ( $_SESSION[JBLSALT.'Cap'] == "admin" ) {
                            _show_( '<li class="mdl-menu__item" data-val="admin">Admin</li>' );
                           } ?>
                           <li class="mdl-menu__item" data-val="doctor">Doctor</li>
                           <li class="mdl-menu__item" data-val="center">Center</li>
                         </ul>
                      </div>

                      <div class="input-field inline">
                      <i class="material-icons prefix">phone</i>
                      <input  id="phone" name="phone" type="text" value="<?php _show_( $usersDetails['phone'] ); ?>">
                      <label for="phone" class="center-align">Phone Number</label>
                      </div>

                      <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">room</i>
                      <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $usersDetails['location'] ) ); ?>" value="<?php _show_( ucwords( $usersDetails['location'] ) ); ?>">
                      <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                          <?php 
                          $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                          $counties = explode( ", ", $county_list );
                          for ( $c=0; $c < count( $counties ); $c++) {
                              $label = ucwords( $counties[$c] );
                              echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                          }
                           ?>
                      </ul>
                      </div>

                      <div class="input-field">
                      <i class="material-icons prefix">label</i>
                      <input class="validate" id="name" name="name" type="text" value="<?php _show_( $usersDetails['name'] ); ?>">
                      <label for="name" class="center-align">Full Names</label>
                      </div>

                      <div class="input-field inline">
                      <i class="material-icons prefix">mail</i>
                      <input class="validate" id="email" name="email " type="email" value="<?php _show_( $usersDetails['email'] ); ?>">
                      <label for="email" class="center-align">Email Address</label>
                      </div>

                      <?php if ( $usersDetails['ilk'] !== "organization" ) { ?>
                      <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">business</i>
                      <input class="mdl-textfield__input" type="text" id="centers" name="company" readonly tabIndex="-1" placeholder="Change Center">
                      <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                          <?php 
                          $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, id FROM ". _DBPREFIX ."users WHERe ilk = 'center' ORDER BY name" );
                          if ( $centers -> num_rows > 0 );
                          while ( $center = mysqli_fetch_assoc( $centers) ) {
                              echo '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['name'].'</li>';
                          }
                           ?>
                      </ul>
                      </div><?php } ?>

                      <div class="input-field inline alignright">
                  <button class="mdl-button mdl-button--fab alignright" type="submit" name="update"><i class="material-icons">saves</i></button></div>

                  
        </form>
            </div>
          </div>

        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('editModal' );
        var a = document.getElementById( "<?php _show_( $usersDetails['id'] ); ?>" );
        var span = document.getElementsByClassName( "close" )[0];
        a.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if ( event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
        <a href="./users?delete=<?php _show_( $usersDetails['id'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else { ?>

        <div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">ORG</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p>No Users Found</p>
          </td>
        </tr>
        </tbody>
        </table></div></div><?php 
    }
  }

  function getCenters() {
    $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, id FROM ". _DBPREFIX ."users WHERe ilk = 'center' ORDER BY name" );
    if ( $centers -> num_rows > 0) {;
      while ( $center = mysqli_fetch_assoc( $centers) ) {
          echo '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['name'].'</li>';
      }
    }
      echo '<center>Your Organization Not Listed? <br><a href="./register?type=organization">Register it Now</a></center>';
  }

  function getUserCode( $code) {
    $getUserCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE id = '".$code."'" );
    if ( $getUserCode -> num_rows > 0) {
      while ( $userDetails = mysqli_fetch_assoc( $getUserCode)){
        if ( $_SESSION[JBLSALT.'Code'] !== $userDetails['id'] ) {
          $name = explode( " ", $userDetails['name'] );
          $greettype = 'About '.ucfirst( $name[0] );
        } else {
          $name = explode( " ", $userDetails['name'] );
          $greettype = '<b>Hello </b> '.ucfirst( $name[0] )."!";
        }
        ?><title><?php _show_( $userDetails['name'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--12-col-phone">
                            <h5><i class="mdi mdi-<?php 
                            if ( strtolower( $userDetails['ilk'] ) == "organization" ) { 
                                echo "city";
                            } else {
                                if ( strtolower( $userDetails['gender'] ) == "male" ) {
                                  echo "gender-male";
                                } elseif ( strtolower( $userDetails['gender'] ) == "female" ) {
                                  echo "gender-female";
                                } else {
                                  echo "transgender";
                                }
                            } ?> mdl-button-icon mdl-badge mdl-badge--overlap alignright">
                              </i>
                            <h5>
                            <h6><b>Email:</b> <a href="mailto:<?php _show_( $userDetails['email'] ); ?>"><?php _show_( $userDetails['email'] ); ?></a><br><?php if ( $userDetails['ilk'] !== "organization" ) { ?>
                            <b>Organization:</b> <a href="./resource?organization=<?php _show_( ucwords( $userDetails['company'] ) ); ?>"><?php _show_( $userDetails['company'] ); ?></a><br><?php } ?>
                            <b>Location:</b> <a href="./resource?location=<?php _show_( $userDetails['location'] ); ?>"><?php _show_( ucwords( $userDetails['location'] ) ); ?></a><br>
                            <b>Phone:</b> <a href="tel:<?php _show_( $userDetails['phone'] ); ?>"><?php _show_( $userDetails['phone'] ); ?></a></h6>
                            <a href="tel:<?php _show_( $userDetails['phone'] ); ?>"><i class="material-icons">phone</i></a>
                            <a href="mailto:<?php _show_( $userDetails['email'] ); ?>"><i class="material-icons">mail_outline</i></a>
                            <a href="./message?create=message&code=<?php _show_( $userDetails['id'] ); ?>"><i class="material-icons">message</i></a>
                            <a href="./message?chat=<?php _show_( $userDetails['id'] ); ?>"><i class="material-icons">forum</i></a>
                            
                          </div>
                          <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--12-col-phone mdl-grid">
                          <div class="mdl-cell mdl-cell--12-col">
                            <img src="<?php _show_( $userDetails['avatar'] ); ?>" width="100%">
                          </div>
                          <div class="mdl-cell mdl-cell--12-col">
                          <center><?php
                          $social = json_decode( $userDetails['social'] ); 
                          foreach ($social as $key => $value) { ?>
                          <div style="display: inline;">
                          <a href="<?php _show_( $value ); ?>" type="text" value="<?php _show_( $value ); ?>">
                          <i class="fa fa-<?php _show_( $key ); ?> fa-2x"></i></a>
                          </div><?php } ?>
                          </center>
                          </div>
                          </div>
                          <div class="mdl-cell mdl-cell--12-col">
                          <div><?php _show_( $userDetails['details'] ); ?></div></div>
                          <div><h6><b>Joined:</b> <?php _show_( $userDetails['created'] ); ?></h6></div>
                        </div>

                      <div class="mdl-card__menu"><?php if ( strtolower( $userDetails['ilk'] ) == "organization" ) { ?>
                          <a href="./resource?author=<?php _show_( $userDetails['id'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">business</a><?php } ?>
                          <a href="./users?view=<?php _show_( $userDetails['id'] ); ?>&key=<?php _show_( $userDetails['name'] ); ?>&fav=true" class="material-icons mdl-badge mdl-badge--overlap">favorite</a><?php 
                          if ( isCap( 'admin' ) || isProfile( $_SESSION[JBLSALT.'Code'] ) ) { ?>
                          <a href="./users?edit=<?php _show_( $userDetails['id'] ); ?>&key=<?php _show_( $userDetails['name'] ); ?>" ><i class="material-icons">edit</i></a><?php } ?>
                      </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><?php 
                          $getNotes = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments WHERE author = '".$userDetails['id']."'" );
                          if ( $getNotes && $getNotes -> num_rows > 0) { ?>
                            <div class="mdl-card__title">
                            <i class="material-icons">query_builder</i>
                              <span class="mdl-button">Recently From <?php _show_( ucfirst( $name[0] ) ); ?></span>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                              <a href="./message?chat=<?php _show_( $userDetails['id'] ); ?>" ><i class="material-icons">question_answer</i></a>
                            </div>
                            </div>
                            <div class="mdl-card__supporting-text">
                              <ul class="collapsible popout" data-collapsible="accordion"><?php 
                                  while ( $note = mysqli_fetch_assoc( $getNotes) ) { ?>
                                  <li>
                                    <div class="collapsible-header"><i class="material-icons">label_outline</i>
                                      
                                        <b><?php _show_( $note['name'] ); ?></b><span class="alignright"><?php 
                                        _show_( $note['created'] ); ?></span>
                                    </div>
                                    <div class="collapsible-body"><span class="alignright">
                                        <a href="./message?create=note&code=<?php _show_( $note['author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                        <a href="./message?view=<?php _show_( $note['id'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                        <a href="./message?delete=<?php _show_( $note['id'] ); ?>" ><i class="material-icons">delete</i></a>
                                        </span>
                                        <span><?php 
                                        _show_( $note['details'] ); ?></span>
                                    </div>
                                  </li><?php 
                                  } ?>
                            </ul>
                            </div><?
                          } else { ?>
                          <div class="mdl-card__title"><?php if( !isProfile( $_SESSION[JBLSALT.'Code'] ) ) { ?>
                            <div class="mdl-card__title-text">
                              <span><b>Contact </b><?php _show_( ucfirst( $name[0] ) ); ?></span>
                            </div>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                              <a href="./message?create=message&code=<?php _show_( $userDetails['id'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">message</a>
                            </div><?php } ?>
                          </div><?php 
                        }
                      ?>
                    </div>
                </div><?php 
      }
    } else {
      echo 'User Not Found';
    }
  }
 
}
