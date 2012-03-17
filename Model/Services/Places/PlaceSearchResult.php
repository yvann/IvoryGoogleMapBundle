<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

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
     * @var string contains a feature name of a nearby location. Often this feature refers to a street or neighborhood within the given results.
     */
    protected $vicinity;

    public function hasIcon()
    {
        return !is_null($this->icon);
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
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

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
        return $this;
    }

    public function hasName()
    {
        return !is_null($this->name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function hasRating()
    {
        return !is_null($this->rating);
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    public function hasTypes()
    {
        return 0 < count($this->types);
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function setTypes(array $types)
    {
        $this->types = $types;
        return $this;
    }

    public function hasVicinity()
    {
        return !is_null($this->vicinity);
    }

    public function getVicinity()
    {
        return $this->vicinity;
    }

    public function setVicinity($vicinity)
    {
        $this->vicinity = $vicinity;
        return $this;
    }
}