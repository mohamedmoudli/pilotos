<?php
// src/Acme/ApiBundle/Entity/AccessToken.php

namespace App\Entity;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Attributes;

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->Attributes;
    }

    /**
     * @param mixed $Attributes
     */
    public function setAttributes($Attributes): void
    {
        $this->Attributes = $Attributes;
    }


}