<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objective", mappedBy="Enjeu")
     */
    private $objectives;

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

    /**
     * @return Collection|Objective[]
     */
    public function getObjectives(): Collection
    {
        return $this->objectives;
    }

    public function addObjective(Objective $objective): self
    {
        if (!$this->objectives->contains($objective)) {
            $this->objectives[] = $objective;
            $objective->setEnjeu($this);
        }

        return $this;
    }

    public function removeObjective(Objective $objective): self
    {
        if ($this->objectives->contains($objective)) {
            $this->objectives->removeElement($objective);
            // set the owning side to null (unless already changed)
            if ($objective->getEnjeu() === $this) {
                $objective->setEnjeu(null);
            }
        }

        return $this;
    }
}
