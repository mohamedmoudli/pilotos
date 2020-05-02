<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategoryInterestedPartyRepository")
 */
class CategoryeInterestedParty
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
    private $NameCategory;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IntersetedParty", mappedBy="CategoryInterestedParty")
     */
    private $intersetedParties;


    public function __construct()
    {
        $this->partieinteresses = new ArrayCollection();
        $this->intersetedParties = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->NameCategory;
    }

    public function setNameCategory(string $NameCategory): self
    {
        $this->NameCategory = $NameCategory;

        return $this;
    }

    /**
     * @return Collection|IntersetedParty[]
     */
    public function getIntersetedParties(): Collection
    {
        return $this->intersetedParties;
    }

    public function addIntersetedParty(IntersetedParty $intersetedParty): self
    {
        if (!$this->intersetedParties->contains($intersetedParty)) {
            $this->intersetedParties[] = $intersetedParty;
            $intersetedParty->setCategoryInterestedParty($this);
        }

        return $this;
    }

    public function removeIntersetedParty(IntersetedParty $intersetedParty): self
    {
        if ($this->intersetedParties->contains($intersetedParty)) {
            $this->intersetedParties->removeElement($intersetedParty);
            // set the owning side to null (unless already changed)
            if ($intersetedParty->getCategoryInterestedParty() === $this) {
                $intersetedParty->setCategoryInterestedParty(null);
            }
        }

        return $this;
    }


}
