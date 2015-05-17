<?php
 include_once("check_login_status.php");
// $api_key = '448f0f1bc07bf3fc39984048aa98f25b';
 
// $tag = 'flower,bird,peacock';
// $perPage = 3;

// $url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
// $url.= '&api_key='.$api_key;
// $url.= '&tags='.$tag;
// $url.= '&per_page='.$perPage;
// $url.= '&format=json';
// $url.= '&nojsoncallback=1';

// $url = 'https://api.flickr.com/services/rest/?method=flickr.photos.getSizes';
// $url.= '&api_key='.$api_key;
// $url.= '&photo_id='.'4856851291';
// // $url.= '&per_page='.$perPage;
// $url.= '&format=json';
// $url.= '&nojsoncallback=1';

// $response = json_decode(file_get_contents($url));
// // echo $url;
// // exit;
// // $response = @file_get_contents($url);
// echo '<pre>';
// var_dump($response);
// echo '</pre>';
// exit;
// $photo_array = $response->photos->photo;

// // print ("<pre>");
// // print_r($response);
// // print ("</pre>");
 
// foreach($photo_array as $single_photo){
 
// $farm_id = $single_photo->farm;
// $server_id = $single_photo->server;
// $photo_id = $single_photo->id;
// $secret_id = $single_photo->secret;
// $size = 'l';
 
// $title = $single_photo->title;
 
// $photo_url = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';
 
// print "<img title='".$title."' src='".$photo_url."' />";
 
// }

$exp = Expertise::getExpertiseFromUserId(31, $db);
// echo Expertise::$table;
var_dump($exp);
?>
