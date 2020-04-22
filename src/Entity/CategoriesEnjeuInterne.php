<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesEnjeuRepository")
 */
class CategoriesEnjeuInterne
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
    private $NomCategories;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeEnjeu", inversedBy="categoriesEnjeuInternes")
     */
    private $TypeEnjeu;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategories(): ?string
    {
        return $this->NomCategories;
    }

    public function setNomCategories(string $NomCategories): self
    {
        $this->NomCategories = $NomCategories;

        return $this;
    }


    public function getTypeEnjeu(): ?TypeEnjeu
    {
        return $this->TypeEnjeu;
    }

    public function setTypeEnjeu(?TypeEnjeu $TypeEnjeu): self
    {
        $this->TypeEnjeu = $TypeEnjeu;

        return $this;
    }
}
