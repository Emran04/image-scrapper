<?php

class HTTP
{
  /**
   * HTTP get call to a given url
   * 
   * @param string $url
   * 
   * @return mixed
   */
  public static function get($url)
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $html = curl_exec($ch);

    return $html;
  }
}
