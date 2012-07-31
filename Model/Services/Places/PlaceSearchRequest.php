<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\AbstractRequest;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRankBy;

/**
 * PlaceSearchRequest represents a google map places request
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#PlaceSearchRequest
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchRequest extends AbstractRequest
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate The latitude/longitude around which to retrieve Place information. This must be specified as latitude,longitude.
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
     * @var string Specifies the order in which results are listed. Possible values are "prominence" and "distance"
     */
    protected $rankBy = PlaceSearchRankBy::PROMINENCE;

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

    /**
     * @return \Ivory\GoogleMapBundle\Model\Base\Coordinate|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param \Ivory\GoogleMapBundle\Model\Base\Coordinate $location
     * @return PlaceSearchRequest
     */
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

    /**
     * @return int|null
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param $radius
     * @return PlaceSearchRequest
     */
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

    /**
     * @return null|string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param $keyword
     * @return PlaceSearchRequest
     */
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

    /**
     * @return null|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param $language
     * @return PlaceSearchRequest
     */
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

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return PlaceSearchRequest
     */
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

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param array $types
     * @return PlaceSearchRequest
     */
    public function setTypes(array $types)
    {
        $this->types = array();
        $this->addTypes($types);

        return $this;
    }

    /**
     * @param array $types
     * @return PlaceSearchRequest
     */
    public function addTypes(array $types)
    {
        foreach ($types as $type) {
            $this->addType($type);
        }

        return $this;
    }

    /**
     * @param $type
     * @return PlaceSearchRequest
     */
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

    /**
     * @return null|string
     */
    public function getPageToken()
    {
        return $this->pagetoken;
    }

    /**
     * @param $pagetoken
     * @return PlaceSearchRequest
     */
    public function setPageToken($pagetoken)
    {
        $this->pagetoken = $pagetoken;
        return $this;
    }

    /**
     * @param string $rankBy
     */
    public function setRankBy($rankBy)
    {
        if (in_array($rankBy, PlaceSearchRankBy::getValues())) {
            if (PlaceSearchRankBy::DISTANCE === $rankBy) {
                if ($this->hasRadius()) {
                    throw new \InvalidArgumentException('Radius must not be included if rankBy is "distance"');
                }
                if (0 === count(array_filter(array(
                    $this->hasKeyword(),
                    $this->hasName(),
                    $this->hasTypes()
                )))) {
                    throw new \InvalidArgumentException('One or more of "keyword", "keyword", or "types" is required if rankBy is "distance"');
                }
            }
            $this->rankBy = $rankBy;
        } else {
            throw new \InvalidArgumentException('The place search rank by can only be : '.implode(', ',PlaceSearchRankBy::getValues()));
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getRankBy()
    {
        return $this->rankBy;
    }
}