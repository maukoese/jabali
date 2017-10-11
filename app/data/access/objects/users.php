<?php
/**
* Jabali Users Data Access Object
**/ 

namespace Jabali\Data\Access\Objects;

class Users {

  public $id;
  public $author;
  public $author_name;
  public $avatar;
  public $categories;
  public $company;
  public $created;
  public $custom;
  public $details;
  public $email;
  public $excerpt;
  public $gender;
  public $level;
  public $link;
  public $location;
  public $name;
  public $phone;
  public $social;
  public $state;
  public $style;
  public $ilk;
  public $updated;
  public $username;
  public $allowed = array( "id", "author", "avatar", "categories", "company", "created", "custom", "details", "email","excerpt", "gender", "level", "link", "location", "name", "phone", "social", "state", "style", "ilk", "updated", "username" );

  private $authkey;
  private $password;
  private $table = "users";

  public function create(){
    $cols = array( "authkey", "author", "author_name", "avatar", "categories", "company", "created", "custom", "details", "email","excerpt", "gender", "level", "link", "location", "name", "phone", "social", "state", "style", "ilk", "updated", "username", "password" );

    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['name'] ) ) { $_POST['name'] = 'name'; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['categories'] ) ) { $_POST['categories'] = "Uncategorized"; }
    if ( empty( $_POST['company'] ) ) { $_POST['company'] = "Jabali"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['custom'] ) ) { $_POST['custom'] = "{}"; }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "User bio"; }
    if ( empty( $_POST['email'] ) ) { $_POST['email'] = "user@jabali.co.ke"; }
    if ( empty( $_POST['excerpt'] ) ) { $_POST['excerpt'] = substr( $_POST['details'], 250 ); }
    if ( empty( $_POST['gender'] ) ) { $_POST['gender'] = "other"; }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['location'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['phone'] ) ) { $_POST['level'] = "+254204404993"; }
    if ( empty( $_POST['social'] ) ) { $_POST['social'] = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}'; }
    if ( empty( $_POST['style'] ) ) { $_POST['style'] = "zahra"; }
    if ( empty( $_POST['state'] ) ) { $_POST['state'] = "published"; } 
    if ( empty( $_POST['ilk'] ) ) { $_POST['ilk'] = "article"; } 
    if ( empty( $_POST['password'] ) ) { $_POST['password'] = md5($_POST['name'].date("Y-m-d H:i:s")); } 
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( empty( $_FILES['new_avatar'] ) ) {
      $uploaddir = _ABSUP_ .date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';

      $upload = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. basename( $_FILES['new_avatar']['name'] );
      if ( file_exists( $upload) ) {
        $new_avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. basename( $_FILES['new_avatar']['name'] )."_".date('H_m_s');
      } else {
        $new_avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/' . basename( $_FILES['new_avatar']['name'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_name"], $uploaddir);

      $avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. $new_avatar;
    } else {
      $avatar = $_POST['the_avatar'];
    }

    $this -> authkey = $_POST['authkey'];
    $this -> name = $_POST['name']; 
    $this -> author = $_POST['author'];
    $this -> author_name = $_POST['author_name'];
    $this -> avatar = $avatar;
    $this -> categories = $_POST['categories'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $this -> created = $created.' '.$created_t;
    $this -> company = $_POST['company'];
    $this -> custom = $_POST['custom'];
    $this -> details = $_POST['details'];
    $this -> email = $_POST['email'];
    $this -> excerpt = $_POST['excerpt'];
    $this -> gender = $_POST['gender'];
    $this -> level = $_POST['level'];
    $link = preg_replace('/\s+/', '', $_POST['name'] );
    $this -> username = strtolower( $link );
    $this -> link = _ROOT . '/users/' . $this -> username ;
    $this -> location = $_POST['location'];
    $this -> phone = $_POST['phone'];  
    $this -> state = $_POST['state'];
    $this -> social = $_POST['social'];
    $this -> style = $_POST['style'];  
    $this -> ilk = $_POST['ilk']; 
    $this -> updated = $_POST['updated'];
    $this -> password = $_POST['password'];

    $vals = array( $this -> authkey, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> company, $this -> created, $this -> custom, $this -> details, $this -> email, $this -> excerpt, $this -> gender, $this -> level, $this -> link, $this -> location, $this -> name, $this -> phone, $this -> social, $this -> state, $this -> style, $this -> ilk, $this -> updated, $this -> username, $this -> password );

    if ( $GLOBALS['JBLDB'] -> insert( $this -> table, $cols, $vals ) ) {
      return array( "success" => "User created successfully with id ". $GLOBALS['JBLDB'] -> insertId() );
    } else {
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function update(){
    $cols = array( "authkey", "author", "author_name", "avatar", "categories", "company", "created", "custom", "details", "email","excerpt", "gender", "level", "link", "location", "name", "phone", "social", "state", "style", "ilk", "updated", "username", "password" );

    if ( empty( $_POST['name'] ) ) { $_POST['name'] = 'name'; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['category'] ) ) { $_POST['category'] = "Uncategorized"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "Post details"; }
    $_POST['gallery'] = "none";
    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['excerpt'] ) ) { $_POST['excerpt'] = substr( $_POST['details'], 250 ); }
    if ( empty( $_POST['readings'] ) ) { $_POST['readings'] = "none"; }
    if ( empty( $_POST['state'] ) ) { $_POST['state'] = "published"; } 
    if ( empty( $_POST['subtitle'] ) ) { $_POST['subtitle'] = 'undefined'; }
    if ( empty( $_POST['tags'] ) ) { $_POST['tags'] = "none"; } 
    if ( empty( $_POST['template'] ) ) { $_POST['template'] = "post"; } 
    if ( empty( $_POST['ilk'] ) ) { $_POST['ilk'] = "article"; } 
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( empty( $_FILES['new_avatar'] ) ) {
      $uploaddir = _ABSUP_ .date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';

      $upload = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. basename( $_FILES['new_avatar']['name'] );
      if ( file_exists( $upload) ) {
        $new_avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. basename( $_FILES['new_avatar']['name'] )."_".date('H_m_s');
      } else {
        $new_avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/' . basename( $_FILES['new_avatar']['name'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_name"], $uploaddir);

      $avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. $new_avatar;
    } else {
      $avatar = $_POST['the_avatar'];
    }

    $this -> name = $_POST['name']; 
    $this -> author = $_POST['author'];
    $this -> author_name = $_POST['author_name'];
    $this -> avatar = $avatar;
    $this -> categories = $_POST['categories'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $this -> created = $created.' '.$created_t;
    $this -> details = $_POST['details'];
    $this -> gallery = $_POST['gallery'];
    $this -> authkey = $_POST['authkey'];
    $this -> level = $_POST['level'];
    $link = preg_replace('/\s+/', '-', $_POST['name'] );
    $this -> slug = strtolower( $link );
    $this -> link = _ROOT . '/' . $this -> slug ;
    $this -> excerpt = $_POST['excerpt'];
    $this -> readings = $_POST['readings']; 
    $this -> state = $_POST['state']; 
    $this -> subtitle = $_POST['subtitle']; 
    $this -> tags = $_POST['tags']; 
    $this -> template = strtolower( $_POST['template'] ); 
    $this -> ilk = $_POST['ilk']; 
    $this -> updated = $_POST['updated'];

    $vals = array( $this -> authkey, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> company, $this -> created, $this -> custom, $this -> details, $this -> email, $this -> excerpt, $this -> gender, $this -> level, $this -> link, $this -> location, $this -> name, $this -> phone, $this -> social, $this -> state, $this -> style, $this -> ilk, $this -> updated, $this -> username, $this -> password );

    $conds = array( "id" => $this -> id );

    if ( $GLOBALS['JBLDB'] -> update( $this -> table, $cols, $vals, $conds ) ) {
      return array( "success" => "User of id ". $GLOBALS['JBLDB'] -> insertId() ." updated successfully" );
    } else {
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }


  public function getId( $id ){
    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
        foreach ( $user as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $users[0];
    } else {
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getUser( $username ){
    $conds = array( "username" => $username );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
        foreach ( $user as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $users[0];
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getAuthor( $author ){
    $conds = array( "author" => $author );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCategories( $category ){
    $conds = array( "state" => "active" );
    $results = $GLOBALS['JBLDB'] -> search( $this -> table, $this -> allowed, $conds, $category );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCompany( $company ){
    $conds = array( "company" => $company );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCreated( $date ){
    $conds = array( "created" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getGender( $gender ){
    $conds = array( "gender" => $gender );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLevel( $level ){
    $conds = array( "level" => $level );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCity( $location ){
    $conds = array( "city" => $location );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getRegion( $location ){
    $conds = array( "region" => $location );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCountry( $location ){
    $conds = array( "country" => $location );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getState( $status ){
    $conds = array( "state" => $status );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getStyle( $skin ){
    $conds = array( "style" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getTypes( $type ){
    $conds = array( "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getUpdated( $date ){
    $conds = array( "updated" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function delete( $id ){
    $conds = array( "id" => $id );
    if( $GLOBALS['JBLDB'] -> delete( $this -> table, $conds ) ){
      return array("success" => "User deleted Successfully");
    } else {
      return array("error" => "User deletion Failed", "cause" => $GLOBALS['JBLDB'] -> error());
    }
  }

  public function sweep(){
    $conds = array( "state" => "active" );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> affectedRows() > 0 ) {
      $users = array();
      while ( $user = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $users[] = $user;
      }

      return $users;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
    
  }

  public function sweepy(){
    $conds = array( "state" => "active" );
    $users = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    return new ResultSet( $users );
  }

  function login() {
    $user=$_POST['user'];
    $password=$_POST['password'];

    $user = stripslashes( $user );
    $password = stripslashes( $password );
    $user = $GLOBALS['JBLDB'] -> clean( $user );
    $password = $GLOBALS['JBLDB'] -> clean( $password );
    $password = md5($password);

    if ( isEmail( $user ) ) {
      $result = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE email  = '".$user."'" );
    } else {
      $result = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE username = '".$user."'" );
    }

    if ( $result -> num_rows > 0 ) {
      while ( $userDetails = mysqli_fetch_assoc( $result ) ) {
        if ( $userDetails['password'] == $password ) {
          $_SESSION[JBLSALT.'Alias'] = $userDetails['name'];
          $_SESSION[JBLSALT.'Username'] = $userDetails['username'];
          $_SESSION[JBLSALT.'Code'] = $userDetails['id'];
          $_SESSION[JBLSALT.'Email'] = $userDetails['email'];
          $_SESSION[JBLSALT.'Phone'] = $userDetails['phone'];
          $_SESSION[JBLSALT.'Org'] = $userDetails['company'];
          $_SESSION[JBLSALT.'Cap'] = $userDetails['ilk'];
          $_SESSION[JBLSALT.'Location'] = $userDetails['location'];
          $_SESSION[JBLSALT.'Avatar'] = $userDetails['avatar'];
          $_SESSION[JBLSALT.'Gender'] = $userDetails['gender'];

          header( 'Location: '._ROOT.'/admin/index?page=my dashboard' );
          exit();
        } else {
          header('Location: '._ROOT.'/signin/jabali?alert=password' );
          exit();
        }
      }
    } else {
      header('Location: '._ROOT.'/signin?alert=user' );
      exit();
    }
  }

  function register() {
    $this -> connectDB();
    define('_IMAGES', _ROOT.'inc/assets/images/');
    
    if ( emailExists( $_POST['email'] ) )
    {
      header( "Location: ./register?create=exists" );
    } else 
    {
        $date = date( "YmdHms" );
        $email = $_POST['email'];

        $hash = str_shuffle(md5( $email.$date ) );
        $abbr = substr( $_POST['lname'], 0,3 );

        $name = $_POST['fname'].' '.$_POST['lname'];
        $author = substr( $hash, 20 );
        
        $avatar = _IMAGES.'avatar.svg';
        $company = mysqli_real_escape_string( $conn, $_POST['company'] );
        $id = md5(date('l jS \of F Y h:i:s A').rand(10,1000) );
        $details = "";
        $created = date('Ymd' );
        $email  = mysqli_real_escape_string( $conn, $_POST['email'] );
        $gender = strtolower( $_POST['gender'] );
        $authkey = $hash;
        $level = mysqli_real_escape_string( $conn, $_POST['level'] );
        $link = _ROOT."users?view=$id&key=$name";
        $location = strtolower( $_POST['location'] );
        $excerpt = "Account created on ".$date;
        $password = md5( $_POST['password'] );
        $phone = mysqli_real_escape_string( $conn, $_POST['phone'] );

        if ( !$_POST['state'] ) {
          $state = "pending";
        } else {
          $state = $_POST['state'];
        }
        $social = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}';
        $style = "zahra";
        $ilk = strtolower( $_POST['ilk'] );
        $username = strtolower( $_POST['fname'].$abbr );

      if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."users (name, author, avatar, company, id, created, details, email , gender, authkey, level, link, location, excerpt, password, phone, social, state, style, ilk, username) VALUES ('".$name."', '".$author."', '".$avatar."', '".$company."', '".$id."', '".$created."', '".$details."', '".$email ."', '".$gender."', '".$authkey."', '".$level."', '".$link."', '".$location."', '".$excerpt."', '".$password."', '".$phone."', '".$social."', '".$state."', '".$style."', '".$ilk."', '".$username."' )" ) ) {
      header( "Location: ./register?create=success" );
      } else {
      //header( "Location: ./register?create=fail" );
      echo "Error: " . $conn -> error;
      }
    }
  }

  function reset( $id, $key ) {
    if ( $GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."users SET password = '".md5( $_POST['password'] )."', authkey = '".md5(date('YmdHms' ))."' WHERE id = '".$_POST['id']."'" ) ) {
      if ( $hUser -> emailUser( $user[0]['email'], "reset", $user[0]['authkey'] ) ) {
        header( "Location: ./forgot?error=null" );
      } else {
        header( "Location: ./forgot?error=email" );
      }
    } else {
      header( "Location: ./reset?error=update" );
    }
  }
}