<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PerimetrePolitiqueRepository")
 */
class PerimetrePolitique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Perimetre;

    /**
     * @ORM\Column(type="text")
     */
    private $Politique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerimetre(): ?string
    {
        return $this->Perimetre;
    }

    public function setPerimetre(string $Perimetre): self
    {
        $this->Perimetre = $Perimetre;

        return $this;
    }

    public function getPolitique(): ?string
    {
        return $this->Politique;
    }

    public function setPolitique(string $Politique): self
    {
        $this->Politique = $Politique;

        return $this;
    }
}
