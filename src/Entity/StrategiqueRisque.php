<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StrategiqueRisqueRepository")
 */
class StrategiqueRisque
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
    private $NomSrategique;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSrategique(): ?string
    {
        return $this->NomSrategique;
    }

    public function setNomSrategique(string $NomSrategique): self
    {
        $this->NomSrategique = $NomSrategique;

        return $this;
    }

}
