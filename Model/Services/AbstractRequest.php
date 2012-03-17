<?php

namespace Ivory\GoogleMapBundle\Model\Services;

/**
 * Abstract class for accesing google API
 *
 * @author Yvann Boucher <gyvann.boucher@gmail.com>
 */
abstract class AbstractRequest
{
    /**
     * @var boolean TRUE if the request has a sensor else FALSE.
     */
    protected $sensor = false;

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
}