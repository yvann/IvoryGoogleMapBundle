<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult;
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
    public function __construct(array $results, $status, $htmlAttributions = array())
    {
        $this
            ->setResults($results)
            ->setStatus($status)
            ->setHtmlAttributions($htmlAttributions);
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
     */
    public function setResults(array $results)
    {
        $this->results = array();

        foreach($results as $result) {
            $this->addResult($result);
        }

        return $this;
    }

    /**
     * Add a place search result
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult $result
     */
    public function addResult(PlaceSearchResult $result)
    {
        $this->results[] = $result;
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
     */
    public function addHtmlAttribution($htmlAttribution)
    {
        $this->htmlAttributions[] = $htmlAttribution;
        return $this;
    }
}