<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\AbstractRequest;

/**
 * PlaceDetailsRequest represents a google map place details request
 *
 * @see https://developers.google.com/places/documentation/#PlaceDetailsRequests
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceDetailsRequest extends AbstractRequest
{
    /**
     * A textual identifier that uniquely identifies a place
     * @var string
     */
    protected $reference;

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
}