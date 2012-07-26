<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlaceSearchResult test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult PlaceSearch result tested
     */
    protected static $placeSearchResult = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$placeSearchResult = new PlaceSearchResult();
    }

    /**
     * Check the icon getter/setter
     */
    public function testIcon()
    {
        self::$placeSearchResult->setIcon('home.jpg');
        $this->assertEquals('home.jpg', self::$placeSearchResult->getIcon());
        $this->assertTrue(self::$placeSearchResult->hasIcon());
    }

    /**
     * Check the id getter/setter
     */
    public function testId()
    {
        self::$placeSearchResult->setId($id = md5(time()));
        $this->assertEquals($id, self::$placeSearchResult->getId());
        $this->assertTrue(self::$placeSearchResult->hasId());
    }

    /**
     * Check the location getter/setter
     */
    public function testLocation()
    {
        self::$placeSearchResult->setLocation(new Coordinate(48.856614, 2.352222));
        $this->assertEquals(new Coordinate(48.856614, 2.352222), self::$placeSearchResult->getLocation());
        $this->assertTrue(self::$placeSearchResult->hasLocation());
    }

    /**
     * Check the name getter/setter
     */
    public function testName()
    {
        self::$placeSearchResult->setName('brasserie pierre');
        $this->assertEquals('brasserie pierre', self::$placeSearchResult->getName());
        $this->assertTrue(self::$placeSearchResult->hasName());
    }

    /**
     * Check the rating getter/setter
     */
    public function testRating()
    {
        self::$placeSearchResult->setRating(4);
        $this->assertEquals(4, self::$placeSearchResult->getRating());
        $this->assertTrue(self::$placeSearchResult->hasRating());
    }

    /**
     * Check the reference getter/setter
     */
    public function testReference()
    {
        self::$placeSearchResult->setReference($reference = sha1(time()));
        $this->assertEquals($reference, self::$placeSearchResult->getReference());
        $this->assertTrue(self::$placeSearchResult->hasReference());
    }

    /**
     * Check the type getter/setter
     */
    public function testTypes()
    {
        self::$placeSearchResult->setTypes(array('bar', 'restaurant'));
        $this->assertEquals(array('bar', 'restaurant'), self::$placeSearchResult->getTypes());
        $this->assertTrue(self::$placeSearchResult->hasTypes());

        self::$placeSearchResult->addType('establishment');
        $this->assertEquals(array('bar', 'restaurant', 'establishment'), self::$placeSearchResult->getTypes());

        self::$placeSearchResult->setTypes(array());
        $this->assertEquals(array(), self::$placeSearchResult->getTypes());
        $this->assertFalse(self::$placeSearchResult->hasTypes());
    }

    /**
     * Check the vicinity getter/setter
     */
    public function testVicinity()
    {
        self::$placeSearchResult->setVicinity('place balard, 75015 Paris');
        $this->assertEquals('place balard, 75015 Paris', self::$placeSearchResult->getVicinity());
        $this->assertTrue(self::$placeSearchResult->hasVicinity());
    }
}