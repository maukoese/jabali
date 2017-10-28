<?php 
/**
* @class REST
* @see https://jabalicms.org/restful/
* @return mixed JSON string of requested resource
* @since 17.10
* @author Mauko Maunde
*/

namespace Jabali\Lib;

class REST
{

  public function render()
  {
    header('Content-Type:Application/json' );
    echo( json_encode( $this -> process() ) );
  }

  public function process( $elements )
  {
    $table = strtoupper( $elements[0] );
    $table = $GLOBALS[$table];
    $data = file_get_contents("php://input");
    if ( empty( $elements[0] ) ) {
        return $this -> api();
    } elseif ( $elements[0] == "themes") {
        return $this -> themes();
    } else {
      if ( empty( $elements[1] ) ) {
        return $table -> sweep();
      } else switch ( $elements[1] ) {
        case 'create':
          $details = json_decode( $data, true );
          foreach ($details as $field => $value) {
            $table -> $field = $value;
          }
          
          return $table -> create();
          break;

        case 'update':
          $details = json_decode( $data, true );
          foreach ($details as $field => $value) {
            $table -> $field = $value;
          }
          
          return $table -> update();
          break;
        
        case 'delete':
          $details = json_decode( $this -> data, true );
          return $table -> delete( /*$details['id']*/ $elements[2] );
          break;

        default:
          if ( empty( $elements[2] ) ) {
             return $table -> sweep();
          } elseif ( is_numeric( $elements[2] ) ) {
            echo json_encode( $table -> getId( $elements[2] ) );
          } else {
            if ( empty( $elements[3] ) ) {
              $type = substr( $elements[2], 0,-1);
              echo json_encode( $table -> getTypes( $type ) );
            } else {
              if ( empty( $elements[4] ) ) {
                if ( is_numeric( $elements[3] ) ) {
                  echo json_encode( $table -> getYear( $elements[3] ) );
                } elseif ( $elements[3] == "writers") {
                  echo json_encode( listWriters() );
                } elseif ( $elements[3] == "categories") {
                  echo json_encode( listCategories() );
                } elseif ( $elements[3] == "tags" ) {
                  echo json_encode( listTags() );
                } elseif ( $elements[3] == "portfolio") {
                  echo json_encode( listPortfolio() );
                } else {

                }
              } else {

                if ( is_numeric( $elements[3] ) ) {
                  if ( empty( $elements[5] ) ) {
                    $table -> getMonth( $elements[3], $elements[4] );
                  } else {
                    $table -> getDay( $elements[3], $elements[4], $elements[5]);
                  }
                } elseif ( $elements[3] == "writers") {
                  $table -> getWriters( $elements[4] );
                } elseif ( $elements[3] == "categories") {
                  $table -> getCategories( $elements[4] );
                } elseif ( $elements[3] == "tags") {
                  $table -> getTags( $elements[4] );
                } elseif ( $elements[3] == "portfolio") {
                  if ( $elements[4] == "clients" ) {
                    $table -> getClients( $elements[5] );
                  } elseif ( $elements[4] == "projects" ) {
                     $table -> getProjects( $elements[5] ); 
                  }
                } else {

                }
              }
            }
          }
          break;
      }
    }
  }

  public function api()
  {
    $response = array( 
      "name" => getOption( 'name' ). ' API', 
      "description" => getOption( 'description' ), 
      "details" => getOption( 'about' ), 
      "version" => "1.0" , 
      "date" => date( 'Y-m-d H:i:s'), 
      "generator" => "Jabali v.17.10" 
    );
    return $response;
  }

  public function themes()
  {
    $themes = array();
    $path = _ABSTHEMES_;
    if ( is_dir( $path ) ) {
      $dir = new DirectoryIterator($path);
      foreach ($dir as $fileinfo) {
          if ($fileinfo->isDir() && !$fileinfo->isDot()) {
              $themef = $fileinfo->getFilename();
          $theme = file_get_contents( _ABSTHEMES_.$themef."/".$themef.".json" );
          $theme = json_decode( $theme, true );

          $themes[$themef] = $theme;
          }
      }
    }

    if ( !empty( $elements[1] ) ) {
      $themes = $themes[$elements[1]];
    }
    return $themes;
  }
}