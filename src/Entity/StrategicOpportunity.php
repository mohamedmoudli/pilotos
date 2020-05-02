<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StrategicOpportunityRepository")
 */
class StrategicOpportunity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NameStrategicOpportunity;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameStrategicOpportunity(): ?string
    {
        return $this->NameStrategicOpportunity;
    }

    public function setNameStrategicOpportunity(string $NameStrategicOpportunity): self
    {
        $this->NameStrategicOpportunity = $NameStrategicOpportunity;

        return $this;
    }

}
