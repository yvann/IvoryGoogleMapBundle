<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRankBy;

/**
 * PlaceSearchRankBy test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchRankByTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $placeSearchRankByTest = new PlaceSearchRankBy();
            $this->fail('The class "Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRankBy" can not be instanciated.');
        }
        catch(\Exception $e){}
    }

    /**
     * Checks the place search RankBy getter
     */
    public function testPlaceSearchRankBy()
    {
        $this->assertGreaterThan(0, count(PlaceSearchRankBy::getValues()));
    }
}