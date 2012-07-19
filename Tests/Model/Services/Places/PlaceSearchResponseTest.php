<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse;

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
        self::$placeSearchResponse = new PlaceSearchResponse();
    }
}