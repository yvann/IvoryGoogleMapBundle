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
    public function execute(PlaceSearchRequest $placeSearchRequest)
    {
        $response = $this->browser->get($this->generateUrl($placeSearchRequest));

        return $this->generatePlaceSearchResponse($this->parse($response->getContent()));
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

        return sprintf('%s/%s?%s',
            $this->getUrl(),
            $this->getFormat(),
            http_build_query($httpQuery)
        );
    }

    /**
     * Generate place search response
     *
     * @param stdClass $placeSearchResponse
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceSearchResponse
     */
    protected function generatePlaceSearchResponse(\stdClass $placeSearchResponse)
    {
        return new PlaceSearchResponse(
            $this->generatePlaceSearchResults($placeSearchResponse->results),
            $placeSearchResponse->status,
            $placeSearchResponse->html_attributions
        );
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
        $result = new PlaceSearchResult();
        return $result
            ->setId($placeSearchResult->id)
            ->setReference($placeSearchResult->reference)
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