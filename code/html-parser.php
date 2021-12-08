<?php

class HTMLParser
{
  /**
   * Get image tags from html dom tree
   * 
   * @param $html
   * 
   * @return \DOMDocument
   */
  public static function getImageTags($html)
  {
    $dom = new DOMDocument();
    @$dom->loadHTML($html);

    $imageNodes = $dom->getElementsByTagName('img');
    return $imageNodes;
  }
}
