<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceEventResult;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;


/**
 * PlaceResult test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult PlaceSearch result tested
     */
    protected static $placeResult = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$placeResult = new PlaceResult();
    }

    /**
     * Check the icon getter/setter
     */
    public function testIcon()
    {
        self::$placeResult->setIcon('home.jpg');
        $this->assertEquals('home.jpg', self::$placeResult->getIcon());
        $this->assertTrue(self::$placeResult->hasIcon());
    }

    /**
     * Check the id getter/setter
     */
    public function testId()
    {
        self::$placeResult->setId($id = md5(time()));
        $this->assertEquals($id, self::$placeResult->getId());
        $this->assertTrue(self::$placeResult->hasId());
    }

    /**
     * Check the location getter/setter
     */
    public function testLocation()
    {
        self::$placeResult->setLocation(new Coordinate(48.856614, 2.352222));
        $this->assertEquals(new Coordinate(48.856614, 2.352222), self::$placeResult->getLocation());
        $this->assertTrue(self::$placeResult->hasLocation());
    }

    /**
     * Check the name getter/setter
     */
    public function testName()
    {
        self::$placeResult->setName('brasserie pierre');
        $this->assertEquals('brasserie pierre', self::$placeResult->getName());
        $this->assertTrue(self::$placeResult->hasName());
    }

    /**
     * Check the rating getter/setter
     */
    public function testRating()
    {
        self::$placeResult->setRating(4);
        $this->assertEquals(4, self::$placeResult->getRating());
        $this->assertTrue(self::$placeResult->hasRating());
    }

    /**
     * Check the reference getter/setter
     */
    public function testReference()
    {
        self::$placeResult->setReference($reference = sha1(time()));
        $this->assertEquals($reference, self::$placeResult->getReference());
        $this->assertTrue(self::$placeResult->hasReference());
    }

    /**
     * Check the type getter/setter
     */
    public function testTypes()
    {
        self::$placeResult->setTypes(array('bar', 'restaurant'));
        $this->assertEquals(array('bar', 'restaurant'), self::$placeResult->getTypes());
        $this->assertTrue(self::$placeResult->hasTypes());

        self::$placeResult->addType('establishment');
        $this->assertEquals(array('bar', 'restaurant', 'establishment'), self::$placeResult->getTypes());

        self::$placeResult->setTypes(array());
        $this->assertEquals(array(), self::$placeResult->getTypes());
        $this->assertFalse(self::$placeResult->hasTypes());
    }

    /**
     * Check the event getter/setter
     */
    public function testEvents()
    {
        self::$placeResult->setEvents(array(new PlaceEventResult(), new PlaceEventResult()));
        $this->assertEquals(
            array(new PlaceEventResult(), new PlaceEventResult()),
            self::$placeResult->getEvents()
        );
        $this->assertTrue(self::$placeResult->hasEvents());

        self::$placeResult->addEvent(new PlaceEventResult());
        $this->assertEquals(
            array(new PlaceEventResult(), new PlaceEventResult(), new PlaceEventResult()),
            self::$placeResult->getEvents()
        );

        self::$placeResult->setEvents(array());
        $this->assertEquals(array(), self::$placeResult->getEvents());
        $this->assertFalse(self::$placeResult->hasEvents());
    }

    /**
     * Check the vicinity getter/setter
     */
    public function testVicinity()
    {
        self::$placeResult->setVicinity('place balard, 75015 Paris');
        $this->assertEquals('place balard, 75015 Paris', self::$placeResult->getVicinity());
        $this->assertTrue(self::$placeResult->hasVicinity());
    }
}