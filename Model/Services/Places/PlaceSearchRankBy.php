<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

/**
 * PlacesServiceRankBy Specifies the order in which results are listed
 *
 * @see https://developers.google.com/places/documentation/#PlaceSearchRequests
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchRankBy
{
    const PROMINENCE    = 'prominence';
    const DISTANCE      = 'distance';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available rank by values
     *
     * @return array
     */
    public static function getValues()
    {
        return array(
            self::PROMINENCE,
            self::DISTANCE,
        );
    }
}