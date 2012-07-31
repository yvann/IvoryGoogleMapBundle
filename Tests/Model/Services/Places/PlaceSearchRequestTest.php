<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRankBy;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlaceSearchRequest test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest PlaceSearch request tested
     */
    protected static $placeSearchRequest = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$placeSearchRequest = new PlaceSearchRequest();
    }

    /**
     * Checks the default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(PlaceSearchRankBy::PROMINENCE, self::$placeSearchRequest->getRankBy());
        $this->assertFalse(self::$placeSearchRequest->hasLocation());
        $this->assertFalse(self::$placeSearchRequest->hasRadius());
        $this->assertFalse(self::$placeSearchRequest->hasKeyword());
        $this->assertFalse(self::$placeSearchRequest->hasLanguage());
        $this->assertFalse(self::$placeSearchRequest->hasName());
        $this->assertFalse(self::$placeSearchRequest->hasTypes());
    }

    /**
     * Checks the location getter/setter
     */
    public function testLocation()
    {
        self::$placeSearchRequest->setLocation(new Coordinate(48.856614, 2.352222));
        $this->assertEquals(new Coordinate(48.856614, 2.352222), self::$placeSearchRequest->getLocation());
        $this->assertTrue(self::$placeSearchRequest->hasLocation());
    }

    /**
     * Check the radius getter/setter
     */
    public function testRadius()
    {
        self::$placeSearchRequest->setRadius(500);
        $this->assertEquals(500, self::$placeSearchRequest->getRadius());
        $this->assertTrue(self::$placeSearchRequest->hasRadius());
    }

    /**
     * Check the keyword getter/setter
     */
    public function testKeyword()
    {
        self::$placeSearchRequest->setKeyword('Un endroit sympa');
        $this->assertEquals('Un endroit sympa', self::$placeSearchRequest->getKeyword());
        $this->assertTrue(self::$placeSearchRequest->hasKeyword());
    }

    /**
     * Check the language getter/setter
     */
    public function testLanguage()
    {
        self::$placeSearchRequest->setLanguage('fr');
        $this->assertEquals('fr', self::$placeSearchRequest->getLanguage());
        $this->assertTrue(self::$placeSearchRequest->hasLanguage());
    }

    /**
     * Check the name getter/setter
     */
    public function testName()
    {
        self::$placeSearchRequest->setName('brasserie pierre');
        $this->assertEquals('brasserie pierre', self::$placeSearchRequest->getName());
        $this->assertTrue(self::$placeSearchRequest->hasName());
    }

    /**
     * Check the types getter/setter
     */
    public function testTypes()
    {
        self::$placeSearchRequest->setTypes(array('bar', 'restaurant'));
        $this->assertEquals(array('bar', 'restaurant'), self::$placeSearchRequest->getTypes());
        $this->assertTrue(self::$placeSearchRequest->hasTypes());

        self::$placeSearchRequest->addType('establishment');
        $this->assertEquals(array('bar', 'restaurant', 'establishment'), self::$placeSearchRequest->getTypes());

        self::$placeSearchRequest->setTypes(array());
        $this->assertEquals(array(), self::$placeSearchRequest->getTypes());
        $this->assertFalse(self::$placeSearchRequest->hasTypes());
    }

    /**
     * Check the rank by getter/setter
     */
    public function testRankByProminence()
    {
        self::$placeSearchRequest = new PlaceSearchRequest();

        self::$placeSearchRequest->setRankBy(PlaceSearchRankBy::PROMINENCE);
        $this->assertEquals(PlaceSearchRankBy::PROMINENCE, self::$placeSearchRequest->getRankBy());
    }

    /**
     * Check the rank by getter/setter
     */
    public function testRankByDistanceWithRadius()
    {
        self::$placeSearchRequest = new PlaceSearchRequest();

        self::$placeSearchRequest->setRadius(5000);
        $this->setExpectedException('InvalidArgumentException');
        self::$placeSearchRequest->setRankBy(PlaceSearchRankBy::DISTANCE);
    }

    /**
     * Check the rank by getter/setter
     */
    public function testRankByDistanceWithoutRadiusWithoutOtherParameter()
    {
        self::$placeSearchRequest = new PlaceSearchRequest();

        self::$placeSearchRequest->setRadius(null);
        $this->setExpectedException('InvalidArgumentException');
        self::$placeSearchRequest->setRankBy(PlaceSearchRankBy::DISTANCE);
    }

    /**
     * Check the rank by getter/setter
     */
    public function testRankByDistanceWithoutRadiusWithOtherParameter()
    {
        self::$placeSearchRequest = new PlaceSearchRequest();

        self::$placeSearchRequest
            ->setRadius(null)
            ->setTypes(array('restaurant', 'bar'))
            ->setRankBy(PlaceSearchRankBy::DISTANCE);
        $this->assertEquals(PlaceSearchRankBy::DISTANCE, self::$placeSearchRequest->getRankBy());
    }
}