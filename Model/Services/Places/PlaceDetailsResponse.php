<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsStatus;

/**
 * Place details response wraps the place details results & the response status
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceDetailsResponse
{
    /**
     * @var \Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult
     */
    protected $result = null;

    /**
     * @var string Place details status
     */
    protected $status = null;

    /**
     * @var string contain a set of attributions about this listing which must be displayed to the user.
     */
    protected $htmlAttributions = array();

    /**
     * Create a place details response
     *
     * @param \Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult $result
     * @param string $status
     * @param string $htmlAttributions
     */
    public function __construct($result = null, $status, $htmlAttributions = array())
    {
        $this
            ->setStatus($status)
            ->setHtmlAttributions($htmlAttributions);

        !$result ?: $this->setResult($result);
    }

    /**
     * Gets the place details result
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Sets the place details result
     *
     * @param \Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult $result
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse
     */
    public function setResult(PlaceResult $result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Gets the place details results status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the place details results status
     *
     * @param string $status
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse
     */
    public function setStatus($status)
    {
        if(in_array($status, PlaceDetailsStatus::getStatuses())) {
            $this->status = $status;
        } else {
            throw new \InvalidArgumentException('The place details status can only be : '.implode(', ', PlaceDetailsStatus::getStatuses()));
        }

        return $this;
    }

    /**
     * Gets the place details response html attribution
     *
     * @return array
     */
    public function getHtmlAttributions()
    {
        return $this->htmlAttributions;
    }

    /**
     * Sets the place details response html attribution
     *
     * @param array $htmlAttributions
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse
     */
    public function setHtmlAttributions(array $htmlAttributions)
    {
        $this->htmlAttributions = array();

        foreach ($htmlAttributions as $htmlAttribution) {
            $this->addHtmlAttribution($htmlAttribution);
        }

        return $this;
    }

    /**
     * Add a place details response html attribution
     *
     * @param string $htmlAttribution
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse
     */
    public function addHtmlAttribution($htmlAttribution)
    {
        $this->htmlAttributions[] = $htmlAttribution;

        return $this;
    }
}