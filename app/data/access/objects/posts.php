<?php
/**
* Jabali Posts Data Access Object
**/ 

namespace Jabali\Data\Access\Objects;

class Posts {

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

  private $table = "posts";

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
      return array( "status" => "Post ". $this -> id . "updated successfully!" );
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
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
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
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }

  }

  public function getAuthor( $author ){

    $conds = array( "author" => $author );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getCategories( $category ){

    $conds = array( "template" => $skin );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getCompany( $company ){

    $conds = array( "template" => $skin );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getCreated( $date ){

    $conds = array( "template" => $skin );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getGender( $gender ){

    $conds = array( "template" => $skin );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getLevel( $level ){

    $conds = array( "template" => $skin );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getLocation( $location ){

    $conds = array( "template" => $skin );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getState( $status ){

    $conds = array( "template" => $skin );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getTypes( $type ){

    $conds = array( "ilk" => $type );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function getUpdated( $date ){

    $conds = array( "updated" => $date );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
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

  public function sweep( $type = "article" ){

    $conds = array( "state" => "published", "ilk" => $type );
    $results = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    if ( $GLOBALS['JBLDB'] -> numRows( $results ) > 0 ) {
      $posts = array();
      while ( $post = $GLOBALS['JBLDB'] -> fetchObject( $results ) ) {
        $posts[] = $post;
      }

      return $posts;
    } else{
      return array( "error" => $GLOBALS['JBLDB'] -> error() );
    }
  }

  public function sweepy(){

    $conds = array( "state" => "published", "ilk" => "article" );
    $posts = $GLOBALS['JBLDB'] -> select( $this -> table, $this -> allowed, $conds );
    return new ResultSet( $posts );
  }
}