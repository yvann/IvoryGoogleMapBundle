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
        $placeSearchRequest
            ->setKey('123456789abcdefghijklmnopqrstuvwxyz');

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse',
            self::$service->execute($placeSearchRequest)
        );
    }

    public function testGenerateUrl()
    {
        $placeSearchRequest = new PlaceSearchRequest();
        $placeSearchRequest
            ->setKey('123456789abcdefghijklmnopqrstuvwxyz');

        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false',
                $placeSearchRequest->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );

        $placeSearchRequest->setLanguage('fr');
        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false&language=fr',
                $placeSearchRequest->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );

        $placeSearchRequest->setKeyword(implode(',', array('vin', 'viande')));
        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false&language=fr&keyword=vin%%2Cviande',
                $placeSearchRequest->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );

        $placeSearchRequest->setRadius(50);
        $this->assertEquals(
            sprintf(
                'https://maps.googleapis.com/maps/api/place/search/json?key=%s&sensor=false&radius=50&language=fr&keyword=vin%%2Cviande',
                $placeSearchRequest->getKey()
            ),
            self::executeMethod('generateUrl', array($placeSearchRequest))
        );
    }
}