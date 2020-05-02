<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StateRiskRepository")
 */
class StateRisk
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
    private $NameStateRisk;

    /**
     * @ORM\OneToMany(targetEntity="Risk", mappedBy="StateRisk")
     */
    private $risk;

    public function __construct()
    {
        $this->risk = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameStateRisk(): ?string
    {
        return $this->NameStateRisk;
    }

    public function setNameStateRisk(string $NameStateRisk): self
    {
        $this->NameStateRisk = $NameStateRisk;

        return $this;
    }

}
