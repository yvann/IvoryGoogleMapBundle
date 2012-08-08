<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services\Directions;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRankBy;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlacesService test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlacesServiceTest extends WebTestCase
{
    public function testExecuteInArea()
    {
        $container = self::createContainer(array('environment' => 'test'));

        $placeSearchRequest = $container->get('ivory_google_map.place_search_request');
        $placeSearchRequest
            ->setLanguage('fr')
            ->setTypes(array('restaurant', 'bar', 'food'))
            ->setRadius(5000)
            ->setLocation(new Coordinate(48.856614, 2.352222)); // Paris, France

        $placeSearchResponse = $container->get('ivory_google_map.places')
            ->execute($placeSearchRequest, true);

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

            if (0 < count($result->getEvents())) {
                foreach ($result->getEvents() as $event) {
                    $this->assertInstanceOf(
                        'Ivory\GoogleMapBundle\Model\Services\Places\PlaceEventResult',
                        $event
                    );
                }
            }

            if (0 < count($result->getReviews())) {
                foreach ($result->getReviews() as $review) {
                    $this->assertGreaterThan(
                        0,
                        count($review->getAspects())
                    );
                }
            }
        }
    }
}
