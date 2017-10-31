<?php
/**
* Jabali Comments Data Access Object
**/ 

namespace Jabali\Data\Access\Objects;

class Comments {

  public $name;
  public $author;
  public $author_name;
  public $avatar;
  public $categories;
  public $id;
  public $created;
  public $details;
  public $gallery;
  public $authkey;
  public $level;
  public $link;
  public $excerpt;
  public $readings;
  public $state;
  public $subtitle;
  public $slug;
  public $tags;
  public $template;
  public $ilk;
  public $updated;
  public $allowed = array( "name", "author", "author_name", "avatar", "categories", "id", "created", "details", "gallery", "level", "link", "excerpt", "readings", "state", "subtitle", "slug", "tags", "template", "ilk", "updated" );

  private $table = "messages";

  public function create(){
    $cols = array( "name", "author", "author_name", "avatar", "categories", "created", "details", "gallery", "authkey", "level", "link", "excerpt", "readings", "state", "subtitle", "slug", "tags", "updated", "template", "ilk" );

    $vals = array( $this -> name, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> created, $this -> details, $this -> gallery, $this -> authkey, $this -> level, $this -> link, $this -> excerpt, $this -> readings, $this -> state, $this -> subtitle, $this -> slug, $this -> tags, $this -> updated, $this -> template, $this -> ilk );

    if ( $GLOBALS['JBLDB'] -> insert( $this -> table, $cols, $vals ) ) {
      return array( "status" => "Post created successfully with id ". $GLOBALS['JBLDB'] -> insertId() );
    } else {
      return array( "status" => "Failed", "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function update(){
    $cols = array( "name", "author", "author_name", "avatar", "categories", "created", "details", "gallery", "authkey", "level", "link", "excerpt", "readings", "state", "subtitle", "slug", "tags", "updated", "template", "ilk" );

    $vals = array( $this -> name, $this -> author, $this -> author_name, $this -> avatar, $this -> categories, $this -> created, $this -> details, $this -> gallery, $this -> authkey, $this -> level, $this -> link, $this -> excerpt, $this -> readings, $this -> state, $this -> subtitle, $this -> slug, $this -> tags, $this -> updated, $this -> template, $this -> ilk );

    $conds = array( "id" => $this -> id );

    if ( $GLOBALS['JBLDB'] -> update( $this -> table, $cols, $vals, $conds ) ) {
      return array( "status" => "Post ". $this -> id . " updated successfully!" );
    } else {
      return array( "status" => "Failed", "error" => $GLOBALS['JBLDB'] -> error() );
    }
    
  }

  public function getId( $id ){
    $vars = get_object_vars( $this );

    $conds = array( "id" => $id );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this->allowed, $conds );

    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
        foreach ( $post as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $posts[0];
    } else{
      return array( "status" => "Request Failed", "error" => "Post Not Found" );
    }
    
  }

  public function getPost( $slug ){

    $conds = array( "slug" => $slug );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
        foreach ( $post as $var => $val ) {
          $this -> $var = $val;
        }
      }

      return $posts[0];
    } else{
      return array( "status" => "Request Failed", "error" => "Post Not Found" );
    }

  }

  public function getAuthor( $author ){

    $conds = array( "author" => $author );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "status" => "Request Failed", "error" => "Posts Not Found" );
    }
  }

  public function getCategories( $category, $type = "article" ){

    $conds = array( "template" => $skin, "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCompany( $company, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getCreated( $date, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLevel( $level, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getLocation( $location, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getState( $status, $type = "article" ){

    $conds = array( "template" => $skin );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getTypes( $type = "article", $limit = 10 ){

    $conds = array( "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function getUpdated( $date, $type = "article" ){

    $conds = array( "updated" => $date );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results )) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function delete( $id ){

    $conds = array( "id" => $id );
    if( $GLOBALS['JBLDB'] -> delete( $this -> table, $conds ) ){
      return array("success" => "Post deleted Successfully");
    } else {
      return array("error" => "Post deletion Failed", "cause" => $GLOBALS['JBLDB'] -> error());
    }
  }

  public function sweep( $type = "article", $limit = 10 ){

    $conds = array( "state" => "published", "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchArray( $results ) ) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function sweepy( $type = "article"){

    $conds = array( "state" => "published", "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    return new ResultSet( $posts );
  }
}