<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest;

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
}