<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\AbstractRequest;

/**
 * Google map place search service interface
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchServiceInterface
{
    public function execute(AbstractRequest $placeSearchRequest);
}