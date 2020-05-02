<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\HistoricalOpportunityRepository")
 */
class HistoricalOpportunity
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
    private $Etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commentaire;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="HistoricalOpportunity")
     */
    private $NumeroAction;

    public function __construct()
    {
        $this->NumeroAction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

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
     * @return Collection|ActionPlan[]
     */
    public function getNumeroAction(): Collection
    {
        return $this->NumeroAction;
    }

    public function addNumeroAction(ActionPlan $numeroAction): self
    {
        if (!$this->NumeroAction->contains($numeroAction)) {
            $this->NumeroAction[] = $numeroAction;
            $numeroAction->setHistoricalOpportunity($this);
        }

        return $this;
    }

    public function removeNumeroAction(ActionPlan $numeroAction): self
    {
        if ($this->NumeroAction->contains($numeroAction)) {
            $this->NumeroAction->removeElement($numeroAction);
            // set the owning side to null (unless already changed)
            if ($numeroAction->getHistoricalOpportunity() === $this) {
                $numeroAction->setHistoricalOpportunity(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date): void
    {
        $this->Date = $Date;
    }


}
