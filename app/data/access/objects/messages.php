<?php
/**
* @package Jabali
* @subpackage Messages Data Access Object
* @author Mauko Maunde
* @link https://docs.jabalicms.org/data/access/objects/messages/
* @since 0.17.11
* @license MIT - https://opensource.org/licenses/MIT
**/

namespace Jabali\Data\Access\Objects;

class Messages {

  public $name;
  public $author;
  public $author_name;
  public $id;
  public $created;
  public $details;
  public $email;
  public $receipient;
  public $authkey;
  public $level;
  public $link;
  public $phone;
  public $state;
  public $ilk;

  public $allowed = array( "name", "author", "author_name", "id", "created", "details", "email", "receipient", "authkey", "level", "link", "phone", "state", "ilk" );

  private $table = "messages";

  public function create()
  {
    $cols = array( "name", "author", "author_name", "id", "created", "details", "email", "receipient", "authkey", "level", "link", "phone", "state", "ilk" );
    
    $vals = array( $this -> name, $this -> author, $this -> author_name, $this -> created, $this -> details, $this -> email, $this -> receipient, $this -> authkey, $this -> level, $this -> link, $this -> phone, $this -> state, $this -> ilk ); 

    if ( $GLOBALS['JBLDB'] -> insert( $this -> table, $cols, $vals ) ) {
      return array( "status" => "success", "message" => "Message created successfully with id ". $GLOBALS['JBLDB'] -> insertId() );
    } else {
      return array( "status" => "fail", "message" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getId( $id )
  {
    $vars = get_object_vars( $this );

    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this->allowed, $conds );

    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
  while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
        foreach ( $message as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $messages[0];
    } else{
      return array( "status" => "Request Failed", "error" => "Message Not Found" );
    }
    
  }

  public function getMessage( $slug )
  {
    $conds = array( "slug" => $slug );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
  while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
        foreach ( $message as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $messages[0];
    } else{
      return array( "status" => "Request Failed", "error" => "Message Not Found" );
    }

  }

  public function getAuthor( $author)
  {
    $conds = array( "author" => $author );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "Request Failed", "error" => "Messages Not Found" );
    }
  }

  public function getCategories( $category, $type = "message" )
  {
    $conds = array( "template" => $skin, "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCompany( $company, $type = "message" )
  {
    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCreated( $date, $type = "message" )
  {
    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLevel( $level, $type = "message" )
  {
    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLocation( $location, $type = "message" )
  {
    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getState( $status, $type = "message" )
  {
    $conds = array( "status" => $status, "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getTypes( $type = "message", $limit = 10 )
  {
    $conds = array( "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getUpdated( $date, $type = "message" )
  {
    $conds = array( "updated" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
        while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $messages['status'] = "success";
        $messages[] = $message;
      }     

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function delete( $id ){

    $conds = array( "id" => $id );
    if( $GLOBALS['JBLDB'] -> delete( $this -> table, $conds ) ){
      return array("success" => "Message deleted Successfully");
    } else {
      return array("error" => "Message deletion Failed", "cause" => $GLOBALS['JBLDB'] -> error());
    }
  }

  public function sweep( $type = "message", $limit = 10 )
  {
    $conds = array( "state" => "published", "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $messages = array();
      while ( $message = $GLOBALS['JBLDB'] -> fetchArray( $results ) ) {
        $messages['status'] = "success";
        $messages[] = $message;
      }

      return $messages;
    } else{
      return array( "status" => "fail", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function sweepy( $type = "message")
  {
    $conds = array( "state" => "published", "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    return new ResultSet( $messages );
  }
}