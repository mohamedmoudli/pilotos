<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PIPertinanteRepository")
 */
class PIPertinante
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
    private $NomPI;

    /**
     * @ORM\Column(type="integer")
     */
    private $Interet;

    /**
     * @ORM\Column(type="integer")
     */
    private $Pouvoir;

    /**
     * @ORM\Column(type="integer")
     */
    private $Influence;

    /**
     * @ORM\Column(type="integer")
     */
    private $Poids;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPI(): ?string
    {
        return $this->NomPI;
    }

    public function setNomPI(string $NomPI): self
    {
        $this->NomPI = $NomPI;

        return $this;
    }

    public function getInteret(): ?int
    {
        return $this->Interet;
    }

    public function setInteret(int $Interet): self
    {
        $this->Interet = $Interet;

        return $this;
    }

    public function getPouvoir(): ?int
    {
        return $this->Pouvoir;
    }

    public function setPouvoir(int $Pouvoir): self
    {
        $this->Pouvoir = $Pouvoir;

        return $this;
    }

    public function getInfluence(): ?int
    {
        return $this->Influence;
    }

    public function setInfluence(int $Influence): self
    {
        $this->Influence = $Influence;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->Poids;
    }

    public function setPoids(int $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }
}
