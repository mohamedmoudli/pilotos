<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OpportunityRepository")
 */
class Opportunity
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
    private $ShortTerm;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $MediumTerm;

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
    private $Consistency;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Alignment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Presence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Skills;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Continuity;

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
    private $Advantage;

    /**
     * @ORM\Column(type="integer")
     */
    private $Weight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Decision;

    /**
     * @ORM\ManyToOne(targetEntity="StrategicOpportunity", inversedBy="opportunity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StrategicOpportunity;

    /**
     * @ORM\ManyToOne(targetEntity="Process", inversedBy="opportunites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProcessLie;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryOpportunity", inversedBy="opportunity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategoryOpportunity;



    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $EffortReevaluation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $AdvantageReevaluation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $LoadReevaluation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DecisionReevaluation;

    /**
     * @ORM\ManyToOne(targetEntity="StrategicOpportunity", inversedBy="opportunites")
     * @ORM\JoinColumn(nullable=true)
     */
    private $StrategicReevaluation;

    /**
     * @ORM\ManyToOne(targetEntity="Process", inversedBy="opportunites")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ProcessLieReevaluation;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;

    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="Opportunity")
     */
    private $NumAction;

    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="OpportunityReevalution")
     */
    private $NumActionReevaluation;

    /**
     * @ORM\ManyToOne(targetEntity="StateOpportunity", inversedBy="opportunity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StateOpportunity;

    /**
     * @ORM\ManyToOne(targetEntity="StateOpportunity", inversedBy="opportunit")
     * @ORM\JoinColumn(nullable=true)
     */
    private $StateOpportunityReevaluation;

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

    public function getShortTerm(): ?string
    {
        return $this->ShortTerm;
    }

    public function setShortTerm(string $ShortTerm): self
    {
        $this->ShortTerm = $ShortTerm;

        return $this;
    }

    public function getMediumTerm(): ?string
    {
        return $this->MediumTerm;
    }

    public function setMediumTerm(string $MediumTerm): self
    {
        $this->MediumTerm = $MediumTerm;

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

    public function getConsistency(): ?string
    {
        return $this->Consistency;
    }

    public function setConsistency(?string $Consistency): self
    {
        $this->Consistency = $Consistency;

        return $this;
    }

    public function getAlignment(): ?string
    {
        return $this->Alignment;
    }

    public function setAlignment(?string $Alignment): self
    {
        $this->Alignment = $Alignment;

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

    public function getSkills(): ?string
    {
        return $this->Skills;
    }

    public function setSkills(?string $Skills): self
    {
        $this->Skills = $Skills;

        return $this;
    }

    public function getContinuity(): ?string
    {
        return $this->Continuity;
    }

    public function setContinuity(?string $Continuity): self
    {
        $this->Continuity = $Continuity;

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

    public function getAdvantage(): ?int
    {
        return $this->Advantage;
    }

    public function setAdvantage(int $Advantage): self
    {
        $this->Advantage = $Advantage;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->Weight;
    }

    public function setWeight(int $Weight): self
    {
        $this->Weight = $Weight;

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

    public function getStrategicOpportunity(): ?StrategicOpportunity
    {
        return $this->StrategicOpportunity;
    }

    public function setStrategicOpportunity(?StrategicOpportunity $StrategicOpportunity): self
    {
        $this->StrategicOpportunity = $StrategicOpportunity;

        return $this;
    }

    public function getProcessLie(): ?Process
    {
        return $this->ProcessLie;
    }

    public function setProcessLie(?Process $ProcessLie): self
    {
        $this->ProcessLie = $ProcessLie;

        return $this;
    }

    public function getCategoryOpportunity(): ?CategoryOpportunity
    {
        return $this->CategoryOpportunity;
    }

    public function setCategoryOpportunity(?CategoryOpportunity $CategoryOpportunity): self
    {
        $this->CategoryOpportunity = $CategoryOpportunity;

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

    public function getAdvantageReevaluation(): ?int
    {
        return $this->AdvantageReevaluation;
    }

    public function setAdvantageReevaluation(?int $AdvantageReevaluation): self
    {
        $this->AdvantageReevaluation = $AdvantageReevaluation;

        return $this;
    }

    public function getLoadReevaluation(): ?int
    {
        return $this->LoadReevaluation;
    }

    public function setLoadReevaluation(?int $LoadReevaluation): self
    {
        $this->LoadReevaluation = $LoadReevaluation;

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

    public function getStrategicReevaluation(): ?StrategicOpportunity
    {
        return $this->StrategicReevaluation;
    }

    public function setStrategicReevaluation(?StrategicOpportunity $StrategicReevaluation): self
    {
        $this->StrategicReevaluation = $StrategicReevaluation;

        return $this;
    }

    public function getProcessLieReevaluation(): ?Process
    {
        return $this->ProcessLieReevaluation;
    }

    public function setProcessLieReevaluation(?Process $ProcessLieReevaluation): self
    {
        $this->ProcessLieReevaluation = $ProcessLieReevaluation;

        return $this;
    }


    public function getComment(): ?string
    {
        return $this->Comment;
    }

    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }

    /**
     * @return Collection|ActionPlan[]
     */
    public function getNumAction(): Collection
    {
        return $this->NumAction;
    }

    public function addNumAction(ActionPlan $numAction): self
    {
        if (!$this->NumAction->contains($numAction)) {
            $this->NumAction[] = $numAction;
            $numAction->setOpportunity($this);
        }

        return $this;
    }

    public function removeNumAction(ActionPlan $numAction): self
    {
        if ($this->NumAction->contains($numAction)) {
            $this->NumAction->removeElement($numAction);
            // set the owning side to null (unless already changed)
            if ($numAction->getOpportunity() === $this) {
                $numAction->setOpportunity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ActionPlan[]
     */
    public function getNumActionReevaluation(): Collection
    {
        return $this->NumActionReevaluation;
    }

    public function addNumActionReevaluation(ActionPlan $numActionReevaluation): self
    {
        if (!$this->NumActionReevaluation->contains($numActionReevaluation)) {
            $this->NumActionReevaluation[] = $numActionReevaluation;
            $numActionReevaluation->setOpportunityReevalution($this);
        }

        return $this;
    }

    public function removeNumActionReevaluation(ActionPlan $numActionReevaluation): self
    {
        if ($this->NumActionReevaluation->contains($numActionReevaluation)) {
            $this->NumActionReevaluation->removeElement($numActionReevaluation);
            // set the owning side to null (unless already changed)
            if ($numActionReevaluation->getOpportunityReevalution() === $this) {
                $numActionReevaluation->setOpportunityReevalution(null);
            }
        }

        return $this;
    }

    public function getStateOpportunity(): ?StateOpportunity
    {
        return $this->StateOpportunity;
    }

    public function setStateOpportunity(?StateOpportunity $StateOpportunity): self
    {
        $this->StateOpportunity = $StateOpportunity;

        return $this;
    }

    public function getStateOpportunityReevaluation(): ?StateOpportunity
    {
        return $this->StateOpportunityReevaluation;
    }

    public function setStateOpportunityReevaluation(?StateOpportunity $StateOpportunityReevaluation): self
    {
        $this->StateOpportunityReevaluation = $StateOpportunityReevaluation;

        return $this;
    }
}
