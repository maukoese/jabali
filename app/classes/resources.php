<?php 

namespace Jabali\Classes;

class Resources {
  var $name; 
  var $author; 
  var $avatar; 
  var $category; 
  var $company; 
  var $id; 
  var $created; 
  var $custom; 
  var $h_desc; 
  var $email ; 
  var $h_fav; 
  var $authkey; 
  var $level; 
  var $link; 
  var $location; 
  var $excerpt; 
  var $phone; 
  var $readings; 
  var $state; 
  var $style; 
  var $subtitle; 
  var $tags; 
  var $h_text; 
  var $ilk; 
  var $updated;
  
  function createResource() {

    $date = date( "YmdHms" );
    $email = $_SESSION[JBLSALT.'Email'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $name = $_POST['name'];
    $author = $_POST['author'];
    $avatar = $_POST['avatar'];
    $by = $_POST['by'];
    $company = $_POST['company'];
    $id = substr( $hash, 20 );
    $created = date('Ymd' );
    $email  = $_POST['email'];
    $authkey = $hash;
    $level = $_POST['level'];
    $link = _ADMIN."resource?view=$id";
    $location = strtolower( $_POST['location'] );
    $excerpt = "Account created on ".$date;
    $phone = $_POST['phone'];
    $state = "active";
    $ilk = strtolower( $_POST['ilk'] );

    if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."resources (name, by, author, avatar, company, id, created, email , authkey, level, link, location, excerpt, phone, state, ilk) 
    VALUES ('".$name."', '".$author."', '".$avatar."', '".$by."', '".$company."', '".$id."', '".$created."', '".$email ."', '".$authkey."', '".$level."', '".$link."', '".$location."', '".$excerpt."', '".$phone."', '".$state."', '".$ilk."' )" ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"Resource Created Successfully!\" );
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 

  }

  function updateResource( $id) {
    
    $date = date( "YmdHms" );
    $email = $_SESSION[JBLSALT.'Email'];

    $hash = str_shuffle(md5( $email.$date ) );
    $abbr = substr( $_POST['lname'], 0,2 );

    $name = $_POST['fname'].' '.$_POST['lname'];
    $author = substr( $hash, 20 );
    $avatar = $_POST['avatar'];
    $by = $_POST['by'];
    $company = $_POST['company'];
    $id = substr( $hash, 20 );
    $created = date('Ymd' );
    $details = $_POST['details'];
    $email  = $_POST['email'];
    $gender = strtolower( $_POST['gender'] );
    $authkey = $hash;
    $level = $_POST['level'];
    $link = _ADMIN."resource?view=$id";
    $location = strtolower( $_POST['location'] );
    $excerpt = "Account updated on ".$date;
    $password = md5( $_POST['password'] );
    $phone = $_POST['phone'];
    $state = "active"; //Sort emailresource();, Change to "pending"
    $style = "zahra";
    $ilk = strtolower( $_POST['ilk'] );
    $h_resourcename = strtolower( $_POST['fname'].$abbr );

    if ( $GLOBALS['JBLDB'] -> query( "UPDATE hresources SET name = '".$name."', author = '".$author."', avatar = '".$avatar."', company = '".$company."', id = '".$id."', created = '".$created."', details = '".$details."', email  = '".$email ."', gender = '".$gender."', authkey = '".$authkey."', level = '".$level."', link = '".$link."', location = '".$location."', excerpt = '".$excerpt."', password = '".$password."', phone = '".$phone."', ilk = '".$ilk."' WHERE id = '".$id."'" ) ) {
      echo "<script type = \"text/javascript\">
                      alert(\"Resource Updated Successfully!\" );
                  </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   

    $updateResource = $GLOBALS['JBLDB'] -> query( " h_var='".$h_var."', h_var='".$h_var."' WHERE id='".$id."'" );

  }

  
  function deleteResource( $id) {
    
    $deleteResource = $GLOBALS['JBLDB'] -> query( "DELETE FROM ". _DBPREFIX ."resources WHERE id='".$id."'" );
    if ( !$createResource ->conn_error) {
      echo '<div><p>Resource Created Successfuly!</p></div>';
    } else {
      echo '<div><p>Error!</p>'.$deleteResource ->conn_error.'</div>';
    }
  }

  function getResourcesType( $type) { ?>
      <title><?php echo( ucfirst( $type) ); ?>s List - <?php showOption( 'name' ); ?></title><?php 
    $getResourcesBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."resources WHERE state = 'active' AND ilk='".$type."'" );
    if ( $getResourcesBy -> num_rows > 0) {
      ?>
      <a href="./resource?create=<?php echo( $type ); ?>" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">edit</i></a>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php echo( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $resourcesDetails = mysqli_fetch_assoc( $getResourcesBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( ucwords( $resourcesDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./resource?view=<?php echo( $resourcesDetails['id'] ); ?>&key=<?php echo( $resourcesDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php echo( $resourcesDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="?resource?message?create=message&code=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./resource?edit=<?php echo( $resourcesDetails['id'] ); ?>&key=<?php echo( $resourcesDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./resource?delete=<?php echo( $resourcesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div><?php 
    } else {
      ?><div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No <?php echo( ucwords( $type. 's' ) ); ?> Found</p></td>
        </tr>
        </tbody>
      </table>
      </div></div><?php 
    }
  }

  function getResourcesLoc( $location) { ?>
      <title>Resources In <?php echo( ucwords( $location) ); ?> - <?php showOption( 'name' ); ?></title><?php 
    $getResourcesBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."resources WHERE ilk = 'center' AND state = 'active' AND location='".$location."'" );
    if ( $getResourcesBy -> num_rows > 0) {
      ?>
      <a href="./resource?create=<?php echo( $type ); ?>" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">edit</i></a>
      <div class="mdl-grid">
        <div class="mdl-cell--12-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php echo( ucfirst( $type) ); ?>">
            </div></center>
            <div class="result"></div>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $resourcesDetails = mysqli_fetch_assoc( $getResourcesBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( ucwords( $resourcesDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./resource?view=<?php echo( $resourcesDetails['id'] ); ?>&key=<?php echo( $resourcesDetails['name'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php echo( $resourcesDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="?resource?message?create=message&code=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./resource?edit=<?php echo( $resourcesDetails['id'] ); ?>&key=<?php echo( $resourcesDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./resource?delete=<?php echo( $resourcesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div><?php 
    } else {
      ?><div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No Resources Found in <?php echo( ucwords( $location) )?></p></td>
        </tr>
        </tbody>
      </table>
      </div></div><?php 
    }
  }

  function getResourcesAuthor( $author) { 
    $getUser = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE id = '".$author."'" );
     if ( $getUser -> num_rows > 0) {
       while ( $user = mysqli_fetch_assoc( $getUser) ) {
         $userDeet[] = $user;
       }
     }
    ?>
    <title><?php echo( $userDeet[0]['name'] ); ?>'s Resources - <?php showOption( 'name' ); ?></title><?php 
    $getResourcesBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."resources WHERE author='".$author."'" );
    if ( $getResourcesBy -> num_rows > 0) {
      ?>
      <div class="mdl-grid">
        <div class="mdl-cell--11-col" >
            <center>
            <div class="input-field search-box">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php echo( "Resource" ); ?>">
            </div></center>
            <div class="result"></div>
        </div>

        <div class="mdl-cell--1-col mdl-card" ><br>
              <a href="users?view=<?php echo( $author ); ?>" class="alignright">
              <i class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification">perm_identity</i></a>
            
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">TYPE</th>
        <th class="mdl-data-table__cell--non-numeric">Doctor In Charge</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $usersDetails = mysqli_fetch_assoc( $getResourcesBy)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $usersDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $usersDetails['ilk'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $usersDetails['by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $usersDetails['state'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./resource?view=<?php echo( $usersDetails['id'] ); ?>&key=<?php echo( $usersDetails['name'] ); ?>" ><i class="material-icons">perm_identity</i></a> 
        <a href="tel:<?php echo( $usersDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?create=message&code=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a><?php 
        if ( isCap( 'admin' ) ) { ?>  
        <a href="./users?edit=<?php echo( $usersDetails['id'] ); ?>&key=<?php echo( $usersDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./users?delete=<?php echo( $usersDetails['id'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
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
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">TYPE</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>
            <p><?php echo( $userDeet[0]['name'] ); ?> has not created any resources yet!</p>
          </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div><?php 
    }
  }

  function getResources() {
      ?><title>All Resources - <?php showOption( 'name' ); ?></title><?php 
    $getResources = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."resources WHERE state = 'active' ORDER BY created DESC" );

    if ( $getResources -> num_rows > 0) {
      ?>
      <a href="./resource?create=organization" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">create</i></a>
      <div class="mdl-grid" id="mdl-table">
        <div class="mdl-cell--12-col" >
          <form>
            <center>
            <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input type="text" placeholder="Search <?php echo( "Resource" ); ?>" class="search" >
            </div></center>
            
          <script>
            var options = {
            valueNames: ["name", "location", "created"]
          },
            documentTable = new List( "mdl-table", options );

          $( $( "th.sort" )[0] ).trigger( "click", function() {
            console.log( "clicked" );
          } );

          $( "input.search" ).on( "keyup", function(e) {
            if ( e.keyCode === 27) {
              $(e.currentTarget).val( "" );
              documentTable.search( "" );
            }
          } );
          </script>
          </form>
        </div>
      <div class="mdl-cell--12-col mdl-grid">
      <table id="mdl-table" class="mdl-card mdl-data-table mdl-js-data-table mdl-data-table--selectable sort mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric sort" data-sort="name">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $resourcesDetails = mysqli_fetch_assoc( $getResources)){
        ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['email'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $resourcesDetails['phone'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( ucwords( $resourcesDetails['location'] ) ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./resource?view=<?php echo( $resourcesDetails['id'] ); ?>&key=<?php echo( $resourcesDetails['name'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php echo( $resourcesDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="?resource?message?create=message&code=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>" ><i class="material-icons">message</i></a>  
        <a href="./resource?edit=<?php echo( $resourcesDetails['id'] ); ?>&key=<?php echo( $resourcesDetails['name'] ); ?>" ><i class="material-icons">edit</i></a> 
        <a href="./resource?delete=<?php echo( $resourcesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
      </table>
      </div>
      </div>
      <?php   } else {
      ?><div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">NAME</th>
        <th class="mdl-data-table__cell--non-numeric">ADMIN EMAIL</th>
        <th class="mdl-data-table__cell--non-numeric">CONTACT PHONE</th>
        <th class="mdl-data-table__cell--non-numeric">LOCATION</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No Resources Found</p></td>
        </tr>
        </tbody>
      </table>
      </div></div><?php 
    }
  }

  function getResourceCode( $code) {
    $getResourceCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."resources WHERE id = '".$code."'" );
    if ( $getResourceCode -> num_rows > 0) {
      while ( $resourceDetails = mysqli_fetch_assoc( $getResourceCode)){
        if ( $_SESSION[JBLSALT.'Code'] !== $resourceDetails['id'] ) {
          $name = explode( " ", $resourceDetails['name'] );
          $greettype = 'Contact Details';
        } else {
          $name = explode( " ", $resourceDetails['name'] );
          $greettype = '<b>Hello,</b> '.ucfirst( $name[0] );
        }
        ?><title><?php echo( $resourceDetails['name'] ); ?> - <?php showOption( 'name' ); ?></title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php echo( ucfirst( $resourceDetails['name'] ) ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a href="./resource?view=<?php echo( $resourceDetails['id'] ); ?>&fav=<?php echo( $resourceDetails['id'] ); ?>" class="material-icons mdl-badge mdl-badge--overlap">favorite</a>
                                <a href="./resource?edit=<?php echo( $resourceDetails['id'] ); ?>&key=<?php echo( $resourceDetails['name'] ); ?>" ><i class="material-icons">edit</i></a>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <h5>
                              <?php echo( $greettype ); ?>
                            <h5>
                            <h6><b>Admin Email:</b> <a href="mailto:<?php echo( $resourceDetails['email'] ); ?>"><?php echo( $resourceDetails['email'] ); ?></a><br><?php if ( $resourceDetails['ilk'] !== "organization" ) { ?>
                            <b>Center:</b> <a href="./resource?center=<?php echo( $resourceDetails['company'] ); ?>"><?php echo( $resourceDetails['company'] ); ?></a><br><?php } 
                            ?><b>Contact Phone:</b> <a href="tel:<?php echo( $resourceDetails['phone'] ); ?>"><?php echo( $resourceDetails['phone'] ); ?></a><br>
                            <b>Type: </b><?php echo( $resourceDetails['ilk'] ); ?><br>
                            <b>County:</b> <a href="./resource?location=<?php echo( $resourceDetails['location'] ); ?>"><?php echo( ucwords( $resourceDetails['location'] ) ); ?></a>
                            </h6>
                            <a href="tel:<?php echo( $resourceDetails['phone'] ); ?>"><i class="material-icons">phone</i></a>
                            <a href="mailto:<?php echo( $resourceDetails['email'] ); ?>"><i class="material-icons">mail_outline</i></a>
                            <a href="./message?create=message"><i class="material-icons">message</i></a>
                            <a href="./notification?create=note"><i class="material-icons">notifications</i></a>
                            
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                            <img src="<?php echo( $resourceDetails['avatar'] ); ?>" width="100%">
                          </div>
                          <div class="mdl-cell mdl-cell--12-col">
                          <div><?php echo( $resourceDetails['details'] ); ?></div></div>
                          <div><h6><b>Added:</b> <?php echo( $resourceDetails['created'] ); ?></h6></div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">local_hospital</i>
                          <span class="mdl-button"><?php echo( $resourceDetails['company'] ); ?></span>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">person_pin_circle</i>
                                <?php echo( $resourceDetails['location'] ); ?>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        <ul class="collapsible popout" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header active"><i class="material-icons">message</i>Messages from <?php echo( $name[0] ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">comment</i>Messages to <?php echo( ucfirst( $name[0] ) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">chat_bubble</i>Chat with <?php echo( ucfirst( $name[0] ) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">description</i>Posts from <?php echo( ucfirst( $name[0] ) ); ?></div>
                          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                      </ul>
                        </div>
                    </div>
                </div>

                </div><?php 
      }
    } else {
      echo 'Resource Not Found';
    }
  }
 
}
