<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

/**
 * PlaceDetailsStatus represents a google map places request status
 *
 * @see https://developers.google.com/maps/documentation/places/#PlaceDetailsStatusCodes
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceDetailsStatus
{
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const OK = 'OK';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const ZERO_RESULTS = 'ZERO_RESULTS';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const NOT_FOUND = 'NOT_FOUND';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available place details statuses
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
            self::ZERO_RESULTS,
            self::UNKNOWN_ERROR,
            self::NOT_FOUND
        );
    }
}