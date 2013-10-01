<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'helpers.php';

class Origin{
	public function __construct(){
		$this->starttime = time();
		$this->endtime = strtotime('-1 hour');
		$this->ads = array();
		$this->maxPage = 3;
	}

	public $starttime;
	public $endtime;
	private $url;
	public $url_template;
	private $ads;
	public $maxPage;
	private $host;

	private $supportedHosts = array('www.subito.it', 'www.portaportese.it');

	/**
	* set url and imposes the provider based on the url
	*/
	public function setUrl($str){
		$this->url = $str;
		$host = parse_url($this->url)['host'];
		foreach ($this->supportedHosts as $supportedHost) {
			if($host === $supportedHost){
				$this->host = $supportedHost;
				break;
			}
		}
	}

	public function getHost(){
		return $this->host;
	}

	/**
	* retrieves the content of the $url, fills in the property $ads with the advertisments found on that $url.
	*/
	private function retrieveOnePageSubito($url){
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
						$adCurrent->url .= $this->url.basename($link->getAttribute('href'));
					}
				}
			}
			// echo __METHOD__, ' adding to ads<br/>', PHP_EOL;
			// print_r($adCurrent);
			$this->ads[] = $adCurrent;
			// echo 'ads length: ', count($this->ads), '<br />';
 		}
		
	}

	private function retrieveAllSubito(){
		$url = $this->url;
		$pageCount = 2;
		do {
			$this->retrieveOnePageSubito($url);
			$lastAd = end($this->ads);
			$date = $lastAd->pubdate;
			$isEnough = $this->endtime > strtotime($date);
			$url = $this->url.preg_replace('/COUNTER/', $pageCount, $this->url_template);
			$pageCount++;
		} while (!$isEnough && ($pageCount < 3 + $this->maxPage));

	}

	/**
	*	Calls the corresponding methods for retrieving the ads based on the  provider name
	* it is better to rewrite this method: 
	* if the provider is 'www.subito.it', call the method retrieveAllSubito()
	* if the provider is 'www.portaportese.it', call the method retrieveAllPortaportese()
	*/
	public function retrieve(){
		switch ($this->host) {
			case 'www.subito.it':
				$this->retrieveAllSubito();
				break;
			case 'www.portaportese.it':
				// call the appropriate method when it is written
				break;
		}
	}

	public function getAds(){
		return $this->ads;
	}

}
?>