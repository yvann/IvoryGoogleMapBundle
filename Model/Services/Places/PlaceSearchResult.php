<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceEventResult;

/**
 * PlaceSearchResult represents a google map place result
 *
 * @see https://developers.google.com/maps/documentation/places/#PlaceSearchResults
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchResult
{
    /**
     * @var string contains the URL of a recommended icon which may be displayed to the user when indicating this result.
     */
    protected $icon = null;

    /**
     * @var string contains a unique stable identifier denoting this place.
     */
    protected $id = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate contains location of the result
     */
    protected $location = null;

    /**
     * @var string contains the human-readable name for the returned result. For establishment results, this is usually the business name.
     */
    protected $name = null;

    /**
     * @var float contains the Place's rating, from 0.0 to 5.0, based on user reviews.
     */
    protected $rating = null;

    /**
     * @var string contains a unique token that you can use to retrieve additional information about this place in a Place Details request.
     */
    protected $reference = null;

    /**
     * @var array contains an array of feature types describing the given result.
     * @see https://developers.google.com/maps/documentation/places/supported_types
     */
    protected $types = array();

    /**
     * @var array contains current events happening
     */
    protected $events = array();

    /**
     * @var string contains a feature name of a nearby location. Often this feature refers to a street or neighborhood within the given results.
     */
    protected $vicinity;

    /**
     * @return bool
     */
    public function hasIcon()
    {
        return !is_null($this->icon);
    }

    /**
     * @return null|string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param $icon
     * @return PlaceSearchResult
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasId()
    {
        return !is_null($this->id);
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
     * @return PlaceSearchResult
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasLocation()
    {
        return !is_null($this->location);
    }

    /**
     * @return \Ivory\GoogleMapBundle\Model\Base\Coordinate|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param \Ivory\GoogleMapBundle\Model\Base\Coordinate $location
     * @return PlaceSearchResult
     */
    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasName()
    {
        return !is_null($this->name);
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return PlaceSearchResult
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasRating()
    {
        return !is_null($this->rating);
    }

    /**
     * @return float|null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param $rating
     * @return PlaceSearchResult
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasReference()
    {
        return !is_null($this->reference);
    }

    /**
     * @return null|string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param $reference
     * @return PlaceSearchResult
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTypes()
    {
        return 0 < count($this->types);
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param array $types
     * @return PlaceSearchResult
     */
    public function setTypes(array $types)
    {
        $this->types = array();
        foreach ($types as $type) {
            $this->addType($type);
        }

        return $this;
    }

    /**
     * @param $type
     * @return PlaceSearchResult
     */
    public function addType($type)
    {
        $this->types[] = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasEvents()
    {
        return 0 < count($this->events);
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param array $events
     * @return PlaceSearchResult
     */
    public function setEvents(array $events)
    {
        $this->events = array();
        foreach ($events as $event) {
            $this->addEvent($event);
        }

        return $this;
    }

    /**
     * @param PlaceEventResult $event
     * @return PlaceSearchResult
     */
    public function addEvent(PlaceEventResult $event)
    {
        $this->events[] = $event;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasVicinity()
    {
        return !is_null($this->vicinity);
    }

    /**
     * @return string
     */
    public function getVicinity()
    {
        return $this->vicinity;
    }

    /**
     * @param $vicinity
     * @return PlaceSearchResult
     */
    public function setVicinity($vicinity)
    {
        $this->vicinity = $vicinity;
        return $this;
    }
}