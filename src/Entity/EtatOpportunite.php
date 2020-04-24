<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EtatOpportuniteRepository")
 */
class EtatOpportunite
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
    private $NomEtatOpportunite;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtatOpportunite(): ?string
    {
        return $this->NomEtatOpportunite;
    }

    public function setNomEtatOpportunite(string $NomEtatOpportunite): self
    {
        $this->NomEtatOpportunite = $NomEtatOpportunite;

        return $this;
    }


}
