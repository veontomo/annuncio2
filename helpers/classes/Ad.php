<?php
class Ad{
	public $pubdate;
	public $url;
	public $author;
	public $content;

	public function contains($keywordString){
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