<?php
if(isset($_POST['keywords'])){
	require_once(dirname(__FILE__)."/classes/Origin.php");
	require_once(dirname(__FILE__)."/classes/Ad.php");
	require_once(dirname(__FILE__)."/helpers.php");

	$origin = new Origin;
	$origin->setUrl(htmlspecialchars($_POST['target']));
	$origin->url_template = '?th=1&o=COUNTER';
	$origin->starttime = time();
	$origin->endtime = setEndTime($_POST['end-time']);
	$origin->retrieve();
	$adSelected = array();
	$ads = $origin->getAds();

	foreach ($ads as $ad) {
		if($ad->contains($_POST['keywords'])){
			$adSelected[] = $ad;
		}
	}

	echo json_encode(array('success' => true, 'result' => $adSelected));
}else{
	echo json_encode(array('success' => false));
}

?>