<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProcessusRepository")
 */
class Processus
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
    private $Processus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IndicateurPerformance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pilote;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Opportunite", mappedBy="ProcessLie")
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

    public function getProcessus(): ?string
    {
        return $this->Processus;
    }

    public function setProcessus(string $Processus): self
    {
        $this->Processus = $Processus;

        return $this;
    }

    public function getIndicateurPerformance(): ?string
    {
        return $this->IndicateurPerformance;
    }

    public function setIndicateurPerformance(string $IndicateurPerformance): self
    {
        $this->IndicateurPerformance = $IndicateurPerformance;

        return $this;
    }

    public function getPilote(): ?string
    {
        return $this->Pilote;
    }

    public function setPilote(string $Pilote): self
    {
        $this->Pilote = $Pilote;

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
            $opportunite->setProcessLie($this);
        }

        return $this;
    }

    public function removeOpportunite(Opportunite $opportunite): self
    {
        if ($this->opportunites->contains($opportunite)) {
            $this->opportunites->removeElement($opportunite);
            // set the owning side to null (unless already changed)
            if ($opportunite->getProcessLie() === $this) {
                $opportunite->setProcessLie(null);
            }
        }

        return $this;
    }



}
