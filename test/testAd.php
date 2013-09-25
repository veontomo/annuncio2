<?php
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Ad.php');

class AdTest extends PHPUnit_Framework_TestCase
{
    public function testPresenceOfProperties(){
        $this->assertClassHasAttribute('pubdate', 'Ad');
        $this->assertClassHasAttribute('url', 'Ad');
        $this->assertClassHasAttribute('author', 'Ad');
        $this->assertClassHasAttribute('content', 'Ad');

        $ad = new Ad;

        // $origin = $this->getMock('Origin', array('starttime'));

        // $origin->expects($this->any())
        //          ->at('starttime')
        //          ->will($this->returnValue('time()'));
        //$this->assertEquals(60*60, $origin->starttime - $origin->endtime);
    }

    public function testContains(){
        $ad = new Ad;
        $ad->content = "cercasi php5.1 new java Docente";
        $this->assertTrue($ad->contains("pHp, docent"));
        $this->assertFalse($ad->contains("Ruby, javascript"));
    }
}
?>