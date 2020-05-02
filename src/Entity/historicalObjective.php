<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\HistoricalObjectiveRepository")
 */
class historicalObjective
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
    private $Time1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Time2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Time3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Time4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Time2020;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Time2021;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PredefinedIndicator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PerformanceIndicator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ObjectiveToWait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $InitialState;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CurrentStateIndicator;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Advancement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CurrentState;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Stake;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Processlie;

    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="HistoricalObjective")
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

    public function getTime1(): ?string
    {
        return $this->Time1;
    }

    public function setTime1(?string $Time1): self
    {
        $this->Time1 = $Time1;

        return $this;
    }

    public function getTime2(): ?string
    {
        return $this->Time2;
    }

    public function setTime2(?string $Time2): self
    {
        $this->Time2 = $Time2;

        return $this;
    }

    public function getTime3(): ?string
    {
        return $this->Time3;
    }

    public function setTime3(?string $Time3): self
    {
        $this->Time3 = $Time3;

        return $this;
    }

    public function getTime4(): ?string
    {
        return $this->Time4;
    }

    public function setTime4(?string $Time4): self
    {
        $this->Time4 = $Time4;

        return $this;
    }

    public function getTime2020(): ?string
    {
        return $this->Time2020;
    }

    public function setTime2020(?string $Time2020): self
    {
        $this->Time2020 = $Time2020;

        return $this;
    }

    public function getTime2021(): ?string
    {
        return $this->Time2021;
    }

    public function setTime2021(?string $Time2021): self
    {
        $this->Time2021 = $Time2021;

        return $this;
    }

    public function getPredefinedIndicator(): ?string
    {
        return $this->PredefinedIndicator;
    }

    public function setPredefinedIndicator(?string $PredefinedIndicator): self
    {
        $this->PredefinedIndicator = $PredefinedIndicator;

        return $this;
    }

    public function getPerformanceIndicator(): ?string
    {
        return $this->PerformanceIndicator;
    }

    public function setPerformanceIndicator(string $PerformanceIndicator): self
    {
        $this->PerformanceIndicator = $PerformanceIndicator;

        return $this;
    }

    public function getObjectiveToWait(): ?string
    {
        return $this->ObjectiveToWait;
    }

    public function setObjectiveToWait(string $ObjectiveToWait): self
    {
        $this->ObjectiveToWait = $ObjectiveToWait;

        return $this;
    }

    public function getInitialState(): ?string
    {
        return $this->InitialState;
    }

    public function setInitialState(string $InitialState): self
    {
        $this->InitialState = $InitialState;

        return $this;
    }

    public function getCurrentStateIndicator(): ?string
    {
        return $this->CurrentStateIndicator;
    }

    public function setCurrentStateIndicator(string $CurrentStateIndicator): self
    {
        $this->CurrentStateIndicator = $CurrentStateIndicator;

        return $this;
    }

    public function getAdvancement(): ?float
    {
        return $this->Advancement;
    }

    public function setAdvancement(?float $Advancement): self
    {
        $this->Advancement = $Advancement;

        return $this;
    }

    public function getCurrentState(): ?string
    {
        return $this->CurrentState;
    }

    public function setCurrentState(string $CurrentState): self
    {
        $this->CurrentState = $CurrentState;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getStake(): ?string
    {
        return $this->Stake;
    }

    public function setStake(string $Stake): self
    {
        $this->Stake = $Stake;

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
            $numAction->setHistoricalObjective($this);
        }

        return $this;
    }

    public function removeNumAction(ActionPlan $numAction): self
    {
        if ($this->NumAction->contains($numAction)) {
            $this->NumAction->removeElement($numAction);
            // set the owning side to null (unless already changed)
            if ($numAction->getHistoricalObjective() === $this) {
                $numAction->setHistoricalObjective(null);
            }
        }

        return $this;
    }
}
