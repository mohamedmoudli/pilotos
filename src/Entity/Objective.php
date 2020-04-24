<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ObjectiveRepository")
 */
class Objective
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
     * @ORM\Column(type="string", length=255)
     */
    private $Temps1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Temps2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Temps3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Temps4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Temps2020;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Temps2021;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $IndicateurPredefini;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IndicateurPerformance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ObjectiveAAtendre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatInitial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatActuel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatActuelIndiacteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enjeu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Enjeu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Processus", inversedBy="objectives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProcessLie;

    /**
     * @ORM\Column(type="float"  , nullable=true)
     */
    private $Avencement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanDeAction", mappedBy="objective")
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

    public function setTemps1(string $Temps1): self
    {
        $this->Temps1 = $Temps1;

        return $this;
    }

    public function getTemps2(): ?string
    {
        return $this->Temps2;
    }

    public function setTemps2(string $Temps2): self
    {
        $this->Temps2 = $Temps2;

        return $this;
    }

    public function getTemps3(): ?string
    {
        return $this->Temps3;
    }

    public function setTemps3(string $Temps3): self
    {
        $this->Temps3 = $Temps3;

        return $this;
    }

    public function getTemps4(): ?string
    {
        return $this->Temps4;
    }

    public function setTemps4(string $Temps4): self
    {
        $this->Temps4 = $Temps4;

        return $this;
    }

    public function getTemps2020(): ?string
    {
        return $this->Temps2020;
    }

    public function setTemps2020(string $Temps2020): self
    {
        $this->Temps2020 = $Temps2020;

        return $this;
    }

    public function getTemps2021(): ?string
    {
        return $this->Temps2021;
    }

    public function setTemps2021(string $Temps2021): self
    {
        $this->Temps2021 = $Temps2021;

        return $this;
    }

    public function getIndicateurPredefini(): ?string
    {
        return $this->IndicateurPredefini;
    }

    public function setIndicateurPredefini(string $IndicateurPredefini): self
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

    public function getObjectiveAAtendre(): ?string
    {
        return $this->ObjectiveAAtendre;
    }

    public function setObjectiveAAtendre(string $ObjectiveAAtendre): self
    {
        $this->ObjectiveAAtendre = $ObjectiveAAtendre;

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

    public function getEtatActuel(): ?string
    {
        return $this->EtatActuel;
    }

    public function setEtatActuel(string $EtatActuel): self
    {
        $this->EtatActuel = $EtatActuel;

        return $this;
    }

    public function getEtatActuelIndiacteur(): ?string
    {
        return $this->EtatActuelIndiacteur;
    }

    public function setEtatActuelIndiacteur(string $EtatActuelIndiacteur): self
    {
        $this->EtatActuelIndiacteur = $EtatActuelIndiacteur;

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

    public function getEnjeu(): ?Enjeu
    {
        return $this->Enjeu;
    }

    public function setEnjeu(?Enjeu $Enjeu): self
    {
        $this->Enjeu = $Enjeu;

        return $this;
    }

    public function getProcessLie(): ?Processus
    {
        return $this->ProcessLie;
    }

    public function setProcessLie(?Processus $ProcessLie): self
    {
        $this->ProcessLie = $ProcessLie;

        return $this;
    }

    public function getAvencement(): ?float
    {
        return $this->Avencement;
    }

    public function setAvencement(float $Avencement): self
    {
        $this->Avencement = $Avencement;

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
            $numAction->setObjective($this);
        }

        return $this;
    }

    public function removeNumAction(PlanDeAction $numAction): self
    {
        if ($this->NumAction->contains($numAction)) {
            $this->NumAction->removeElement($numAction);
            // set the owning side to null (unless already changed)
            if ($numAction->getObjective() === $this) {
                $numAction->setObjective(null);
            }
        }

        return $this;
    }
}
