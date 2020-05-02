<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RiskRepository")
 */
class Risk
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
    private $Causes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Censequence;

    /**
     * @ORM\Column(type="integer")
     */
    private $Gravity;

    /**
     * @ORM\Column(type="integer")
     */
    private $Probability;

    /**
     * @ORM\Column(type="integer")
     */
    private $detectability;

    /**
     * @ORM\Column(type="integer")
     */
    private $Criticality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Decision;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShortTerm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MediumTerm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LongTerm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateIdentification;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;


    /**
     * @ORM\ManyToOne(targetEntity="Process", inversedBy="risques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Process;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryRisk", inversedBy="risk")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategoryRisk;

    /**
     * @ORM\ManyToOne(targetEntity="StrategicRisk", inversedBy="risk")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StrategicRisk;

    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="Risk")
     */
    private $actionPlans;

    /**
     * @ORM\ManyToOne(targetEntity="StateRisk", inversedBy="risk")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StateRisk;

    public function __construct()
    {
        $this->actionPlans = new ArrayCollection();
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

    public function getCauses(): ?string
    {
        return $this->Causes;
    }

    public function setCauses(string $Causes): self
    {
        $this->Causes = $Causes;

        return $this;
    }

    public function getCensequence(): ?string
    {
        return $this->Censequence;
    }

    public function setCensequence(string $Censequence): self
    {
        $this->Censequence = $Censequence;

        return $this;
    }

    public function getGravity(): ?int
    {
        return $this->Gravity;
    }

    public function setGravity(int $Gravity): self
    {
        $this->Gravity = $Gravity;

        return $this;
    }

    public function getProbability(): ?int
    {
        return $this->Probability;
    }

    public function setProbability(int $Probability): self
    {
        $this->Probability = $Probability;

        return $this;
    }

    public function getDetectability(): ?int
    {
        return $this->detectability;
    }

    public function setDetectability(int $detectability): self
    {
        $this->detectability = $detectability;

        return $this;
    }

    public function getCriticality(): ?int
    {
        return $this->Criticality;
    }

    public function setCriticality(int $Criticality): self
    {
        $this->Criticality = $Criticality;

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

    public function getShortTerm(): ?string
    {
        return $this->ShortTerm;
    }

    public function setShortTerm(?string $ShortTerm): self
    {
        $this->ShortTerm = $ShortTerm;

        return $this;
    }

    public function getMediumTerm(): ?string
    {
        return $this->MediumTerm;
    }

    public function setMediumTerm(?string $MediumTerm): self
    {
        $this->MediumTerm= $MediumTerm;

        return $this;
    }

    public function getLongTerm(): ?string
    {
        return $this->LongTerm;
    }

    public function setLongTerm(?string $LongTerm): self
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



    public function getComment(): ?string
    {
        return $this->Comment;
    }

    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }


    public function getProcess(): ?Process
    {
        return $this->Process;
    }

    public function setProcess(?Process $Process): self
    {
        $this->Process = $Process;

        return $this;
    }

    public function getCategoryRisk(): ?CategoryRisk
    {
        return $this->CategoryRisk;
    }

    public function setCategoryRisk(?CategoryRisk $CategoryRisk): self
    {
        $this->CategoryRisk = $CategoryRisk;

        return $this;
    }

    public function getStrategicRisk(): ?StrategicRisk
    {
        return $this->StrategicRisk;
    }

    public function setStrategicRisk(?StrategicRisk $StrategicRisk): self
    {
        $this->StrategicRisk = $StrategicRisk;

        return $this;
    }

    /**
     * @return Collection|ActionPlan[]
     */
    public function getactionPlans(): Collection
    {
        return $this->actionPlans;
    }

    public function addPlanDeAction(ActionPlan $planDeAction): self
    {
        if (!$this->actionPlans->contains($planDeAction)) {
            $this->actionPlans[] = $planDeAction;
            $planDeAction->setRisk($this);
        }

        return $this;
    }

    public function removePlanDeAction(ActionPlan $planDeAction): self
    {
        if ($this->actionPlans->contains($planDeAction)) {
            $this->actionPlans->removeElement($planDeAction);
            // set the owning side to null (unless already changed)
            if ($planDeAction->getRisk() === $this) {
                $planDeAction->setRisk(null);
            }
        }

        return $this;
    }

    public function getStateRisk(): ?StateRisk
    {
        return $this->StateRisk;
    }

    public function setStateRisk(?StateRisk $StateRisk): self
    {
        $this->StateRisk = $StateRisk;

        return $this;
    }
}
