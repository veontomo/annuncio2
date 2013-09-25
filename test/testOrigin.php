<?php
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Origin.php');
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Ad.php');

class OriginTest extends PHPUnit_Framework_TestCase
{
    public function testPresenceOfProperties(){
        $this->assertClassHasAttribute('starttime', 'Origin');
        $this->assertClassHasAttribute('endtime', 'Origin');
        $this->assertClassHasAttribute('url', 'Origin');


        // $origin = $this->getMock('Origin', array('retrieve'));
        // $origin->expects($this->any())
        //         ->method('retrieve')
        //         ->will($this->returnValue(array()));

        $origin = new Origin;

        $ad1 = $this->getMock('Ad');
        $ad2 = $this->getMock('Ad');

        $ads = $origin->retrieve();
        $this->assertEquals('array', gettype($ads));
        foreach($ads as $ad){
            $this->assertInstanceOf('Ad', $ad);
            
        };


        // $origin->expects($this->any())
        //          ->method('retrieve')
        //          ->will($this->returnValue('time()'));
        // $this->assertEquals(60*60, $origin->starttime - $origin->endtime);
    }
}
?>