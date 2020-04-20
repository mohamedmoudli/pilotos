<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategorieOpportuniteRepository")
 */
class CategorieOpportunite
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
    private $NomStrategique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomCategorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Opportunite", mappedBy="CategorieOpportunite")
     */
    private $opportunites;

    public function __construct()
    {
        $this->opportunites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStrategique(): ?string
    {
        return $this->NomStrategique;
    }

    public function setNomStrategique(string $NomStrategique): self
    {
        $this->NomStrategique = $NomStrategique;

        return $this;
    }

    public function getNomCategorie(): ?string
    {
        return $this->NomCategorie;
    }

    public function setNomCategorie(string $NomCategorie): self
    {
        $this->NomCategorie = $NomCategorie;

        return $this;
    }

    /**
     * @return Collection|Opportunite[]
     */
    public function getOpportunites(): Collection
    {
        return $this->opportunites;
    }

    public function addOpportunite(Opportunite $opportunite): self
    {
        if (!$this->opportunites->contains($opportunite)) {
            $this->opportunites[] = $opportunite;
            $opportunite->setCategorieOpportunite($this);
        }

        return $this;
    }

    public function removeOpportunite(Opportunite $opportunite): self
    {
        if ($this->opportunites->contains($opportunite)) {
            $this->opportunites->removeElement($opportunite);
            // set the owning side to null (unless already changed)
            if ($opportunite->getCategorieOpportunite() === $this) {
                $opportunite->setCategorieOpportunite(null);
            }
        }

        return $this;
    }
}
