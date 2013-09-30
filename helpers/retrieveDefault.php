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
$origin->endtime = strtotime('-1 hour');
$origin->retrieve();
$adSelected = array();
$ads = $origin->getAds();
?>