<?php

class _hUsers {
  var $h_alias; 
  var $h_author; 
  var $h_avatar; 
  var $h_category; 
  var $h_center; 
  var $h_code; 
  var $h_created; 
  var $h_custom; 
  var $h_desc; 
  var $h_email; 
  var $h_fav; 
  var $h_key; 
  var $h_level; 
  var $h_link; 
  var $h_location; 
  var $h_notes; 
  var $h_phone; 
  var $h_reading; 
  var $h_status; 
  var $h_style; 
  var $h_subtitle; 
  var $h_tags; 
  var $h_text; 
  var $h_type; 
  var $h_updated;


  function loginUser() {
  $user = $_POST['user'];
  $password = $_POST['password'];

  $conn = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );
  $sql = 'SELECT * FROM hUsers WHERE h_email='.$user.'';//OR h_username= '..$user.'';
    $result = mysqli_query($conn, $sql);
    if( $result->num_rows > 0 ) {
      while ($row = mysqli_fetch_assoc($result)) {

        if ($password = $row['h_password']) {
          $_SESSION['myAlias'] = $row['h_alias'];
          $_SESSION['myUsername'] = $row['h_username'];
          $_SESSION['myCode'] = $row['h_code'];
          $_SESSION['myEmail'] = $row['h_email'];
          $_SESSION['myCenter'] = $row['h_center'];
          $_SESSION['myCap'] = $row['h_cap'];
          $_SESSION['myLocation'] = $row['h_location'];
          $_SESSION['myAvatar'] = $row['h_avatar'];

          header('Location: ./portal/user?view='.$_SESSION['myCode'].'');
          exit();

        } else {
          echo "Wrong Password";
        }
      }

    } else {
      echo '<div>
      <p>User Does not exist</p>
      </div>';
    }
 }
  
 function emailUser($email, $subject, $key) {
   if($subject == "create") { 
      error_reporting(-1);

      $name = $_POST['name']; 
      $submit_links = $_POST['submit_links']; 

      if(isset($_POST['submit']))
      {
      $from_add = hEMAIL; 
      $to_add = "ben@webdesignrepo.com"; 
      $subject = "Your Subject Name";
      $message = "Name:$name \n Sites: $submit_links";

      $headers = 'From: submit@webdesignrepo.com' . "\r\n" .
      'Reply-To: ben@webdesignrepo.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

      if(mail($to_add,$subject,$message,$headers)) 
      {
          $msg = "Mail sent";

      echo $msg;

      } 
      }
   } elseif($subject == "confirm") {
   } elseif($subject == "forgot") {
   } elseif($subject == "reset") {
   }
 }
  
  function createUser() {

    $date = date("YmdHms");
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5($email.$date));
    $abbr = substr($_POST['lname'], 0,2);

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr($hash, 20);
    $h_avatar = $_POST['h_avatar'];
    $h_center = $_POST['h_center'];
    $h_code = substr($hash, 20);
    $h_created = date('Ymd');
    $h_email = $_POST['h_email'];
    $h_gender = $_POST['h_gender'];
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."user?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account created on ".$date;
    $h_password = md5($_POST['h_password']);
    $h_phone = $_POST['h_phone'];
    $h_status = "active"; //Sort emailuser();, Change to "pending"
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_username = strtolower($_POST['fname'].$abbr);

    if (mysqli_query($GLOBALS['conn'], "INSERT INTO husers (h_alias, h_author, h_avatar, h_center, h_code, h_created, h_email, h_gender, h_key, h_level, h_link, h_location, h_notes, h_password, h_phone, h_status, h_style, h_type, h_username) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_email."', '".$h_gender."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_password."', '".$h_phone."', '".$h_status."', '".$h_style."', '".$h_type."', '".$h_username."')")) {
      echo "<script type = \"text/javascript\">
                      alert(\"User Created Successfully!\");
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 

  }

  function updateUser($h_code) {
    
    $date = date("YmdHms");
    $email = $_SESSION['myEmail'];

    $hash = str_shuffle(md5($email.$date));
    $abbr = substr($_POST['lname'], 0,2);

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr($hash, 20);
    $h_avatar = $_POST['h_avatar'];
    $h_center = $_POST['h_center'];
    $h_code = substr($hash, 20);
    $h_created = date('Ymd');
    $h_description = $_POST['h_description'];
    $h_email = $_POST['h_email'];
    $h_gender = strtolower($_POST['h_gender']);
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."user?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account updated on ".$date;
    $h_password = md5($_POST['h_password']);
    $h_phone = $_POST['h_phone'];
    $h_status = "active"; //Sort emailuser();, Change to "pending"
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_username = strtolower($_POST['fname'].$abbr);

    if (mysqli_query($GLOBALS['conn'], "UPDATE husers SET h_alias = '".$h_alias."', h_author = '".$h_author."', h_avatar = '".$h_avatar."', h_center = '".$h_center."', h_code = '".$h_code."', h_created = '".$h_created."', h_description = '".$h_description."', h_email = '".$h_email."', h_gender = '".$h_gender."', h_key = '".$h_key."', h_level = '".$h_level."', h_link = '".$h_link."', h_location = '".$h_location."', h_notes = '".$h_notes."', h_password = '".$h_password."', h_phone = '".$h_phone."', h_type = '".$h_type."' WHERE h_code = '".$h_code."'")) {
      echo "<script type = \"text/javascript\">
                      alert(\"User Updated Successfully!\");
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   

    $updateUser = mysqli_query($GLOBALS['conn'], " h_var='".$h_var."', h_var='".$h_var."' WHERE h_code='".$h_code."'");

  }

  
  function deleteUser($h_code) {
    
    $deleteUser = mysqli_query($GLOBALS['conn'], "DELETE FROM husers WHERE h_code='".$h_code."'");
    if (!$createUser ->conn_error) {
      echo '<div><p>User Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteUser ->conn_error.'</div>';
    }
  }

  function getUsersType($type) { ?>
  <title><?php show( ucfirst($type) ); ?>s List [ <?php getOption('name'); ?> ]</title><?php
    $getUsersBy = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' AND h_type='".$type."'");
    if($getUsersBy -> num_rows > 0) {
      ?>
      <a href="./user?create=<?php show( $type ); ?>" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">create</i></a>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php show( ucfirst($type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php
      while ($usersDetails = mysqli_fetch_assoc($getUsersBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( ucwords($usersDetails['h_location']) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php show( $usersDetails['h_code'] ); ?>&key=<?php show( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php show( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php show( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./user?edit=<?php show( $usersDetails['h_code'] ); ?>&key=<?php show( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./user?delete=<?php show( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php
      } ?>
      </table>
      </div>
      </div><?php
    } else {
        echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <td><p>No '.ucfirst($type).'s Found</p></td>
        </tr>
        </tbody>';
         echo '
        </table>
        </div>';
    }
  }

  function getUsers() {
      ?><title>All Users [ <?php getOption('name'); ?> ]</title><?php
    $getUsers = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_status = 'active' ORDER BY h_created DESC");

    if($getUsers -> num_rows > 0) {
      ?>
      <a href="./user?create=patient" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">create</i></a>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php show( "User" ); ?>">
            </div></center>
            </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php
      while ($usersDetails = mysqli_fetch_assoc($getUsers)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_username'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( $usersDetails['h_center'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php show( ucwords($usersDetails['h_location']) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./user?view=<?php show( $usersDetails['h_code'] ); ?>&key=<?php show( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">account_circle</i></a> 
        <a href="tel:<?php show( $usersDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php show( $_SESSION['myCode'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./user?edit=<?php show( $usersDetails['h_code'] ); ?>&key=<?php show( $usersDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./user?delete=<?php show( $usersDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php
      } ?>
      </table>
      </div>
      </div>
      <?php    } else {
      echo '<div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">USERNAME</th>
        <th class="mdl-data-table__cell--non-numeric">EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">CENTER</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>';
        echo '
        <tbody>
        <tr>
        <p>No Users Found</p>
        </tr>
        </tbody>';
         echo '
        </table></div></div>';
    }
  }

  function getUserCode($code) {
    $getUserCode = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$code."'");
    if($getUserCode -> num_rows > 0) {
      while ($userDetails = mysqli_fetch_assoc($getUserCode)){
        if ($_SESSION['myCode'] !== $userDetails['h_code']) {
          $name = explode(" ", $userDetails['h_alias']);
          $greettype = 'Contact Details';
        } else {
          $name = explode(" ", $userDetails['h_alias']);
          $greettype = '<b>Hello,</b> '.ucfirst($name[0]);
        }
        ?><title><?php show( $userDetails['h_alias'] ); ?> [ <?php getOption('name'); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor( $_SESSION['myCode']); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php show( ucfirst($userDetails['h_alias']) ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a href="./user?view=<?php show( $userDetails['h_code'] ); ?>&fav=<?php show( $userDetails['h_code'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">favorite</a>
                                <a href="./user?edit=<?php show( $userDetails['h_code'] ); ?>&key=<?php show( $userDetails['h_alias'] ); ?>" ><i class="material-icons">edit</i></a>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <h5><?php show ( $greettype ); ?>
                              <i class="mdi mdi-gender-<?php 
                                if ($userDetails['h_gender'] == "male") {
                                  echo "male";
                                } elseif ($userDetails['h_gender'] == "female") {
                                  echo "female";
                                } else {
                                  echo "transgender";
                                } ?> mdl-button-icon mdl-badge mdl-badge--overlap alignright">
                              </i>
                            <h5>
                            <h6><b>Email:</b> <a href="mailto:<?php show( $userDetails['h_email'] ); ?>"><?php show( $userDetails['h_email'] ); ?></a><br>
                            <b>Center:</b> <a href="./resource?center=<?php show( $userDetails['h_center'] ); ?>"><?php show( $userDetails['h_center'] ); ?></a><br>
                            <b>Location:</b> <a href="./resource?location=<?php show( $userDetails['h_location'] ); ?>"><?php show( ucwords($userDetails['h_location']) ); ?></a><br>
                            <b>Phone:</b> <a href="tel:<?php show( $userDetails['h_phone'] ); ?>"><?php show( $userDetails['h_phone'] ); ?></a><br>
                            <b>Expertise: </b><?php show( $userDetails['h_type'] ); ?></h6>
                            <a href="tel:<?php show( $userDetails['h_phone'] ); ?>"><i class="material-icons">phone</i></a>
                            <a href="mailto:<?php show( $userDetails['h_email'] ); ?>"><i class="material-icons">mail_outline</i></a>
                            <a href="./message?create=message"><i class="material-icons">message</i></a>
                            <a href="./message?create=chat"><i class="material-icons">forum</i></a>
                            <a href="./notification?create=note"><i class="material-icons">notifications</i></a>
                            
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <img src="<?php show( $userDetails['h_avatar'] ); ?>" width="100%">
                          </div>
                          <div class="mdl-cell mdl-cell--12-col">
                          <div><?php show( $userDetails['h_description'] ); ?></div></div>
                          <div><h6><b>Joined:</b> <?php show( $userDetails['h_created'] ); ?></h6></div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">local_hospital</i>
                          <span class="mdl-button"><?php show( $userDetails['h_center'] ); ?></span>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">person_pin_circle</i>
                                <?php show( $userDetails['h_location'] ); ?>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        <ul class="collapsible popout" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header active"><i class="material-icons">message</i>Messages from <?php show( $name[0] ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">comment</i>Messages to <?php show( ucfirst($name[0]) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">chat_bubble</i>Chat with <?php show( ucfirst($name[0]) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">description</i>Articles by <?php show( ucfirst($name[0]) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                      </ul>
                        </div>
                    </div>
                </div>

                </div><?php
      }
    } else {
      echo 'User Not Found';
    }
  }
 
}
