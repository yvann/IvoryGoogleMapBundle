<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Symfony\Component\DependencyInjection\ContainerAware;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsService;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsRequest;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsStatus;

/**
 * Google map places service
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference#PlacesService
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlacesService extends ContainerAware
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

    /**
     * Gets the place search service
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchService
     */
    public function getPlaceSearchService()
    {
        return $this->placeSearchService;
    }

    /**
     * Sets the place details service
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsService $placeDetailsService
     */
    public function setPlaceDetailsService(PlaceDetailsService $placeDetailsService)
    {
        $this->placeDetailsService = $placeDetailsService;
    }

    /**
     * Gets the place details service
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsService
     */
    public function getPlaceDetailsService()
    {
        return $this->placeDetailsService;
    }

    /**
     * @param PlaceSearchRequest $placeSearchRequest
     * @param bool $detailed
     * @return PlaceSearchResponse
     */
    public function execute(PlaceSearchRequest $placeSearchRequest, $detailed = false)
    {
        $placeSearchResponse = $this->getPlaceSearchService()->execute($placeSearchRequest);
        if (PlaceSearchStatus::OK === $placeSearchResponse->getStatus() && $detailed) {
            foreach ($placeSearchResponse->getResults() as $result) {
                $this->update($result);
            }
        }
        return $placeSearchResponse;
    }

    public function update(PlaceResult $result)
    {
        $placeDetailsRequest = $this->container->get('ivory_google_map.place_details_request');
        $placeDetailsRequest->setReference($result->getReference());

        $placeDetailsResponse = $this->getPlaceDetailsService()->execute($placeDetailsRequest, $result);
        if (PlaceDetailsStatus::OK === $placeDetailsResponse->getStatus()) {
            $result = $placeDetailsResponse->getResult();
        }
    }
}