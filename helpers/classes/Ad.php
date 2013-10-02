<?php
class Ad{
	public $pubdate;
	public $url;
	public $author;
	public $content;


	/**
	* return true if the content attribute of the ad contains one of the comma-separated string of words
	* if $keywordString is empty, the method returns true.
	* @param String $keywordString  a comma separated string of words
	*
	*/
	public function contains($keywordString){
		if($keywordString=="") return true; 
		$output = false;
		$keywordArray = array_map('trim', explode(',', strtolower($keywordString)));
		$text = strtolower($this->content);
		foreach ($keywordArray as $keyword) {
			if($keyword && strpos($text, $keyword) !== false){
				$output = true;
				break;
			}
		}
		return $output;
	}
}
?>