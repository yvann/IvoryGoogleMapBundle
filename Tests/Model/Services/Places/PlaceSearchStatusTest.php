<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus;

/**
 * PlaceSearchStatus test
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchStatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $placeSearchStatusTest = new PlaceSearchStatus();
            $this->fail('The class "Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus" can not be instanciated.');
        }
        catch(\Exception $e){}
    }

    /**
     * Checks the place search status getter
     */
    public function testPlaceSearchStatus()
    {
        $this->assertGreaterThan(0, count(PlaceSearchStatus::getStatuses()));
    }
}