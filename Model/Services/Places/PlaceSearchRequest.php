<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\AbstractRequest;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * PlaceSearchRequest represents a google map places request
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#PlaceSearchRequest
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchRequest extends AbstractRequest
{
    /**
     * @var string|Ivory\GoogleMapBundle\Model\Base\Coordinate The latitude/longitude around which to retrieve Place information. This must be specified as latitude,longitude.
     */
    protected $location = null;

    /**
     * @var integer The distance (in meters) within which to return Place results. The maximum allowed radius is 50 000 meters.
     */
    protected $radius = null;

    /**
     * @var string A term to be matched against all available fields, including but not limited to name, type, and address, as well as customer reviews and other third-party content.
     */
    protected $keyword = null;

    /**
     * @var string The language code, indicating in which language the results should be returned.
     */
    protected $language = null;

    /**
     * @var string A term to be matched against the names of Places. Results will be restricted to those containing the passed name value.
     */
    protected $name = null;

    /**
     * @var array Restricts the results to Places matching at least one of the specified types.
     * @see https://developers.google.com/maps/documentation/places/supported_types
     */
    protected $types = array();

    /**
     * @var string The token that can be used to return up to 20 additional results
     * @see https://developers.google.com/places/documentation/#PlaceSearchPaging
     */
    protected $pagetoken = null;

    /**
     * @return boolean
     */
    public function hasLocation()
    {
        return !is_null($this->location);
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

    /**
     * @return boolean
     */
    public function hasRadius()
    {
        return !is_null($this->radius);
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function setRadius($radius)
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasKeyword()
    {
        return !is_null($this->keyword);
    }

    public function getKeyword()
    {
        return $this->keyword;
    }

    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasLanguage()
    {
        return !is_null($this->language);
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return boolean
     */
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

    /**
     * @return boolean
     */
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
        $this->types = array();
        $this->addTypes($types);

        return $this;
    }

    public function addTypes(array $types)
    {
        foreach ($types as $type) {
            $this->addType($type);
        }

        return $this;
    }

    public function addType($type)
    {
        $this->types[] = $type;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasPageToken()
    {
        return !is_null($this->pagetoken);
    }

    public function getPageToken()
    {
        return $this->pagetoken;
    }

    public function setPageToken($pagetoken)
    {
        $this->pagetoken = $pagetoken;
        return $this;
    }
}