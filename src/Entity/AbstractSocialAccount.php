<?php

namespace Sophont\OAuth2hydrator\Entity;

/**
 * Class AbstractSocialAccount
 * @package Sophont\OAuth2hydrator\Entity
 */
abstract class AbstractSocialAccount
{
    const PROVIDER_FACEBOOK = "fb";
    const PROVIDER_TWITTER = "tw";
    const PROVIDER_GOOGLE = "gp";

    /** @var string */
    protected $socialId;

    /** @var string */
    protected $firstName;

    /** @var string */
    protected $lastName;

    /** @var string */
    protected $email;

    /** @var string */
    protected $gender;

    /** @var string */
    protected $social;

    /**
     * @param $socialId
     * @return $this
     */
    public function setSocialId($socialId)
    {
        $this->socialId = $socialId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSocialId()
    {
        return $this->socialId;
    }

    /**
     * @param $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param $social
     * @return $this
     */
    public function setSocial($social)
    {
        $this->social = $social;

        return $this;
    }

    /**
     * @return string
     */
    public function getSocial()
    {
        return $this->social;
    }
}