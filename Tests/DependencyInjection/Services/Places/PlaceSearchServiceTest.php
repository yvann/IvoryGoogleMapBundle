<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services\Directions;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRankBy;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlaceSearchService test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchServiceTest extends WebTestCase
{
    /**
     * Checks the place search service without configuration
     */
    public function testPlaceSearchServiceWithoutConfiguration()
    {
        $service = self::createContainer()->get('ivory_google_map.place_search');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService', $service);
        $this->assertEquals('http://maps.googleapis.com/maps/api/place/search', $service->getUrl());
        $this->assertEquals('json', $service->getFormat());
    }

    /**
     * Checks the place search service with configuration
     */
    public function testPlaceSearchServiceWithConfiguration()
    {
        $service = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.place_search');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService', $service);
        $this->assertEquals('https://maps.googleapis.com/maps/api/place/search', $service->getUrl());
        $this->assertEquals('json', $service->getFormat());
        $this->assertTrue($service->isHttps());
    }

    public function testExecuteInEmptyArea()
    {
        $container = self::createContainer(array('environment' => 'test'));

        $placeSearchRequest = $container->get('ivory_google_map.place_search_request');
        $placeSearchRequest
            ->setTypes(array('museum'))
            ->setRadius(500)
            ->setLocation(new Coordinate(82.3558, -72.070312)); // North Groenland

        $placeSearchResponse = $container->get('ivory_google_map.place_search')
            ->execute($placeSearchRequest);

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse',
            $placeSearchResponse
        );

        $this->assertEquals(
            PlaceSearchStatus::ZERO_RESULTS,
            $placeSearchResponse->getStatus()
        );

        $this->assertEquals(
            0,
            count($placeSearchResponse->getResults())
        );
    }

    public function testExecuteInArea()
    {
        $container = self::createContainer(array('environment' => 'test'));

        $placeSearchRequest = $container->get('ivory_google_map.place_search_request');
        $placeSearchRequest
            ->setLanguage('fr')
            ->setTypes(array('restaurant', 'bar', 'food'))
            ->setRadius(10000)
            ->setLocation(new Coordinate(48.856614, 2.352222)); // Paris, France

        $placeSearchResponse = $container->get('ivory_google_map.place_search')
            ->execute($placeSearchRequest);

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse',
            $placeSearchResponse
        );

        $this->assertEquals(
            PlaceSearchStatus::OK,
            $placeSearchResponse->getStatus()
        );

        $this->assertGreaterThan(
            0,
            count($placeSearchResponse->getResults())
        );

        foreach ($placeSearchResponse->getResults() as $result) {
            $this->assertInstanceOf(
                'Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult',
                $result
            );
        }
    }
}
