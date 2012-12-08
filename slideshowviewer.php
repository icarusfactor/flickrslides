<?php   
        ini_set( 'display_errors', 1 );
        error_reporting(-1);
        //phpinfo();
        
        //echo $_GET["search"];
        $searchterms = $_GET["search"];       
        $sizew           = $_GET["width"]; 
        $sizeh            = $_GET["height"]; 

       
$output = ''; 

//$searchterms = "Linux,Open Source";
//$sizew =   "300";
//$sizeh =    "300";
$duration=5000;
$imgs=10;



$output .='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
$output .='<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" ><HEAD><META http-equiv="content-type" content="text/html; charset=UTF-8" />';

$output .='</HEAD><BODY>';

$output .= '<div id="container">';
  $output .= '<div id="slider"></div></div>';
  $output .= '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>';
  $output .= '<script type="text/javascript" src="http://www.userspace.org/extensions/Flickrslideshow/lib/slider.js"></script>';
  $output .= '<link href="http://www.userspace.org/extensions/Flickrslideshow/lib/slider.min.css" rel="stylesheet" type="text/css" />';
  $output .= '<script type="text/javascript">';
  $output .= '$(function(){';
  $output .= 'var slider = new Slider("#slider").setDuration('.$duration.');';
  $output .= 'slider.setSize('.$sizew.', '.$sizeh.');';

  $output .= 'var transitions = [\'squares\', \'circles\', \'circle\', \'diamond\', \'verticalSunblind\', \'verticalOpen\', \'clock\', \'transition-flip\', \'transition-left\', \'transition-zoomout\'];';
  $output .= 'setInterval(function(){';
  $output .= 'var transition = transitions[Math.floor(Math.random()*transitions.length)];';
  $output .= 'if(SliderTransitionFunctions[transition])';
  $output .= 'slider.setTransitionFunction(SliderTransitionFunctions[transition]);';
  $output .= 'else slider.setTransition(transition);';
  $output .= '}, 5555);';

  $output .= 'slider.fetchJson(\'http://www.flickr.com/services/rest/?jsoncallback=?\', {';
  $output .= 'method: \'flickr.photos.search\',';
  $output .= 'per_page: '.$imgs.',';
  $output .= 'format: \'json\',';
  $output .= 'api_key: \'be902d7f912ea43230412619cb9abd52\',';
  $output .= 'text: \''.$searchterms.'\'';
     
  $output .= '}, function(json){';
  $output .= 'return $.map(json.photos.photo, function(photo){';
  $output .= 'return {';
  $output .= 'link: \'http://www.flickr.com/photos/\'+photo.owner+\'/\'+photo.id,';
  $output .= 'src: \'http://farm\'+photo.farm+\'.static.flickr.com/\'+';
  $output .= 'photo.server+\'/\'+photo.id+\'_\'+photo.secret+\'_z.jpg\',';
  $output .= 'name: photo.title.substring(0,20)';
  $output .= '}';
  $output .= '});';
  $output .= '});';
  $output .= '});';
  $output .= '</script>';


$output .='</BODY></HTML>';


echo $output; 
  

?>