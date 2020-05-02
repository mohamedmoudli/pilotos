<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategoryOpportunityRepository")
 */
class CategoryOpportunity
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
    private $NameCategoryOpportunity;



    public function __construct()
    {
        $this->opportunites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNameCategoryOpportunity(): ?string
    {
        return $this->NameCategoryOpportunity;
    }

    public function setNameCategoryOpportunity(string $NameCategoryOpportunity): self
    {
        $this->NameCategoryOpportunity = $NameCategoryOpportunity;

        return $this;
    }

}
