<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\AbstractService;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResult;

/**
 * Google map place search service
 *
 * @see https://developers.google.com/maps/documentation/places/#PlaceSearches
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceSearchService extends AbstractService
{
    /**
     * Creates a place search service
     *
     * @param string $url Service url
     * @param boolean $https TRUE if the service uses HTTPS else FALSE
     * @param string $format Format used by the service
     * @param Buzz\Browser $browser Buzz browser used by the service
     */
    public function __construct($url = 'http://maps.googleapis.com/maps/api/place/search', $https = false, $format = 'json', Browser $browser = null)
    {
        parent::__construct($url, $https, $format, $browser);
    }

    /**
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    public function execute(PlaceSearchRequest $placeSearchRequest)
    {
        $placeSearchResponse = $this->getPlaceSearchResponse($placeSearchRequest);

        while (PlaceSearchStatus::OK === $placeSearchResponse->getStatus() && $placeSearchResponse->hasNextPageToken()) {
            sleep(2);
            $placeSearchRequest->setPageToken($placeSearchResponse->getNextPageToken());
            $placeSearchResponse = $this->getPlaceSearchResponse($placeSearchRequest, $placeSearchResponse);
        }

        return $placeSearchResponse;
    }

    /**
     *  Calls the provider API to return response
     *
     * @param PlaceSearchRequest $placeSearchRequest
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    protected function getPlaceSearchResponse(PlaceSearchRequest $placeSearchRequest, PlaceSearchResponse $placeSearchResponse = null)
    {
        return $this->generatePlaceSearchResponse(
            $this->parse($this->browser->get($this->generateUrl($placeSearchRequest))->getContent()),
            $placeSearchResponse
        );
    }

    /**
     * Generates place search URL API according to the request
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchRequest
     * @return string
     */
    protected function generateUrl(PlaceSearchRequest $placeSearchRequest)
    {
        $httpQuery = array(
            'key' => $this->getKey(),
            'sensor' => $placeSearchRequest->hasSensor() ? 'true' : 'false',
        );

        if ($placeSearchRequest->hasLocation()) {
            $httpQuery['location'] = sprintf(
                '%s,%s',
                $placeSearchRequest->getLocation()->getLatitude(),
                $placeSearchRequest->getLocation()->getLongitude()
            );
        }

        !$placeSearchRequest->hasTypes() ?: $httpQuery['types'] = \implode('|', $placeSearchRequest->getTypes());
        !$placeSearchRequest->hasRadius() ?: $httpQuery['radius'] = $placeSearchRequest->getRadius();
        !$placeSearchRequest->hasLanguage() ?: $httpQuery['language'] = $placeSearchRequest->getLanguage();
        !$placeSearchRequest->hasName() ?: $httpQuery['name'] = $placeSearchRequest->getName();
        !$placeSearchRequest->hasKeyword() ?: $httpQuery['keyword'] = $placeSearchRequest->getKeyword();
        !$placeSearchRequest->hasPageToken() ?: $httpQuery['pagetoken'] = $placeSearchRequest->getPageToken();

        return sprintf('%s/%s?%s',
            $this->getUrl(),
            $this->getFormat(),
            http_build_query($httpQuery)
        );
    }

    /**
     * Generate place search response or append results if place search response is provided
     *
     * @param stdClass $placeSearchResponseProvided
     * @param Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse $placeSearchResponse
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    protected function generatePlaceSearchResponse(\stdClass $placeSearchResponseProvided, PlaceSearchResponse $placeSearchResponse = null)
    {
        if (null === $placeSearchResponse) {
            $placeSearchResponse = new PlaceSearchResponse(
                $this->generatePlaceSearchResults($placeSearchResponseProvided->results),
                $placeSearchResponseProvided->status,
                $placeSearchResponseProvided->html_attributions,
                isset($placeSearchResponseProvided->next_page_token) ? $placeSearchResponseProvided->next_page_token : null
            );
        } else {
            $placeSearchResponse
                ->addResults($this->generatePlaceSearchResults($placeSearchResponseProvided->results))
                ->setStatus($placeSearchResponseProvided->status)
                ->setHtmlAttributions($placeSearchResponseProvided->html_attributions)
                ->setNextPageToken(isset($placeSearchResponseProvided->next_page_token) ? $placeSearchResponseProvided->next_page_token : null);
        }

        return $placeSearchResponse;
    }

    /**
     * Generate place search results
     *
     * @param stdClass $placeSearchResults
     * @return array
     */
    protected function generatePlaceSearchResults(array $placeSearchResults)
    {
        $results = array();

        foreach ($placeSearchResults as $placeSearchResult) {
            $results[] = $this->generatePlaceSearchResult($placeSearchResult);
        }

        return $results;
    }

    /**
     * Generate place search result
     *
     * @param stdClass $placeSearchResult
     * @return array
     */
    protected function generatePlaceSearchResult(\stdClass $placeSearchResult)
    {
        $events = array();
        if (isset($placeSearchResult->events)) {
            foreach ($placeSearchResult->events as $event) {
                $e = new PlaceEventResult();
                $e
                    ->setId($event->id)
                    ->setDuration(isset($event->duration) ? $event->duration : null)
                    ->setStartTime(isset($event->start_time) ? $event->start_time : null)
                    ->setSummary(isset($event->summary) ? $event->summary : null)
                    ->setUrl(isset($event->url) ? $event->url : null);

                $events[] = $e;
            }
        }

        $result = new PlaceSearchResult();
        return $result
            ->setId($placeSearchResult->id)
            ->setReference($placeSearchResult->reference)
            ->setEvents($events)
            ->setLocation(
                new Coordinate(
                    $placeSearchResult->geometry->location->lat,
                    $placeSearchResult->geometry->location->lng,
                    isset ($placeSearchResult->geometry->location->noWrap) ? (bool) $placeSearchResult->geometry->location->noWrap : true
                )
            )
            ->setIcon(isset($placeSearchResult->icon) ? $placeSearchResult->icon : null)
            ->setName(isset($placeSearchResult->name) ? $placeSearchResult->name : null)
            ->setRating(isset($placeSearchResult->rating) ? $placeSearchResult->rating : null)
            ->setTypes(isset($placeSearchResult->types) ? $placeSearchResult->types : array())
            ->setVicinity(isset($placeSearchResult->vicinity) ? $placeSearchResult->vicinity : null)
        ;
    }

    /**
     * Parse & normalize the place search API result response
     *
     * @param string $response
     * @return stdClass
     */
    protected function parse($response)
    {
        if ($this->format == 'json') {
            return $this->parseJSON($response);
        } else {
            return $this->parseXML($response);
        }
    }

    /**
     * Parse & normalize a JSON place search API result response
     *
     * @param string $response
     * @return stdClass
     */
    protected function parseJSON($response)
    {
        return json_decode($response);
    }

    /**
     * Parse & normalize an XML place search API result response
     *
     * @todo Finish implementation
     * @param string $response
     * @return stdClass
     */
    protected function parseXML($response)
    {
        throw new \Exception('Actually, the xml format is not supported.');
    }
}