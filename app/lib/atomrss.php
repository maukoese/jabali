<?php
namespace Jabali\Lib;

class atomRSS {

  public function head( $title, $description, $siteurl ){
    echo '<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">';
    echo '<channel>';
    echo '<title>'.$title.'</title>';
    echo '<link>'.$siteurl.'</link>';
    echo '<description>'.$description.'</description>';
    echo '<language>en-us</language>';
    echo '<atom:link href="'.$siteurl.'/rss.xml" rel="self" type="application/rss+xml"/>';
  }

  public function feed( $post ){
      echo '<item>
        <title>' . htmlspecialchars( $post -> name ) . '</title>
        <link>' . htmlspecialchars( $post -> link ) . '<link>
        <description>' . htmlspecialchars( $post -> details ) . '</description>
        <category>' . htmlspecialchars( $post -> categories ) . '</category>
        <comments>' . htmlspecialchars( _ROOT . '/comments/posts/' . $post -> id ) . '</comments>
        <guid>' . htmlspecialchars( $post -> id ) . '</guid>
        <pubDate' . date( "D, d M Y H:i:s O", strtotime( htmlspecialchars( $post -> created ) ) ) . '</pubDate
        </item>';
  }

  public function foot(){
    echo '</channel>';
    echo '</rss>';
  }

  public function clean( $string ){
    $string = strtolower( preg_replace('@[\W_]+@', '-', $string) );
    $string = rtrim($string,'-');
    $string = strtolower($string);

    return $string;
  }
}

?> 