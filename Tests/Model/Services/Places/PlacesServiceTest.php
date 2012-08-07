<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlacesService;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsService;

/**
 * PlacesService test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlacesServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Places\PlacesService tested
     */
    protected static $placesService = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$placesService = new PlacesService();
    }

    /**
     * Checks place search service getter/setter
     */
    public function testPlaceSearchService()
    {
        self::$placesService->setPlaceSearchService(new PlaceSearchService());
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService', self::$placesService->getPlaceSearchService());
    }

    /**
     * Checks place search service getter/setter
     */
    public function testPlaceDetailsService()
    {
        self::$placesService->setPlaceDetailsService(new PlaceDetailsService());
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsService', self::$placesService->getPlaceDetailsService());
    }
}