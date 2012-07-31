<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services\Directions;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRankBy;

/**
 * PlaceSearchRequestService test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchRequestServiceTest extends WebTestCase
{
    /**
     * Checks the place search request service without configuration
     */
    public function testPlaceSearchRequestServiceWithoutConfiguration()
    {
        $request = self::createContainer()->get('ivory_google_map.place_search_request');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest', $request);
        $this->assertFalse($request->hasSensor());
        $this->assertFalse($request->hasLanguage());
        $this->assertFalse($request->hasKey());
        $this->assertFalse($request->hasLocation());
        $this->assertFalse($request->hasRadius());
        $this->assertFalse($request->hasKeyword());
        $this->assertFalse($request->hasName());
        $this->assertFalse($request->hasTypes());
        $this->assertFalse($request->hasPageToken());
        $this->assertEquals(PlaceSearchRankBy::PROMINENCE, $request->getRankBy());
    }

    /**
     * Checks the place search request service with configuration
     */
    public function testPlaceSearchRequestServiceWithConfiguration()
    {
        $request = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.place_search_request');

        $this->assertTrue($request->hasSensor());
        $this->assertTrue($request->hasLanguage());
        $this->assertTrue($request->hasKey());
        $this->assertEquals(PlaceSearchRankBy::PROMINENCE, $request->getRankBy());
    }
}
