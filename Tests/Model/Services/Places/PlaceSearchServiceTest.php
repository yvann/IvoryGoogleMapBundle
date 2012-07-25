<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Tests\Model\Services\AbstractServiceTest;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlaceSearchService test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchServiceTest extends AbstractServiceTest
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$service = new PlaceSearchService();
        self::$service
            ->setKey($_SERVER['API_KEY'])
            ->setHttps(true);
    }

    public static function executeMethod($name, array $args = array())
    {
        $class = new \ReflectionClass(self::$service);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs(self::$service, $args);
    }

    public function testDefaultValues()
    {
        $this->assertTrue(self::$service->isHttps());
        $this->assertEquals(self::$service->getFormat(), 'json');
        $this->assertEquals(self::$service->getUrl(), 'https://maps.googleapis.com/maps/api/place/search');
    }

    public function testExecute()
    {
        $placeSearchRequest = new PlaceSearchRequest();

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse',
            self::$service->execute($placeSearchRequest)
        );

        $placeSearchRequest->setLanguage('fr');
        $placeSearchRequest->setKeyword(implode(',', array('restaurant', 'bar')));
        $placeSearchRequest->setRadius(5000);
        $placeSearchRequest->setLocation(new Coordinate(48.856614, 2.352222));

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse',
            self::$service->execute($placeSearchRequest)
        );

        if (PlaceSearchStatus::ZERO_RESULTS === self::$service->execute($placeSearchRequest)->getStatus()) {
            $this->assertEquals(
                0,
                count(self::$service->execute($placeSearchRequest)->getResults())
            );
        } else {
            $this->assertGreaterThan(
                0,
                count(self::$service->execute($placeSearchRequest)->getResults())
            );

            foreach (self::$service->execute($placeSearchRequest)->getResults() as $result) {
                $this->assertInstanceOf(
                    'Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult',
                    $result
                );
            }
        }
    }

    public function testGenerateUrl()
    {
        $placeSearchRequest = new PlaceSearchRequest();
        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false',
                self::$service->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );

        $placeSearchRequest->setLanguage('fr');
        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false&language=fr',
                self::$service->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );

        $placeSearchRequest->setKeyword(implode(',', array('vin', 'viande')));
        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false&language=fr&keyword=vin%%2Cviande',
                self::$service->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );

        $placeSearchRequest->setRadius(50);
        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false&radius=50&language=fr&keyword=vin%%2Cviande',
                self::$service->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );
    }
}