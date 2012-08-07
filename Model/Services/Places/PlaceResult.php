<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceEventResult;

/**
 * PlaceResult represents a google map place result
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceResult
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
     * @var array
     */
    protected $addressComponents = array();

    /**
     * @var string
     */
    protected $formattedAddress = null;

    /**
     * @var string
     */
    protected $formattedPhoneNumber = null;

    /**
     * @var string
     */
    protected $internationalPhoneNumber = null;

    /**
     * @var array
     */
    protected $reviews = array();

    /**
     * @var int
     */
    protected $utcOffset = null;

    /**
     * @var array
     */
    protected $openingHours = array();

    public function __construct($result = null)
    {
        if (null !== $result) {
            $this->update($result);
        }
    }

    public function update(\stdClass $result)
    {
        !isset($result->id) ?: $this->setId($result->id);
        !isset($result->reference) ?: $this->setReference($result->reference);
        !isset($result->geometry->location) ?: $this->setLocation(
            new Coordinate(
                $result->geometry->location->lat,
                $result->geometry->location->lng,
                isset ($result->geometry->location->noWrap) ? (bool) $result->geometry->location->noWrap : true
            )
        );
        !isset($result->icon) ?: $this->setIcon($result->icon);
        !isset($result->name) ?: $this->setName($result->name);
        !isset($result->rating) ?: $this->setRating($result->rating);
        !isset($result->types) ?: $this->setTypes($result->types);
        !isset($result->vicinity) ?: $this->setVicinity($result->vicinity);
        !isset($result->address_components) ?: $this->setAddressComponents($result->address_components);
        !isset($result->formatted_address) ?: $this->setFormattedAddress($result->formatted_address);
        !isset($result->formatted_phone_number) ?: $this->setFormattedPhoneNumber($result->formatted_phone_number);
        !isset($result->international_phone_number) ?: $this->setInternationalPhoneNumber($result->international_phone_number);
        !isset($result->utc_offset) ?: $this->setUtcOffset($result->utc_offset);
        !isset($result->opening_hours) ?: $this->setOpeningHours($result->opening_hours);
        !isset($result->reviews) ?: $this->setReviews($result->reviews);

        !isset($result->events) ?: $this->setEvents(array_map(function($event) {
            return new PlaceEventResult($event);
        }, $result->events));

        return $this;
    }

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
     * @return PlaceResult
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
     * @return PlaceResult
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
     * @return PlaceResult
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
     * @return PlaceResult
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
     * @return PlaceResult
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
     * @return PlaceResult
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
     * @return PlaceResult
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
     * @return PlaceResult
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
     * @return PlaceResult
     */
    public function setEvents(array $events)
    {
        $this->events = array();
        $this->addEvents($events);

        return $this;
    }

    /**
     * @param array $events
     * @return PlaceResult
     */
    public function addEvents(array $events)
    {
        foreach ($events as $event) {
            $this->addEvent($event);
        }

        return $this;
    }

    /**
     * @return PlaceResult
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
     * @return PlaceResult
     */
    public function setVicinity($vicinity)
    {
        $this->vicinity = $vicinity;
        return $this;
    }

    /**
     * @param array $addressComponents
     */
    public function setAddressComponents(array $addressComponents)
    {
        $this->addressComponents = array();
        $this->addAddressComponents($addressComponents);

        return $this;
    }

    /**
     * @param array $addressComponents
     */
    public function addAddressComponents(array $addressComponents)
    {
        foreach ($addressComponents as $addressComponent) {
            $this->addAddressComponent($addressComponent);
        }

        return $this;
    }

    /**
     * @param array $addressComponent
     */
    public function addAddressComponent($addressComponent)
    {
        $this->addressComponents[] = $addressComponent;

        return $this;
    }

    /**
     * @return array
     */
    public function getAddressComponents()
    {
        return $this->addressComponents;
    }

    /**
     * @param string $formattedAddress
     */
    public function setFormattedAddress($formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * @param string $formattedPhoneNumber
     */
    public function setFormattedPhoneNumber($formattedPhoneNumber)
    {
        $this->formattedPhoneNumber = $formattedPhoneNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormattedPhoneNumber()
    {
        return $this->formattedPhoneNumber;
    }

    /**
     * @param string $internationalPhoneNumber
     */
    public function setInternationalPhoneNumber($internationalPhoneNumber)
    {
        $this->internationalPhoneNumber = $internationalPhoneNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getInternationalPhoneNumber()
    {
        return $this->internationalPhoneNumber;
    }

    public function setReviews($reviews)
    {
        $this->reviews = array();
        $this->addReviews($reviews);

        return $this;
    }

    public function addReviews($reviews)
    {
        foreach ($reviews as $review) {
            $this->addReview($review);
        }

        return $this;
    }

    public function addReview($review)
    {
        $dateTime = new \DateTime();
        $this->reviews[] = array(
            'aspects' => isset($review->aspects) ? array_map(function($aspect) {
                return array(
                    'type' => isset($aspect->type) ? $aspect->type : null,
                    'rating' => isset($aspect->rating) ? $aspect->rating : null,
                );
            }, $review->aspects) : null,
            'authorName' => isset($review->author_name) ? $review->author_name : null,
            'authorUrl' => isset($review->author_url) ? $review->author_url : null,
            'text' => isset($review->text) ? $review->text : null,
            'createdAt' => isset($review->time) ? $dateTime->setTimestamp($review->time) : null,
        );
    }

    /**
     * @return array
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param int $utcOffset
     */
    public function setUtcOffset($utcOffset)
    {
        $this->utcOffset = $utcOffset;

        return $this;
    }

    public function getUtcOffset()
    {
        return $this->utcOffset;
    }

    /**
     * @param stdClass $openingHours
     */
    public function setOpeningHours($openingHours)
    {
        $this->openingHours = array(
            'openNow' => isset($openingHours->open_now) ? (bool) $openingHours->open_now : null,
            'periods' => isset($openingHours->periods) ? array_map(function($period) {
                return array(
                    'open' => array(
                        'day' => isset($period->open->day) ? $period->open->day : null,
                        'time' => isset($period->open->time) ? $period->open->time : null,
                    ),
                    'close' => array(
                        'day' => isset($period->close->day) ? $period->close->day : null,
                        'time' => isset($period->close->time) ? $period->close->time : null,
                    ),
                );
            }, $openingHours->periods) : null,
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }
}