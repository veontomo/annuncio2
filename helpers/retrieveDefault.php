<?php
error_reporting (E_ALL);
require_once(dirname(__FILE__)."/classes/Origin.php");
require_once(dirname(__FILE__)."/classes/Ad.php");

/**
* Retrieves the ads from $url not "older" than $endtime and produces an array of ads
* String Datetime -> Array(Ads)
*/
function retrieveDefault($url, $endtime){
	//$keywords = strtolower("php, ruby, ror, web, programmator, javascript, js, html, css, russ");
	//$keywords = strtolower("scrivan, tavol");
	if(!$url) { 
		return array(); // return an emtpy array if the $url is not set 
	}
	$origin = new Origin;
	$origin->setUrl($url);
	$origin->url_template = '?th=1&o=COUNTER';
	$origin->starttime = time();
	$origin->endtime = $endtime;
	$origin->retrieve();
	return $origin->getAds();
}

/**
* filter the array of Ads
* Consider each ad in the array of Ads and if its body contains at least one of the keywords, 
* adds this ad to the output
*/
function filterAds($arrayAds, $keywords){
	$adSelected = array();
	foreach ($arrayAds as $ad) {
		if($ad->contains($keywords)){
			$adSelected[] = $ad;
		}
	}
	return $adSelected;
}
?>