<?php

namespace Nexmo\Service;

use Nexmo\Entity;
use Nexmo\Exception;

/**
 * Account management APIs
 *
 * @property-read Account\Balance              $balance
 * @property-read Account\Numbers              $numbers
 * @property-read Account\Pricing              $pricing
 * @property-read Account\PricingInternational $pricingInternational
 * @property-read Account\PricingPhone         $pricingPhone
 */
class Account extends ResourceCollection
{
    protected function getNamespaceSuffix()
    {
        return 'Account';
    }

    /**
     * Returns the balance in euros
     *
     * @return float
     * @throws Exception
     */
    public function balance()
    {
        return $this->balance->invoke();
    }

    /**
     * Get all inbound numbers associated with your Nexmo account
     *
     * @param int $index                Page index
     * @param int $size                 Page size (max 100)
     * @param int $pattern              A matching pattern
     * @param int $searchPattern        Strategy for matching pattern.
     *                                  0 = starts with
     *                                  1 = anywhere
     *                                  2 = ends with
     * @return array
     * @throws Exception
     */
    public function numbers($index = 1, $size = 10, $pattern = null, $searchPattern = 0)
    {
        return $this->numbers->invoke($index, $size, $pattern, $searchPattern);
    }

    /**
     * Retrieve Nexmo's outbound pricing for a given country.
     *
     * @param string $country A 2 letter country code. Ex: CA
     * @return Entity\Pricing
     * @throws Exception
     */
    public function pricing($country)
    {
        return $this->pricing->invoke($country);
    }

    /**
     * Retrieve Nexmo's outbound pricing for a given international prefix.
     *
     * @param int $prefix International dialing code. Ex: 44
     * @return Entity\Pricing[]
     * @throws Exception
     */
    public function pricingInternational($prefix)
    {
        return $this->pricingInternational->invoke($prefix);
    }

    /**
     * Retrieve Nexmo's outbound voice pricing for a given phone number.
     *
     * @param string $number Phone number in international format Ex: 447525856424
     * @return Entity\PricingPhone
     * @throws Exception
     */
    public function pricingSms($number)
    {
        return $this->pricingPhone->invoke('sms', $number);
    }

    /**
     * Retrieve Nexmo's outbound SMS pricing for a given phone number.
     *
     * @param string $number Phone number in international format Ex: 447525856424
     * @return Entity\PricingPhone
     * @throws Exception
     */
    public function pricingVoice($number)
    {
        return $this->pricingPhone->invoke('voice', $number);
    }
}
