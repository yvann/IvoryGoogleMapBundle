<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult;

/**
 * PlaceSearchResult test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult PlaceSearch result tested
     */
    protected static $placeSearchResult = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$placeSearchResult = new PlaceSearchResult();
    }
}