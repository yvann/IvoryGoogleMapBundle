<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchStatus;

/**
 * Place search response wraps the place search results & the response status
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchResponse
{
    /**
     * @var array Place search results
     */
    protected $results = array();

    /**
     * @var string Place search status
     */
    protected $status = null;

    /**
     * @var string Next page token
     */
    protected $nextPageToken = null;

    /**
     * @var string contain a set of attributions about this listing which must be displayed to the user.
     */
    protected $htmlAttributions = array();

    /**
     * Create a place search response
     *
     * @param array $results
     * @param string $status
     * @param string $htmlAttributions
     */
    public function __construct(array $results, $status, $htmlAttributions = array(), $nextPageToken = null)
    {
        $this
            ->setResults($results)
            ->setStatus($status)
            ->setHtmlAttributions($htmlAttributions)
            ->setNextPageToken($nextPageToken);
    }

    /**
     * Gets the place search results
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Sets the place search results
     *
     * @param array $results
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    public function setResults(array $results)
    {
        $this->results = array();
        $this->addResults($results);

        return $this;
    }

    /**
     * Add place search results
     *
     * @param array $results
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    public function addResults(array $results)
    {
        foreach($results as $result) {
            $this->addResult($result);
        }

        return $this;
    }

    /**
     * Add a place search result
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult $result
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    public function addResult(PlaceResult $result)
    {
        $this->results[] = $result;

        return $this;
    }

    /**
     * Gets the place search results status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the place search results status
     *
     * @param string $status
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    public function setStatus($status)
    {
        if(in_array($status, PlaceSearchStatus::getStatuses())) {
            $this->status = $status;
        } else {
            throw new \InvalidArgumentException('The place search status can only be : '.implode(', ', PlaceSearchStatus::getStatuses()));
        }

        return $this;
    }

    /**
     * Gets the next page token presence
     *
     * @return boolean
     */
    public function hasNextPageToken()
    {
        return !is_null($this->nextPageToken);
    }

    /**
     * Gets the next page token
     *
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * Sets the next page token
     *
     * @param string $nextPageToken
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;

        return $this;
    }

    /**
     * Gets the place search response html attribution
     *
     * @return array
     */
    public function getHtmlAttributions()
    {
        return $this->htmlAttributions;
    }

    /**
     * Sets the place search response html attribution
     *
     * @param array $htmlAttributions
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
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
     * Add a place search response html attribution
     *
     * @param string $htmlAttribution
     * @return \Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    public function addHtmlAttribution($htmlAttribution)
    {
        $this->htmlAttributions[] = $htmlAttribution;

        return $this;
    }
}