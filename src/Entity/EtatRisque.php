<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EtatRisqueRepository")
 */
class EtatRisque
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
    private $NomEtatRisque;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Risque", mappedBy="EtatRisque")
     */
    private $risques;

    public function __construct()
    {
        $this->risques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtatRisque(): ?string
    {
        return $this->NomEtatRisque;
    }

    public function setNomEtatRisque(string $NomEtatRisque): self
    {
        $this->NomEtatRisque = $NomEtatRisque;

        return $this;
    }

}
