<?php
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'helpers.php');

class Origin{
	public function __construct(){
		$this->starttime = time();
		$this->endtime = strtotime('-1 hour');
		$this->ads = array();
		$this->maxPage = 3;
	}

	public $starttime;
	public $endtime;
	public $url;
	public $url_template;
	private $ads;
	public $maxPage;

	/**
	* retrieves the content of the $url, fills in the property $ads with the advertisments found on that $url.
	*/
	public function retrieveOnePage($url){
		// $output = array();
		$doc = new DOMDocument();
		$previousSetting = libxml_use_internal_errors(true);// the previuos value of libxml_use_internal_errors
		$content = preg_replace('/\<br( )*\/>/', " ", file_get_contents($url));

		$doc->loadHTML($content);
		libxml_use_internal_errors($previousSetting); // set the initial value of libxml_use_internal_errors
		
		$xpath = new DOMXpath($doc);
		$ads = $xpath->query("//*/ul[@class='list']/li");
		foreach ($ads as $ad) {
			$adCurrent = new Ad;

			$adDivs = $ad->getElementsByTagName("div");
			foreach ($adDivs as $adDiv) {
				if($adDiv->hasAttribute('class') && $adDiv->getAttribute('class') == 'date'){
					$adCurrent->pubdate = formatTime($adDiv->nodeValue);
				}
				if($adDiv->hasAttribute('class') && $adDiv->getAttribute('class') == 'descr'){
					$adCurrent->content = trim($adDiv->nodeValue);
					$links = $adDiv->getElementsByTagName('a');
					foreach ($links as $link) {
						$adCurrent->url .= $this->url.$link->getAttribute('href');
					}
				}
			}
			// echo __METHOD__, ' adding to ads<br/>', PHP_EOL;
			// print_r($adCurrent);
			$this->ads[] = $adCurrent;
			// echo 'ads length: ', count($this->ads), '<br />';
 		}
		
	}

	public function retrieve(){
		$url = $this->url;
		$pageCount = 2;
		do {
			$this->retrieveOnePage($url);
			$lastAd = end($this->ads);
			$date = $lastAd->pubdate;
			$isEnough = $this->endtime > strtotime($date);
			$url = $this->url.preg_replace('/COUNTER/', $pageCount, $this->url_template);
			$pageCount++;
		} while (!$isEnough && ($pageCount < 3 + $this->maxPage));

	}

	public function getAds(){
		return $this->ads;
	}


}
?>