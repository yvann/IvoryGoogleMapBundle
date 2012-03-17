<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService;

/**
 * Google map places service
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference#PlacesService
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlacesService
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService A PlaceSearchService
     */
    protected $placeSearchService = null;

    /**
     * Sets the place search service
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService $placeSearchService
     */
    public function setPlaceSearchService(PlaceSearchService $placeSearchService)
    {
        $this->placeSearchService = $placeSearchService;
    }
}