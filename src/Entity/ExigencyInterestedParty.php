<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ExigencyInterestedPartyRepository")
 */
class ExigencyInterestedParty
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
    private $StateOfConfirmity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;



    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="ExigencyInterestedParty")
     */
    private $planDeActions;

    public function __construct()
    {
        $this->planDeActions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStateOfConfirmity(): ?string
    {
        return $this->StateOfConfirmity;
    }

    public function setStateOfConfirmity(string $StateOfConfirmity): self
    {
        $this->StateOfConfirmity = $StateOfConfirmity;

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
    public function getPlanDeActions(): Collection
    {
        return $this->planDeActions;
    }

    public function addPlanDeAction(ActionPlan $planDeAction): self
    {
        if (!$this->planDeActions->contains($planDeAction)) {
            $this->planDeActions[] = $planDeAction;
            $planDeAction->setExigencyInterestedParty($this);
        }

        return $this;
    }

    public function removePlanDeAction(ActionPlan $planDeAction): self
    {
        if ($this->planDeActions->contains($planDeAction)) {
            $this->planDeActions->removeElement($planDeAction);
            // set the owning side to null (unless already changed)
            if ($planDeAction->getExigencyInterestedParty() === $this) {
                $planDeAction->setExigencyInterestedParty(null);
            }
        }

        return $this;
    }
}
