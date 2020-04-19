<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EnjeuRepository")
 */
class Enjeu
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
     * @ORM\ManyToOne(targetEntity="CategoriesEnjeuInterne", inversedBy="enjeus")
     * @ORM\JoinColumn(nullable=true)
     */
    private $CategoriesEnjeu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoriesEnjeuExterne", inversedBy="enjeus")
     * @ORM\JoinColumn(nullable=true)
     */
    private $categoriesEnjeuExterne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeEnjeu", inversedBy="enjeus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeEnjeu;

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


    public function getCategoriesEnjeu(): ?CategoriesEnjeuInterne
    {
        return $this->CategoriesEnjeu;
    }

    public function setCategoriesEnjeu(?CategoriesEnjeuInterne $CategoriesEnjeu): self
    {
        $this->CategoriesEnjeu = $CategoriesEnjeu;

        return $this;
    }

    public function getCategoriesEnjeuExterne(): ?CategoriesEnjeuExterne
    {
        return $this->categoriesEnjeuExterne;
    }

    public function setCategoriesEnjeuExterne(?CategoriesEnjeuExterne $categoriesEnjeuExterne): self
    {
        $this->categoriesEnjeuExterne = $categoriesEnjeuExterne;

        return $this;
    }

    public function getTypeEnjeu(): ?TypeEnjeu
    {
        return $this->typeEnjeu;
    }

    public function setTypeEnjeu(?TypeEnjeu $typeEnjeu): self
    {
        $this->typeEnjeu = $typeEnjeu;

        return $this;
    }
}
