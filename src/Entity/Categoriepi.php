<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categoriepi
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
    private $nomcat;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partieinteresse", mappedBy="CategoriesPI")
     */
    private $partieinteresses;

    public function __construct()
    {
        $this->partieinteresses = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcat(): ?string
    {
        return $this->nomcat;
    }

    public function setNomcat(string $nomcat): self
    {
        $this->nomcat = $nomcat;

        return $this;
    }

    /**
     * @return Collection|Partieinteresse[]
     */
    public function getPartieinteresses(): Collection
    {
        return $this->partieinteresses;
    }

    public function addPartieinteress(Partieinteresse $partieinteress): self
    {
        if (!$this->partieinteresses->contains($partieinteress)) {
            $this->partieinteresses[] = $partieinteress;
            $partieinteress->setCategoriesPI($this);
        }

        return $this;
    }

    public function removePartieinteress(Partieinteresse $partieinteress): self
    {
        if ($this->partieinteresses->contains($partieinteress)) {
            $this->partieinteresses->removeElement($partieinteress);
            // set the owning side to null (unless already changed)
            if ($partieinteress->getCategoriesPI() === $this) {
                $partieinteress->setCategoriesPI(null);
            }
        }

        return $this;
    }


}
