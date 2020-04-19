<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ExigencePIRepository")
 */
class Exigencepi
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
    private $EtatDeConfirmite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commantaire;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanDeAction", mappedBy="Exigencepi")
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

    public function getEtatDeConfirmite(): ?string
    {
        return $this->EtatDeConfirmite;
    }

    public function setEtatDeConfirmite(string $EtatDeConfirmite): self
    {
        $this->EtatDeConfirmite = $EtatDeConfirmite;

        return $this;
    }

    public function getCommantaire(): ?string
    {
        return $this->Commantaire;
    }

    public function setCommantaire(string $Commantaire): self
    {
        $this->Commantaire = $Commantaire;

        return $this;
    }



    /**
     * @return Collection|PlanDeAction[]
     */
    public function getPlanDeActions(): Collection
    {
        return $this->planDeActions;
    }

    public function addPlanDeAction(PlanDeAction $planDeAction): self
    {
        if (!$this->planDeActions->contains($planDeAction)) {
            $this->planDeActions[] = $planDeAction;
            $planDeAction->setExigencepi($this);
        }

        return $this;
    }

    public function removePlanDeAction(PlanDeAction $planDeAction): self
    {
        if ($this->planDeActions->contains($planDeAction)) {
            $this->planDeActions->removeElement($planDeAction);
            // set the owning side to null (unless already changed)
            if ($planDeAction->getExigencepi() === $this) {
                $planDeAction->setExigencepi(null);
            }
        }

        return $this;
    }
}
