<?php
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Origin.php');
require (dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Ad.php');

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
        $origin->setUrl("http://www.subito.it/annunci-lazio/vendita/arredamento-casalinghi/");

        $origin->retrieve();
        $this->assertEquals('array', gettype($origin->getAds()));
        foreach($origin->getAds() as $ad){
            $this->assertInstanceOf('Ad', $ad);
            
        };


        // $origin->expects($this->any())
        //          ->method('retrieve')
        //          ->will($this->returnValue('time()'));
        // $this->assertEquals(60*60, $origin->starttime - $origin->endtime);
    }

    public function testSetProvider(){
        $origin = new Origin;
        $origin->setUrl('http://www.subito.it/annunci-lazio/vendita/arredamento-casalinghi/');
        $this->assertEquals('www.subito.it', $origin->getHost());
        
        $origin = new Origin;
        $origin->setUrl('https://www.subito.it/annunci-lazio/vendita');
        $this->assertEquals('www.subito.it', $origin->getHost());


        $origin = new Origin;
        $origin->setUrl('https://subito.it/annunci-lazio/vendita/arredamento-casalinghi/');
        $this->assertNull($origin->getHost());

        $origin = new Origin;
        $origin->setUrl('https://www.portaportese.it/subito');
        $this->assertEquals('www.portaportese.it', $origin->getHost());

        $origin = new Origin;
        $origin->setUrl('http://portaportese.it');
        $this->assertNull($origin->getHost());

    }
}
?>