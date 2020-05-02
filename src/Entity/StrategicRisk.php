<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StrategicRiskRepository")
 */
class StrategicRisk
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
    private $NameStrategicRisk;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameStrategicRisk(): ?string
    {
        return $this->NameStrategicRisk;
    }

    public function setNameStrategicRisk(string $NameStrategicRisk): self
    {
        $this->NameStrategicRisk = $NameStrategicRisk;

        return $this;
    }

}
