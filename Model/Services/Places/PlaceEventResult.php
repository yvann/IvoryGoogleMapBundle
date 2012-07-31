<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlaceEventResult represents a google place event result
 *
 * @see https://developers.google.com/places/documentation/events#event_details
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceEventResult
{
    /**
     * @var string The unique ID of this event
     */
    protected $id = null;

    /**
     * @var string A textual description of the event
     */
    protected $summary = null;

    /**
     * @var string A URL pointing to details about the event
     */
    protected $url = null;

    /**
     * @var integer The start time expressed in timestamp
     */
    protected $startTime = null;

    /**
     * @var integer The duration of the event in seconds
     */
    protected $duration = null;

    /**
     * @return int|null
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param $duration
     * @return PlaceEventResult
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return PlaceEventResult
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param $startTime
     * @return PlaceEventResult
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param $summary
     * @return PlaceEventResult
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return PlaceEventResult
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}