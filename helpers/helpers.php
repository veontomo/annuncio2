<?php
/**
* convert a date writen in italian into english into the following format:  d M Y H:i
* @param String $str 
* @return String Return a time formatted as "d M"  
* @example
*	Oggi 12:48 -> 12 Sep 2013 12:48
*	Ieri 14:03 -> 11 Sep 2013 14:03
*	6 ago 20:21 -> 6 Aug 2013 20:21
*
*/
function formatTime($str){
	$today = date("d M");
	$yesterday = date("d M", strtotime("-1 day"));
	$pattern = array('/Oggi/i', '/Ieri/i', '/gen/i', '/feb/i', '/mar/i', '/apr/i', '/mag/i', '/giu/i', '/lug/i', '/ago/i', '/set/i', '/ott/i', '/nov/i', '/dic/i');
	$repl = array_map(function($arg){
		return $arg.date(" Y");
		}, 
		array($today, $yesterday, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dic'));
	$str2 = preg_replace($pattern, $repl, $str);
	$result = date("d M Y H:i", strtotime($str2));
	return $result;
}	

/**
* Given a string, converts it in a time. If the string is bad-formed, a default time is given
* @param String $str
* @return String 
* @example
* 		setEndTime("16 Oct 2013") -> strtotime("16 Oct 2013")
*		setEndTime("16 Oct 2013 8:28") -> strtotime("16 Oct 2013 8:28")
*		setEndTime("blablabla") -> strtotime("-1 hour")
*/
function setEndTime($str){
	$output = strtotime($str);
	if(!$output){
		$output = strtotime("-1 hour");
	}
	return $output;
}

function dropDownListForEndTime($str){
	$arr = array('-1 hour' => "un'ora", '-2 hour' => "due ore", '-4 hour' => "quattro ore",
		'-10 hour' => "10 ore");
	$output = "";
	foreach ($arr as $key => $value) {
		$selected = strtotime($key)==$str ? " selected" : "";
		$output .= "<option value=\"$key\"$selected>$value</option>";
	}
	return $output;
}


?>