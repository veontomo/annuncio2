<?php
error_reporting (E_ALL);
require_once(dirname(__FILE__)."/classes/Origin.php");
require_once(dirname(__FILE__)."/classes/Ad.php");

//$keywords = strtolower("php, ruby, ror, web, programmator, javascript, js, html, css, russ");
$keywords = strtolower("scrivan, tavol");
$origin = new Origin;
//$origin->url = "http://www.subito.it/annunci-lazio/vendita/offerte-lavoro/";
$origin->url = "http://www.subito.it/annunci-lazio/vendita/arredamento-casalinghi/";
$origin->url_template = '?th=1&o=COUNTER';
$origin->starttime = time();
$origin->endtime = strtotime('-10 hour');
$origin->retrieve();
$adSelected = array();
$ads = $origin->getAds();



echo "url: {$origin->url}<br />keywords: $keywords<br />";

echo count($ads), ' ads were retrieved.<br />';

foreach ($ads as $ad) {
	if($ad->contains($keywords)){
		$adSelected[] = $ad;
	}
}
if(count($adSelected)>0){
	echo 'Among them these are interesting: <br />';
	foreach($adSelected as $ad){
		echo $ad->pubdate, ': <a href="'.$ad->url.'">', $ad->content, '</a><br />';
	}
}else{
	echo 'Nothing interesting is found!<br />';
}

?>