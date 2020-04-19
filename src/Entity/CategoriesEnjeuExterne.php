<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesEnjeuExterneRepository")
 */
class CategoriesEnjeuExterne
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
    private $NomCategorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enjeu", mappedBy="categoriesEnjeuExterne")
     */
    private $enjeus;

    public function __construct()
    {
        $this->enjeus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->NomCategorie;
    }

    public function setNomCategorie(string $NomCategorie): self
    {
        $this->NomCategorie = $NomCategorie;

        return $this;
    }

    /**
     * @return Collection|Enjeu[]
     */
    public function getEnjeus(): Collection
    {
        return $this->enjeus;
    }

    public function addEnjeus(Enjeu $enjeus): self
    {
        if (!$this->enjeus->contains($enjeus)) {
            $this->enjeus[] = $enjeus;
            $enjeus->setCategoriesEnjeuExterne($this);
        }

        return $this;
    }

    public function removeEnjeus(Enjeu $enjeus): self
    {
        if ($this->enjeus->contains($enjeus)) {
            $this->enjeus->removeElement($enjeus);
            // set the owning side to null (unless already changed)
            if ($enjeus->getCategoriesEnjeuExterne() === $this) {
                $enjeus->setCategoriesEnjeuExterne(null);
            }
        }

        return $this;
    }
}
