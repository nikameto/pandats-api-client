<?php

namespace Panda\Requests;

use Panda\Request;

class RegistrationRequest extends Request
{
    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * User's IP
     *
     * @var string
     */
    protected $ipAddress = '';

    /**
     * Is subscribed for newsletter. 0 - false, 1 - true.
     *
     * @var int
     */
    protected $newsletter = 0;

    /**
     * Get "source" by contacting support@pandats.com.
     *
     * @var int
     */
    protected $source = null;

    /**
     * User country in ISO 2 format.
     *
     * @var string
     */
    protected $country = null;

    protected $firstName = '';

    protected $lastName = '';

    /**
     * User balance currency. Default value: USD.
     *
     * @var string
     */
    protected $currency = 'USD';

    /**
     * User language in iso3 format.
     *
     * @var null
     */
    protected $language = null;

    protected $phoneAreaCode = '';

    protected $phoneCountryCode = '';

    protected $phoneNumber = '';

    /**
     * Referrer string.
     *
     * @var string
     */
    protected $referral = '';

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @return int
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @return int
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getPhoneAreaCode()
    {
        return $this->phoneAreaCode;
    }

    /**
     * @return string
     */
    public function getPhoneCountryCode()
    {
        return $this->phoneCountryCode;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getReferral()
    {
        return $this->referral;
    }
}
