<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult;

/**
 * PlaceSearchResponse test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse PlaceSearch response tested
     */
    protected static $placeSearchResponse = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$placeSearchResponse = new PlaceSearchResponse(array(), PlaceSearchStatus::OK);
    }

    /**
     * Checks the places getter/setter
     */
    public function testPlaces()
    {
        $this->assertEquals(0, count(self::$placeSearchResponse->getResults()));

        self::$placeSearchResponse->addResult(new PlaceResult());
        $this->assertEquals(1, count(self::$placeSearchResponse->getResults()));
    }

    /**
     * Checks the status getter & setter
     */
    public function testStatus()
    {
        $this->assertEquals(self::$placeSearchResponse->getStatus(), PlaceSearchStatus::OK);

        self::$placeSearchResponse->setStatus(PlaceSearchStatus::INVALID_REQUEST);
        $this->assertEquals(self::$placeSearchResponse->getStatus(), PlaceSearchStatus::INVALID_REQUEST);

        $this->setExpectedException('InvalidArgumentException');
        self::$placeSearchResponse->setStatus('foo');
    }
}