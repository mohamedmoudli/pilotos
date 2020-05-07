<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlanDeActionRepository")
 */
class ActionPlan
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
    private $Origin;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Action;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $StartDatePanifies;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Delai;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Responsible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Director;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Consult;

    /**
     * @ORM\Column(type="integer")
     */
    private $Advancement;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ClosingCriterion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ProofOfClosure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CriteriaEfficiency;


    /**
     * @ORM\ManyToOne(targetEntity="ExigencyInterestedParty", inversedBy="planDeActions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ExigencyInterestedParty;

    /**
     * @ORM\ManyToOne(targetEntity="Risk", inversedBy="actionPlans")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Risk;

    /**
     * @ORM\ManyToOne(targetEntity="Opportunity", inversedBy="NumAction")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Opportunity;

    /**
     * @ORM\ManyToOne(targetEntity="Opportunity", inversedBy="NumActionReevaluation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $OpportunityReevalution;

    /**
     * @ORM\ManyToOne(targetEntity="HistoricalRisk", inversedBy="NumeroAction")
     * @ORM\JoinColumn(nullable=true)
     */
    private $HistoricalRisk;

    /**
     * @ORM\ManyToOne(targetEntity="HistoricalOpportunity", inversedBy="NumeroAction")
     * @ORM\JoinColumn(nullable=true)
     */
    private $HistoricalOpportunity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objective", inversedBy="NumAction")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Objective;

    /**
     * @ORM\ManyToOne(targetEntity="historicalObjective", inversedBy="NumAction")
     * @ORM\JoinColumn(nullable=true)
     */
    private $HistoricalObjective;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CurrentStateActionPlan", inversedBy="ActionPlans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $currentStateActionPlan;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StateEfficacyActionPlan", inversedBy="ActionPlans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stateEfficacyActionPlan;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAction(): ?string
    {
        return $this->Action;
    }

    /**
     * @param mixed $Action
     */
    public function setAction(string $Action): void
    {
        $this->Action = $Action;
    }

    /**
     * @return mixed
     */
    public function getStartDatePanifies()
    {
        return $this->StartDatePanifies;
    }

    /**
     * @param mixed $StartDatePanifies
     */
    public function setStartDatePanifies($StartDatePanifies): void
    {
        $this->StartDatePanifies = $StartDatePanifies;
    }





    public function getDelai(): ?string
    {
        return $this->Delai;
    }

    public function setDelai(string $Delai): self
    {
        $this->Delai = $Delai;

        return $this;
    }

    public function getResponsible(): ?string
    {
        return $this->Responsible;
    }

    public function setResponsible(string $Responsible): self
    {
        $this->Responsible = $Responsible;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->Director;
    }

    public function setDirector(string $Director): self
    {
        $this->Director = $Director;

        return $this;
    }

    public function getConsult(): ?string
    {
        return $this->Consult;
    }

    public function setConsult(string $Consult): self
    {
        $this->Consult = $Consult;

        return $this;
    }

    public function getAdvancement()
    {
        return $this->Advancement;
    }

    public function setAdvancement($Advancement): self
    {
        $this->Advancement = $Advancement;

        return $this;
    }

    public function getClosingCriterion(): ?string
    {
        return $this->ClosingCriterion;
    }

    public function setClosingCriterion(string $ClosingCriterion): self
    {
        $this->ClosingCriterion = $ClosingCriterion;

        return $this;
    }

    public function getProofOfClosure(): ?string
    {
        return $this->ProofOfClosure;
    }

    public function setProofOfClosure(string $ProofOfClosure): self
    {
        $this->ProofOfClosure = $ProofOfClosure;

        return $this;
    }

    public function getCriteriaEfficiency(): ?string
    {
        return $this->CriteriaEfficiency;
    }

    public function setCriteriaEfficiency(string $CriteriaEfficiency): self
    {
        $this->CriteriaEfficiency = $CriteriaEfficiency;

        return $this;
    }


    public function getExigencyInterestedParty(): ?ExigencyInterestedParty
    {
        return $this->ExigencyInterestedParty;
    }

    public function setExigencyInterestedParty(?ExigencyInterestedParty $ExigencyInterestedParty): self
    {
        $this->ExigencyInterestedParty = $ExigencyInterestedParty;

        return $this;
    }

    public function getRisk(): ?Risk
    {
        return $this->Risk;
    }

    public function setRisk(?Risk $Risk): self
    {
        $this->Risk = $Risk;

        return $this;
    }

    public function getOpportunity(): ?Opportunity
    {
        return $this->Opportunity;
    }

    public function setOpportunity(?Opportunity $opportunity): self
    {
        $this->opportunity = $opportunity;

        return $this;
    }

    public function getOpportunityReevalution(): ?Opportunity
    {
        return $this->OpportunityReevalution;
    }

    public function setOpportunityReevalution(?Opportunity $OpportunityReevalution): self
    {
        $this->OpportunityReevalution = $OpportunityReevalution;

        return $this;
    }

    public function getHistoricalRisk(): ?HistoricalRisk
    {
        return $this->HistoricalRisk;
    }

    public function setHistoricalRisk(?HistoricalRisk $HistoricalRisk): self
    {
        $this->HistoricalRisk = $HistoricalRisk;

        return $this;
    }

    public function getHistoricalOpportunity(): ?HistoricalOpportunity
    {
        return $this->HistoricalOpportunity;
    }

    public function setHistoricalOpportunity(?HistoricalOpportunity $HistoricalOpportunity): self
    {
        $this->HistoricalOpportunity = $HistoricalOpportunity;

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->Objective;
    }

    public function setObjective(?Objective $objective): self
    {
        $this->Objective = $objective;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->Origin;
    }

    /**
     * @param mixed $Origin
     */
    public function setOrigin($Origin): void
    {
        $this->Origin = $Origin;
    }

    public function getHistoricalObjective(): ?historicalObjective
    {
        return $this->HistoricalObjective;
    }

    public function setHistoricalObjective(?historicalObjective $HistoricalObjective): self
    {
        $this->HistoricalObjective = $HistoricalObjective;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->Comment;
    }

    /**
     * @param mixed $Comment
     */
    public function setComment($Comment): void
    {
        $this->Comment = $Comment;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description): void
    {
        $this->Description = $Description;
    }

    public function getCurrentStateActionPlan(): ?CurrentStateActionPlan
    {
        return $this->currentStateActionPlan;
    }

    public function setCurrentStateActionPlan(?CurrentStateActionPlan $currentStateActionPlan): self
    {
        $this->currentStateActionPlan = $currentStateActionPlan;

        return $this;
    }

    public function getStateEfficacyActionPlan(): ?StateEfficacyActionPlan
    {
        return $this->stateEfficacyActionPlan;
    }

    public function setStateEfficacyActionPlan(?StateEfficacyActionPlan $stateEfficacyActionPlan): self
    {
        $this->stateEfficacyActionPlan = $stateEfficacyActionPlan;

        return $this;
    }


}
