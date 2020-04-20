<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StrategiqueOpportuniteRepository")
 */
class StrategiqueOpportunite
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
     * @ORM\OneToMany(targetEntity="App\Entity\Opportunite", mappedBy="Stategique")
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
            $opportunite->setStategique($this);
        }

        return $this;
    }

    public function removeOpportunite(Opportunite $opportunite): self
    {
        if ($this->opportunites->contains($opportunite)) {
            $this->opportunites->removeElement($opportunite);
            // set the owning side to null (unless already changed)
            if ($opportunite->getStategique() === $this) {
                $opportunite->setStategique(null);
            }
        }

        return $this;
    }
}
