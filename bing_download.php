<?php

  $save_folder = 'Users/bing/';
  // rename this to your own folder name see below.
  // 'Users/mine/bing/'

  // /az/hprichbg/rb/GoldBridge_EN-GB5579326717_1920x1080.jpg

  $url = 'https://www.bing.com';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $content = curl_exec($ch);
  //echo $content;

  preg_match("!/az/hprichbg/rb/(.*?).jpg!",$content,$image_match);
  print_r($image_match);
  $image_url = $url.$image_match[0];  // full image url
  $image_name = $image_match[1].'.jpg';  // file name
  $save_path = $save_folder.$image_name;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $image_url);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
  $binary_data = curl_exec($ch);
  curl_close($ch);


  if(file_exists($save_path)) {
    unlink($save_path);
  }
  $fh = fopen($save_path, 'x'); // create an open for write only.
  fwrite($fh, $binary_data);
  fclose($fh);
?>
