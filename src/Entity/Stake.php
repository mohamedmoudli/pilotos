<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StakeRepository")
 */
class Stake
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeStake", inversedBy="stakes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Type;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryStakeInternal", inversedBy="stakes")
     */
    private $CategoryStakeInternal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryStakeExternal", inversedBy="stakes")
     */
    private $CategoryStakeExternal;



    public function __construct()
    {
        $this->objectives = new ArrayCollection();
    }


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



    public function getType(): ?TypeStake
    {
        return $this->Type;
    }

    public function setType(?TypeStake $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getCategoryStakeInternal(): ?CategoryStakeInternal
    {
        return $this->CategoryStakeInternal;
    }

    public function setCategoryStakeInternal(?CategoryStakeInternal $CategoryStakeInternal): self
    {
        $this->CategoryStakeInternal = $CategoryStakeInternal;

        return $this;
    }

    public function getCategoryStakeExternal(): ?CategoryStakeExternal
    {
        return $this->CategoryStakeExternal;
    }

    public function setCategoryStakeExternal(?CategoryStakeExternal $CategoryStakeExternal): self
    {
        $this->CategoryStakeExternal = $CategoryStakeExternal;

        return $this;
    }



}
