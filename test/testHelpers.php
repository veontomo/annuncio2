<?php
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'helpers.php');

class HelpersTest extends PHPUnit_Framework_TestCase
{
    public function testFormatTime(){
        $today = date("d M");
        $yesterday = date("d M", strtotime("-1 day"));
        $year = date("Y");
        $this->assertEquals(formatTime("Oggi 12:48"), "$today $year 12:48");
        $this->assertEquals(formatTime("Ieri 02:48"), "$yesterday $year 02:48");
        $this->assertEquals(formatTime("20 ago 22:14"), "20 Aug $year 22:14");
        $this->assertEquals(formatTime("01 gen 22:14"), "01 Jan $year 22:14");
        $this->assertEquals(formatTime("01 Feb 22:14"), "01 Feb $year 22:14");
        $this->assertEquals(formatTime("01 mar 2:14"), "01 Mar $year 02:14");
    }   


}
?>