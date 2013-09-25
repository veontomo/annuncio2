<?php
/**
* convert a date writen in italian into english into the following format:  d M Y H:i
* example: 
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


?>