<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

/**
 * PlacesServiceStatus represents a google map places request status
 *
 * @see https://developers.google.com/maps/documentation/places/#PlaceSearchStatusCodes
 * @author Yvann Boucher <gyvann.boucher@gmail.com>
 */
class PlaceSearchStatus
{
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const OK = 'OK';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const ZERO_RESULTS = 'ZERO_RESULTS';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available place search statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return array(
            self::INVALID_REQUEST,
            self::OK,
            self::OVER_QUERY_LIMIT,
            self::REQUEST_DENIED,
            self::ZERO_RESULTS
        );
    }
}