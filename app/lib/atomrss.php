<?php
namespace Jabali\Lib;

class atomRSS
{

  public function render()
  {
    echo $this->getDetails() . $this->getItems();
  }

  private function getDetails()
  {  
    $details = '<?xml version="1.0" encoding="UTF-8" ?>
        <rss version="2.0">
          <channel>
            <title>'. getOption( 'name' ) .'</title>
            <link>'. _ROOT .'</link>
            <description>'. getOption( 'description' ) .'</description>
            <language>'. getOption( 'language' ) .'</language>
            <image>
              <title>'. getOption( 'name' ) .'</title>
              <url>'. getOption( 'favicon' ) .'</url>
              <link>'. getOption( 'headerlogo' ) .'</link>
              <width>88</width>
              <height>88</height>
            </image>';
    return $details;
  }
  private function getItems()
  {
    $posts = $GLOBALS['POSTS'] -> sweep();
    foreach( $posts as $row ) {
    $items = '<item>
      <title>'. $row["title"] .'</title>
      <link>'. $row["link"] .'</link>
      <description><![CDATA['. $row["description"] .']]></description>
    </item>';
    }
    $items .= '</channel>
        </rss>';
    return $items;
  }
}