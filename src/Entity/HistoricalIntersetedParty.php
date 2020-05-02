<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\HistoricalInterestedPartyRepository")
 */
class HistoricalIntersetedParty
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
    private $NomPI;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $Poids;


    /**
     * @ORM\Column(type="date")
     */
    private $Date;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPI(): ?string
    {
        return $this->NomPI;
    }

    public function setNomPI(string $NomPI): self
    {
        $this->NomPI = $NomPI;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->Poids;
    }

    public function setPoids(int $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date): void
    {
        $this->Date = $Date;
    }







}
