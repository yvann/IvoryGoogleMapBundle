<?php

namespace Ivory\GoogleMapBundle\Model\Services\Places;

use Ivory\GoogleMapBundle\Model\Services\AbstractService;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsRequest;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse;
use Ivory\GoogleMapBundle\Model\Services\Places\PlaceResult;

use Buzz\Browser;

/**
 * Google map place details service
 *
 * @see https://developers.google.com/maps/documentation/places/#PlaceDetails
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
class PlaceDetailsService extends AbstractService
{
    /**
     * Creates a place details service
     *
     * @param string $url Service url
     * @param boolean $https TRUE if the service uses HTTPS else FALSE
     * @param string $format Format used by the service
     * @param Buzz\Browser $browser Buzz browser used by the service
     */
    public function __construct($url = 'http://maps.googleapis.com/maps/api/place/details', $https = false, $format = 'json', Browser $browser = null)
    {
        parent::__construct($url, $https, $format, $browser);
    }

    /**
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse
     */
    public function execute(PlaceDetailsRequest $placeDetailsRequest, PlaceResult $result = null)
    {
        return $this->generatePlaceDetailsResponse(
            $this->parse($this->browser->get($this->generateUrl($placeDetailsRequest))->getContent()),
            $result
        );
    }

    /**
     * Generates place Details URL API according to the request
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsRequest
     * @return string
     */
    protected function generateUrl(PlaceDetailsRequest $placeDetailsRequest)
    {
        $httpQuery = array(
            'key' => $placeDetailsRequest->getKey(),
            'sensor' => $placeDetailsRequest->hasSensor() ? 'true' : 'false',
            'reference' => $placeDetailsRequest->getReference(),
        );

        return sprintf('%s/%s?%s',
            $this->getUrl(),
            $this->getFormat(),
            http_build_query($httpQuery)
        );
    }

    /**
     * Generate place Details response
     *
     * @param stdClass $placeDetailsResponseProvided
     * @return Ivory\GoogleMapBundle\Model\Services\Places\PlaceDetailsResponse
     */
    protected function generatePlaceDetailsResponse(\stdClass $placeDetailsResponseProvided, PlaceResult $result = null)
    {
        if (isset($placeDetailsResponseProvided->result)) {
            return new PlaceDetailsResponse(
                null === $result ? new PlaceResult($placeDetailsResponseProvided->result) : $result->update($placeDetailsResponseProvided->result),
                isset($placeDetailsResponseProvided->status) ? $placeDetailsResponseProvided->status : '',
                isset($placeDetailsResponseProvided->html_attributions) ? $placeDetailsResponseProvided->html_attributions : ''
            );
        } else {
            throw new \UnexpectedValueException('The response does not contain result node');
        }
        
    }

    /**
     * Parse & normalize the place Details API result response
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
     * Parse & normalize a JSON place Details API result response
     *
     * @param string $response
     * @return stdClass
     */
    protected function parseJSON($response)
    {
        return json_decode($response);
    }

    /**
     * Parse & normalize an XML place Details API result response
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