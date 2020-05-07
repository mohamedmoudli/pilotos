<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CurrentStateActionPlanRepository")
 */
class CurrentStateActionPlan
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
    private $NameCurrentState;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActionPlan", mappedBy="currentStateActionPlan")
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

    public function getNameCurrentState(): ?string
    {
        return $this->NameCurrentState;
    }

    public function setNameCurrentState(string $NameCurrentState): self
    {
        $this->NameCurrentState = $NameCurrentState;

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
            $actionPlan->setCurrentStateActionPlan($this);
        }

        return $this;
    }

    public function removeActionPlan(ActionPlan $actionPlan): self
    {
        if ($this->ActionPlans->contains($actionPlan)) {
            $this->ActionPlans->removeElement($actionPlan);
            // set the owning side to null (unless already changed)
            if ($actionPlan->getCurrentStateActionPlan() === $this) {
                $actionPlan->setCurrentStateActionPlan(null);
            }
        }

        return $this;
    }
}
