<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartieInteresseRepository")
 */
class Partieinteresse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $NomPI;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $Poids;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $Pouvoir;

    /**
     * @ORM\Column(type="integer"  , nullable=true)
     */
    private $Influence;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $interet;

    /**
     * @ORM\ManyToOne(targetEntity="Categoriepi", inversedBy="partieInteresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategoriesPI;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPI(): ?string
    {
        return $this->NomPI;
    }

    public function setNomPI(string $NomPI): self
    {
        $this->NomPI = $NomPI;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->Poids;
    }

    public function setPoids(int $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getPouvoir(): ?int
    {
        return $this->Pouvoir;
    }

    public function setPouvoir(int $Pouvoir): self
    {
        $this->Pouvoir = $Pouvoir;

        return $this;
    }

    public function getInfluence(): ?int
    {
        return $this->Influence;
    }

    public function setInfluence(int $Influence): self
    {
        $this->Influence = $Influence;

        return $this;
    }

    public function getInteret(): ?int
    {
        return $this->interet;
    }

    public function setInteret(int $interet): self
    {
        $this->interet = $interet;

        return $this;
    }

    public function getCategoriesPI(): ?Categoriepi
    {
        return $this->CategoriesPI;
    }

    public function setCategoriesPI(?Categoriepi $CategoriesPI): self
    {
        $this->CategoriesPI = $CategoriesPI;

        return $this;
    }




}
