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
class IntersetedParty
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
    private $NameInterestedParty;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $Weight;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $Power;

    /**
     * @ORM\Column(type="integer"  , nullable=true)
     */
    private $Influence;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $Interest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryeInterestedParty", inversedBy="intersetedParties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategoryInterestedParty;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameInterestedParty(): ?string
    {
        return $this->NameInterestedParty;
    }

    public function setNameInterestedParty(string $NameInterestedParty): self
    {
        $this->NameInterestedParty = $NameInterestedParty;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->Weight;
    }

    public function setWeight(int $Weight): self
    {
        $this->Weight = $Weight;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->Power;
    }

    public function setPower(int $Power): self
    {
        $this->Power = $Power;

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

    public function getInterest(): ?int
    {
        return $this->Interest;
    }

    public function setInterest(int $Interest): self
    {
        $this->Interest = $Interest;

        return $this;
    }

    public function getCategoryInterestedParty(): ?CategoryeInterestedParty
    {
        return $this->CategoryInterestedParty;
    }

    public function setCategoryInterestedParty(?CategoryeInterestedParty $CategoryInterestedParty): self
    {
        $this->CategoryInterestedParty = $CategoryInterestedParty;

        return $this;
    }

}
