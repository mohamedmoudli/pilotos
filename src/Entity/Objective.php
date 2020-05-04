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
    private $DescriptionStake;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Time1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Time2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Time3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Time4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Time2020;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Time2021;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
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
    private $CurrentState;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CurrentStateIndiactor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;



    /**
     * @ORM\ManyToOne(targetEntity="Process", inversedBy="objectives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProcessLie;

    /**
     * @ORM\Column(type="float"  , nullable=true)
     */
    private $Advancement;

    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="Objective")
     */
    private $NumAction;

    /**
     * @ORM\ManyToOne(targetEntity="Stake", inversedBy="objectives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Stake;

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

    /**
     * @return mixed
     */
    public function getTime1()
    {
        return $this->Time1;
    }

    /**
     * @param mixed $Time1
     */
    public function setTime1($Time1): void
    {
        $this->Time1 = $Time1;
    }

    /**
     * @return mixed
     */
    public function getTime2()
    {
        return $this->Time2;
    }

    /**
     * @param mixed $Time2
     */
    public function setTime2($Time2): void
    {
        $this->Time2 = $Time2;
    }

    /**
     * @return mixed
     */
    public function getTime3()
    {
        return $this->Time3;
    }

    /**
     * @param mixed $Time3
     */
    public function setTime3($Time3): void
    {
        $this->Time3 = $Time3;
    }

    /**
     * @return mixed
     */
    public function getTime4()
    {
        return $this->Time4;
    }

    /**
     * @param mixed $Time4
     */
    public function setTime4($Time4): void
    {
        $this->Time4 = $Time4;
    }

    /**
     * @return mixed
     */
    public function getTime2020()
    {
        return $this->Time2020;
    }

    /**
     * @param mixed $Time2020
     */
    public function setTime2020($Time2020): void
    {
        $this->Time2020 = $Time2020;
    }

    /**
     * @return mixed
     */
    public function getTime2021()
    {
        return $this->Time2021;
    }

    /**
     * @param mixed $Time2021
     */
    public function setTime2021($Time2021): void
    {
        $this->Time2021 = $Time2021;
    }

    /**
     * @return mixed
     */
    public function getPredefinedIndicator()
    {
        return $this->PredefinedIndicator;
    }

    /**
     * @param mixed $PredefinedIndicator
     */
    public function setPredefinedIndicator($PredefinedIndicator): void
    {
        $this->PredefinedIndicator = $PredefinedIndicator;
    }

    /**
     * @return mixed
     */
    public function getPerformanceIndicator()
    {
        return $this->PerformanceIndicator;
    }

    /**
     * @param mixed $PerformanceIndicator
     */
    public function setPerformanceIndicator($PerformanceIndicator): void
    {
        $this->PerformanceIndicator = $PerformanceIndicator;
    }

    /**
     * @return mixed
     */
    public function getObjectiveToWait()
    {
        return $this->ObjectiveToWait;
    }

    /**
     * @param mixed $ObjectiveToWait
     */
    public function setObjectiveToWait($ObjectiveToWait): void
    {
        $this->ObjectiveToWait = $ObjectiveToWait;
    }

    /**
     * @return mixed
     */
    public function getInitialState()
    {
        return $this->InitialState;
    }

    /**
     * @param mixed $InitialState
     */
    public function setInitialState($InitialState): void
    {
        $this->InitialState = $InitialState;
    }

    /**
     * @return mixed
     */
    public function getCurrentState()
    {
        return $this->CurrentState;
    }

    /**
     * @param mixed $CurrentState
     */
    public function setCurrentState($CurrentState): void
    {
        $this->CurrentState = $CurrentState;
    }

    /**
     * @return mixed
     */
    public function getCurrentStateIndiactor()
    {
        return $this->CurrentStateIndiactor;
    }

    /**
     * @param mixed $CurrentStateIndiactor
     */
    public function setCurrentStateIndiactor($CurrentStateIndiactor): void
    {
        $this->CurrentStateIndiactor = $CurrentStateIndiactor;
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
    public function getAdvancement()
    {
        return $this->Advancement;
    }

    /**
     * @param mixed $Advancement
     */
    public function setAdvancement($Advancement): void
    {
        $this->Advancement = $Advancement;
    }


    public function getStake(): ?Stake
    {
        return $this->Stake;
    }

    public function setStake(?Stake $Stake ): self
    {
        $this->Stake = $Stake;

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
            $numAction->setObjective($this);
        }

        return $this;
    }

    public function removeNumAction(ActionPlan $numAction): self
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

    /**
     * @return mixed
     */
    public function getDescriptionStake()
    {
        return $this->DescriptionStake;
    }

    /**
     * @param mixed $DescriptionStake
     */
    public function setDescriptionStake($DescriptionStake): void
    {
        $this->DescriptionStake = $DescriptionStake;
    }

}
