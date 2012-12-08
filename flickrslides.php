<?php
/**
 * MediaWiki Flickr Slides Extension                                                                                          
 * {{php}}{{Category:Extensions|Flickrslides }}                                                                               
 * @package MediaWiki                                                                                                        
 * @subpackage Extensions                                                                                                    
 * @author Daniel Yount  icarusfactor factorf2@yahoo.com                                                                     
 * @licence GNU General Public Licence 3.0 or later                                                                          
 *
 *
 *Installation:
 *	install this file in
 *	
 *		${IP}/extensions/Flickrslidesshow/flickslides.php
 *	
 *	and add the following line at the end of ${IP}/LocalSettings.php :
 *	
 *		require_once("$IP/extensions/Flickrslideshow/flickrslides.php");
**/


define('FLICKRSLIDES_VERSION','0.5');


$wgHooks['LanguageGetMagic'][] = 'wfIframeFSSLanguageGetMagic';
$wgExtensionFunctions[] = 'wfSetupIframeFSS';


/**
 * Protect against register_globals vulnerabilities.
 * This line must be present before any global variable is referenced.
**/
if(!defined('MEDIAWIKI')){
	echo("This is an extension to the MediaWiki package and cannot be run standalone.\n" );
	die(-1);
}


function wfIframeFSSLanguageGetMagic(&$magicWords,$langCode = 0) {
        $magicWords['flickrslides'] = array(0,'flickrslides');
        return true;
}
 
function wfSetupIframeFSS() {
        global $wgParser;
        $wgParser->setFunctionHook('flickrslides','wfRenderIframeFSS');
        return true;
}



/**
 * An array of extension types and inside that their names, versions, authors and urls. This credit information gets added to the wiki's Special:Version page, allowing users to see which extensions are installed, and to find more information about them.
**/
$wgExtensionCredits['parserhook'][] = array(
        'name'          =>      'flickrslides',
        'version'       =>       FLICKRSLIDES_VERSION ,
        'author'        =>      'Daniel Yount @icarusfactor factorf2@yahoo.com',
        'url'           =>      'N/A',
        'description'   =>      'Creates an iframe for an HTML Flickr Slideshow'
);

function wfRenderIframeFSS( &$parser )
	{
        $html='';        

        $argv = array();
        foreach (func_get_args() as $arg) if (!is_object($arg)) {
                if (preg_match('/^(.+?)\\s*=\\s*(.+)$/',$arg,$match)) $argv[$match[1]]=$match[2];
        }

        if(isset($argv['width'] ))  {  $width  = $argv['width' ]; } else { $width  = 300; }; 
        if(isset($argv['height']))  {  $height = $argv['height']; } else { $height = 300; };        
        if(isset($argv['search']))  {  $searchterms = $argv['search']; } else { return $html; };      
        $scrolling='no';

        //This will be the url to the php HTML segment to embed in the iframe. Variables will be added dynamically.  
        $url=   "http://www.userspace.org/extensions/Flickrslideshow/slideshowviewer.php";

       $data = array( 'search'=>$searchterms  ,  'width'=>$width ,  'height'=>$height  );

       $uquery = http_build_query($data,'','&');
     
       $urlquery = $url.'?'.$uquery;

       $html .= '<iframe height='.$height.' width='.$width.' frameborder=0 scrolling="'.$scrolling.'" src ="'.$urlquery.'" ></iframe>';  

       return $parser->insertStripItem( $html, $parser->mStripState );  
  
         
	}

?>





