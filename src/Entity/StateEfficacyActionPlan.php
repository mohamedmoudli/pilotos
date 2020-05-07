<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StateEfficacyActionPlanRepository")
 */
class StateEfficacyActionPlan
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
    private $NameStateEfficacy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActionPlan", mappedBy="stateEfficacyActionPlan")
     */
    private $ActionPlans;

    public function __construct()
    {
        $this->ActionPlans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameStateEfficacy(): ?string
    {
        return $this->NameStateEfficacy;
    }

    public function setNameStateEfficacy(string $NameStateEfficacy): self
    {
        $this->NameStateEfficacy = $NameStateEfficacy;

        return $this;
    }

    /**
     * @return Collection|ActionPlan[]
     */
    public function getActionPlans(): Collection
    {
        return $this->ActionPlans;
    }

    public function addActionPlan(ActionPlan $actionPlan): self
    {
        if (!$this->ActionPlans->contains($actionPlan)) {
            $this->ActionPlans[] = $actionPlan;
            $actionPlan->setStateEfficacyActionPlan($this);
        }

        return $this;
    }

    public function removeActionPlan(ActionPlan $actionPlan): self
    {
        if ($this->ActionPlans->contains($actionPlan)) {
            $this->ActionPlans->removeElement($actionPlan);
            // set the owning side to null (unless already changed)
            if ($actionPlan->getStateEfficacyActionPlan() === $this) {
                $actionPlan->setStateEfficacyActionPlan(null);
            }
        }

        return $this;
    }
}
