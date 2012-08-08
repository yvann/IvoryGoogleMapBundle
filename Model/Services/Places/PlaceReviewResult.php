<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

/**
 * PlaceReviewResult represents a google place review result
 *
 * @see https://developers.google.com/places/documentation/events#event_details
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceReviewResult
{
    /**
     * @var array contains a collection of AspectRating objects, each of which provides a rating of a single attribute of the establishment.
     * The first object in the collection is considered the primary aspect
     */
    protected $aspects = array();

    /**
     * @var string the name of the user who submitted the review. Anonymous reviews are attributed to "A Google user".
     */
    protected $authorName = null;

    /**
     * @var string the URL to the users Google+ profile, if available.
     */
    protected $authorUrl = null;

    /**
     * @var string contains the user's review. When reviewing a location with Google Places, text reviews are considered optional; therefore, this field may by empty.
     */
    protected $text = null;

    /**
     * @var \DateTime the time that the review was submitted, measured in the number of seconds since since midnigh.
     */
    protected $time = null;

    public function __construct($review = null)
    {
        if (null !== $review) {
            $this->update($review);
        }
    }

    public function update($review)
    {
        $dateTime = new \DateTime();

        !isset($review->aspects) ?: $this->setAspects($review->aspects);
        !isset($review->author_name) ?: $this->setAuthorName($review->author_name);
        !isset($review->author_url) ?: $this->setAuthorUrl($review->author_url);
        !isset($review->text) ?: $this->setText($review->text);
        !isset($review->time) ?: $this->setTime($dateTime->setTimestamp($review->time));

        return $this;
    }

    /**
     * @param mixed $aspects
     */
    public function setAspects($aspects)
    {
        $this->aspects = array();
        $this->addAspects($aspects);

        return $this;
    }

    /**
     * @param mixed $aspects
     */
    public function addAspects($aspects)
    {
        foreach ($aspects as $aspect) {
            $this->addAspect($aspect);
        }

        return $this;
    }

    /**
     * @param mixed $aspect
     */
    public function addAspect($aspect)
    {
        $this->aspects[] = array(
            'type' => isset($aspect->type) ? $aspect->type : null,
            'rating' => isset($aspect->rating) ? $aspect->rating : null,
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getAspects()
    {
        return $this->aspects;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $authorUrl
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

}