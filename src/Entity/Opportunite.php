<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OpportuniteRepository")
 */
class Opportunite
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
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $CourtTerm;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $MoyenTerm;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $LongTerm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateIdentification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Coherence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Allignement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Presence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Competences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Continute;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Gain;

    /**
     * @ORM\Column(type="integer")
     */
    private $Efforts;

    /**
     * @ORM\Column(type="integer")
     */
    private $Aventages;

    /**
     * @ORM\Column(type="integer")
     */
    private $Poids;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Decision;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StrategiqueOpportunite", inversedBy="opportunites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Stategique;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Processus", inversedBy="opportunites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProcessLie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieOpportunite", inversedBy="opportunites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategorieOpportunite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatOpportunite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $EffortReevaluation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $AventageReevaluation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PoidsReevaluation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DecisionReevaluation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StrategiqueOpportunite", inversedBy="opportunites")
     */
    private $StrategiqueEvaluation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Processus", inversedBy="opportunites")
     */
    private $ProcessLieReevaluation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EtatOpportuniteReevaluation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanDeAction", mappedBy="opportunite")
     */
    private $NumAction;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanDeAction", mappedBy="opportuniteReevalution")
     */
    private $NumActionReevaluation;

    public function __construct()
    {
        $this->NumAction = new ArrayCollection();
        $this->NumActionReevaluation = new ArrayCollection();
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

    public function getCourtTerm(): ?string
    {
        return $this->CourtTerm;
    }

    public function setCourtTerm(string $CourtTerm): self
    {
        $this->CourtTerm = $CourtTerm;

        return $this;
    }

    public function getMoyenTerm(): ?string
    {
        return $this->MoyenTerm;
    }

    public function setMoyenTerm(string $MoyenTerm): self
    {
        $this->MoyenTerm = $MoyenTerm;

        return $this;
    }

    public function getLongTerm(): ?string
    {
        return $this->LongTerm;
    }

    public function setLongTerm(string $LongTerm): self
    {
        $this->LongTerm = $LongTerm;

        return $this;
    }

    public function getDateIdentification(): ?string
    {
        return $this->DateIdentification;
    }

    public function setDateIdentification(string $DateIdentification): self
    {
        $this->DateIdentification = $DateIdentification;

        return $this;
    }

    public function getCoherence(): ?string
    {
        return $this->Coherence;
    }

    public function setCoherence(?string $Coherence): self
    {
        $this->Coherence = $Coherence;

        return $this;
    }

    public function getAllignement(): ?string
    {
        return $this->Allignement;
    }

    public function setAllignement(?string $Allignement): self
    {
        $this->Allignement = $Allignement;

        return $this;
    }

    public function getPresence(): ?string
    {
        return $this->Presence;
    }

    public function setPresence(?string $Presence): self
    {
        $this->Presence = $Presence;

        return $this;
    }

    public function getCompetences(): ?string
    {
        return $this->Competences;
    }

    public function setCompetences(?string $Competences): self
    {
        $this->Competences = $Competences;

        return $this;
    }

    public function getContinute(): ?string
    {
        return $this->Continute;
    }

    public function setContinute(?string $Continute): self
    {
        $this->Continute = $Continute;

        return $this;
    }

    public function getGain(): ?string
    {
        return $this->Gain;
    }

    public function setGain(?string $Gain): self
    {
        $this->Gain = $Gain;

        return $this;
    }

    public function getEfforts(): ?int
    {
        return $this->Efforts;
    }

    public function setEfforts(int $Efforts): self
    {
        $this->Efforts = $Efforts;

        return $this;
    }

    public function getAventages(): ?int
    {
        return $this->Aventages;
    }

    public function setAventages(int $Aventages): self
    {
        $this->Aventages = $Aventages;

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

    public function getDecision(): ?string
    {
        return $this->Decision;
    }

    public function setDecision(string $Decision): self
    {
        $this->Decision = $Decision;

        return $this;
    }

    public function getStategique(): ?StrategiqueOpportunite
    {
        return $this->Stategique;
    }

    public function setStategique(?StrategiqueOpportunite $Stategique): self
    {
        $this->Stategique = $Stategique;

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

    public function getCategorieOpportunite(): ?CategorieOpportunite
    {
        return $this->CategorieOpportunite;
    }

    public function setCategorieOpportunite(?CategorieOpportunite $CategorieOpportunite): self
    {
        $this->CategorieOpportunite = $CategorieOpportunite;

        return $this;
    }

    public function getEtatOpportunite(): ?string
    {
        return $this->EtatOpportunite;
    }

    public function setEtatOpportunite(string $EtatOpportunite): self
    {
        $this->EtatOpportunite = $EtatOpportunite;

        return $this;
    }

    public function getEffortReevaluation(): ?int
    {
        return $this->EffortReevaluation;
    }

    public function setEffortReevaluation(?int $EffortReevaluation): self
    {
        $this->EffortReevaluation = $EffortReevaluation;

        return $this;
    }

    public function getAventageReevaluation(): ?int
    {
        return $this->AventageReevaluation;
    }

    public function setAventageReevaluation(?int $AventageReevaluation): self
    {
        $this->AventageReevaluation = $AventageReevaluation;

        return $this;
    }

    public function getPoidsReevaluation(): ?int
    {
        return $this->PoidsReevaluation;
    }

    public function setPoidsReevaluation(?int $PoidsReevaluation): self
    {
        $this->PoidsReevaluation = $PoidsReevaluation;

        return $this;
    }

    public function getDecisionReevaluation(): ?string
    {
        return $this->DecisionReevaluation;
    }

    public function setDecisionReevaluation(?string $DecisionReevaluation): self
    {
        $this->DecisionReevaluation = $DecisionReevaluation;

        return $this;
    }

    public function getStrategiqueEvaluation(): ?StrategiqueOpportunite
    {
        return $this->StrategiqueEvaluation;
    }

    public function setStrategiqueEvaluation(?StrategiqueOpportunite $StrategiqueEvaluation): self
    {
        $this->StrategiqueEvaluation = $StrategiqueEvaluation;

        return $this;
    }

    public function getProcessLieReevaluation(): ?Processus
    {
        return $this->ProcessLieReevaluation;
    }

    public function setProcessLieReevaluation(?Processus $ProcessLieReevaluation): self
    {
        $this->ProcessLieReevaluation = $ProcessLieReevaluation;

        return $this;
    }

    public function getEtatOpportuniteReevaluation(): ?string
    {
        return $this->EtatOpportuniteReevaluation;
    }

    public function setEtatOpportuniteReevaluation(?string $EtatOpportuniteReevaluation): self
    {
        $this->EtatOpportuniteReevaluation = $EtatOpportuniteReevaluation;

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
            $numAction->setOpportunite($this);
        }

        return $this;
    }

    public function removeNumAction(PlanDeAction $numAction): self
    {
        if ($this->NumAction->contains($numAction)) {
            $this->NumAction->removeElement($numAction);
            // set the owning side to null (unless already changed)
            if ($numAction->getOpportunite() === $this) {
                $numAction->setOpportunite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlanDeAction[]
     */
    public function getNumActionReevaluation(): Collection
    {
        return $this->NumActionReevaluation;
    }

    public function addNumActionReevaluation(PlanDeAction $numActionReevaluation): self
    {
        if (!$this->NumActionReevaluation->contains($numActionReevaluation)) {
            $this->NumActionReevaluation[] = $numActionReevaluation;
            $numActionReevaluation->setOpportuniteReevalution($this);
        }

        return $this;
    }

    public function removeNumActionReevaluation(PlanDeAction $numActionReevaluation): self
    {
        if ($this->NumActionReevaluation->contains($numActionReevaluation)) {
            $this->NumActionReevaluation->removeElement($numActionReevaluation);
            // set the owning side to null (unless already changed)
            if ($numActionReevaluation->getOpportuniteReevalution() === $this) {
                $numActionReevaluation->setOpportuniteReevalution(null);
            }
        }

        return $this;
    }
}
