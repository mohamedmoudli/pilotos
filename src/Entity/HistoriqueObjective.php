<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueObjectiveRepository")
 */
class HistoriqueObjective
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
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Temps1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Temps2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Temps3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Temps4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Temps2020;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Temps2021;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $IndicateurPredefini;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IndicateurPerformance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ObjectiveAttendre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatInitial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatActuelIndicateur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Avencement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatActuel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Enjeux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Processlie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanDeAction", mappedBy="historiqueObjective")
     */
    private $NumAction;

    public function __construct()
    {
        $this->NumAction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getTemps1(): ?string
    {
        return $this->Temps1;
    }

    public function setTemps1(?string $Temps1): self
    {
        $this->Temps1 = $Temps1;

        return $this;
    }

    public function getTemps2(): ?string
    {
        return $this->Temps2;
    }

    public function setTemps2(?string $Temps2): self
    {
        $this->Temps2 = $Temps2;

        return $this;
    }

    public function getTemps3(): ?string
    {
        return $this->Temps3;
    }

    public function setTemps3(?string $Temps3): self
    {
        $this->Temps3 = $Temps3;

        return $this;
    }

    public function getTemps4(): ?string
    {
        return $this->Temps4;
    }

    public function setTemps4(?string $Temps4): self
    {
        $this->Temps4 = $Temps4;

        return $this;
    }

    public function getTemps2020(): ?string
    {
        return $this->Temps2020;
    }

    public function setTemps2020(?string $Temps2020): self
    {
        $this->Temps2020 = $Temps2020;

        return $this;
    }

    public function getTemps2021(): ?string
    {
        return $this->Temps2021;
    }

    public function setTemps2021(?string $Temps2021): self
    {
        $this->Temps2021 = $Temps2021;

        return $this;
    }

    public function getIndicateurPredefini(): ?string
    {
        return $this->IndicateurPredefini;
    }

    public function setIndicateurPredefini(?string $IndicateurPredefini): self
    {
        $this->IndicateurPredefini = $IndicateurPredefini;

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

    public function getObjectiveAttendre(): ?string
    {
        return $this->ObjectiveAttendre;
    }

    public function setObjectiveAttendre(string $ObjectiveAttendre): self
    {
        $this->ObjectiveAttendre = $ObjectiveAttendre;

        return $this;
    }

    public function getEtatInitial(): ?string
    {
        return $this->EtatInitial;
    }

    public function setEtatInitial(string $EtatInitial): self
    {
        $this->EtatInitial = $EtatInitial;

        return $this;
    }

    public function getEtatActuelIndicateur(): ?string
    {
        return $this->EtatActuelIndicateur;
    }

    public function setEtatActuelIndicateur(string $EtatActuelIndicateur): self
    {
        $this->EtatActuelIndicateur = $EtatActuelIndicateur;

        return $this;
    }

    public function getAvencement(): ?float
    {
        return $this->Avencement;
    }

    public function setAvencement(?float $Avencement): self
    {
        $this->Avencement = $Avencement;

        return $this;
    }

    public function getEtatActuel(): ?string
    {
        return $this->EtatActuel;
    }

    public function setEtatActuel(string $EtatActuel): self
    {
        $this->EtatActuel = $EtatActuel;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(string $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getEnjeux(): ?string
    {
        return $this->Enjeux;
    }

    public function setEnjeux(string $Enjeux): self
    {
        $this->Enjeux = $Enjeux;

        return $this;
    }

    public function getProcesslie(): ?string
    {
        return $this->Processlie;
    }

    public function setProcesslie(string $Processlie): self
    {
        $this->Processlie = $Processlie;

        return $this;
    }

    /**
     * @return Collection|PlanDeAction[]
     */
    public function getNumAction(): Collection
    {
        return $this->NumAction;
    }

    public function addNumAction(PlanDeAction $numAction): self
    {
        if (!$this->NumAction->contains($numAction)) {
            $this->NumAction[] = $numAction;
            $numAction->setHistoriqueObjective($this);
        }

        return $this;
    }

    public function removeNumAction(PlanDeAction $numAction): self
    {
        if ($this->NumAction->contains($numAction)) {
            $this->NumAction->removeElement($numAction);
            // set the owning side to null (unless already changed)
            if ($numAction->getHistoriqueObjective() === $this) {
                $numAction->setHistoriqueObjective(null);
            }
        }

        return $this;
    }
}
