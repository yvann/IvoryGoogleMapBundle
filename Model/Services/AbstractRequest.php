<?php

namespace Ivory\GoogleMapBundle\Model\Services;

/**
 * Abstract class for accesing google API
 *
 * @author Yvann Boucher <yvann.boucher@gmail.com>
 */
abstract class AbstractRequest
{
    /**
     * @var boolean TRUE if the request has a sensor else FALSE.
     */
    protected $sensor = false;

    /**
     * @var string This key identifies your application for purposes of quota management
     */
    protected $key = null;

    /**
     * @var string The language code, indicating in which language the results should be returned.
     */
    protected $language = null;

    /**
     * Checks if the request has a sensor
     *
     * @return boolean TRUE if the request has a sensor else FALSE
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the request sensor
     *
     * @param boolean $sensor TRUE if the request has a sensor else FALSE
     */
    public function setSensor($sensor)
    {
        if (is_bool($sensor)) {
            $this->sensor = $sensor;
            return $this;
        } else {
            throw new \InvalidArgumentException('The request sensor flag must be a boolean value.');
        }
    }

    /**
     * Sets the API key
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Checks if the request has an API key
     *
     * @return boolean TRUE if the request has an API key else FALSE
     */
    public function hasKey()
    {
        return !is_null($this->key);
    }

    /**
     * Gets the API key
     *
     * @return string
     */
    public function getKey()
    {
        if (is_null($this->key)) {
            throw new \InvalidArgumentException('The API key must be defined');
        }

        return $this->key;
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
}