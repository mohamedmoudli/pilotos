<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategoryStakeExternalRepository")
 */
class CategoryStakeExternal
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
    private $NameCategoryStakExternal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stake", mappedBy="CategoryStakeExternal")
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

    public function getNameCategoryStakExternal(): ?string
    {
        return $this->NameCategoryStakExternal;
    }

    public function setNameCategoryStakExternal(string $NameCategoryStakExternal): self
    {
        $this->NameCategoryStakExternal = $NameCategoryStakExternal;

        return $this;
    }

    /**
     * @return Collection|Stake[]
     */
    public function getStakes(): Collection
    {
        return $this->stakes;
    }

}
