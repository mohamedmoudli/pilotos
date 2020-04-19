<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TypeEnjeuRepository")
 */
class TypeEnjeu
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
    private $NomType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enjeu", mappedBy="typeEnjeu")
     */
    private $enjeus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategoriesEnjeuInterne", mappedBy="TypeEnjeu")
     */
    private $categoriesEnjeuInternes;

    public function __construct()
    {
        $this->enjeus = new ArrayCollection();
        $this->categoriesEnjeuInternes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomType(): ?string
    {
        return $this->NomType;
    }

    public function setNomType(string $NomType): self
    {
        $this->NomType = $NomType;

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
            $enjeus->setTypeEnjeu($this);
        }

        return $this;
    }

    public function removeEnjeus(Enjeu $enjeus): self
    {
        if ($this->enjeus->contains($enjeus)) {
            $this->enjeus->removeElement($enjeus);
            // set the owning side to null (unless already changed)
            if ($enjeus->getTypeEnjeu() === $this) {
                $enjeus->setTypeEnjeu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategoriesEnjeuInterne[]
     */
    public function getCategoriesEnjeuInternes(): Collection
    {
        return $this->categoriesEnjeuInternes;
    }

    public function addCategoriesEnjeuInterne(CategoriesEnjeuInterne $categoriesEnjeuInterne): self
    {
        if (!$this->categoriesEnjeuInternes->contains($categoriesEnjeuInterne)) {
            $this->categoriesEnjeuInternes[] = $categoriesEnjeuInterne;
            $categoriesEnjeuInterne->setTypeEnjeu($this);
        }

        return $this;
    }

    public function removeCategoriesEnjeuInterne(CategoriesEnjeuInterne $categoriesEnjeuInterne): self
    {
        if ($this->categoriesEnjeuInternes->contains($categoriesEnjeuInterne)) {
            $this->categoriesEnjeuInternes->removeElement($categoriesEnjeuInterne);
            // set the owning side to null (unless already changed)
            if ($categoriesEnjeuInterne->getTypeEnjeu() === $this) {
                $categoriesEnjeuInterne->setTypeEnjeu(null);
            }
        }

        return $this;
    }
}
