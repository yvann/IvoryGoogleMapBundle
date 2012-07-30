<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlaceEventResult represents a google map place event result
 *
 * @see https://developers.google.com/places/documentation/events#event_details
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceEventResult
{
    /**
     * @var integer The duration of the event in seconds
     */
    protected $duration = null;

    /**
     * @var string The unique ID of this event
     */
    protected $id = null;

    /**
     * @var integer The start time expressed in timestamp
     */
    protected $startTime = null;

    /**
     * @var string A textual description of the event
     */
    protected $summary = null;

    /**
     * @var string A URL pointing to details about the event
     */
    protected $url = null;

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}