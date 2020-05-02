<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategoryStakeInternalRepository")
 */
class CategoryStakeInternal
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
    private $NameCategoryStakInternal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stake", mappedBy="CategoryStakeInternal")
     */
    private $stakes;

    public function __construct()
    {
        $this->stakes = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategoryStakInternal(): ?string
    {
        return $this->NameCategoryStakInternal;
    }

    public function setNameCategoryStakInternal(string $NameCategoryStakInternal): self
    {
        $this->NameCategoryStakInternal = $NameCategoryStakInternal;

        return $this;
    }

    /**
     * @return Collection|Stake[]
     */
    public function getstakes(): Collection
    {
        return $this->stakes;
    }
}
