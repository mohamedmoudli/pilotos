<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueRisqueRepository")
 */
class HistoriqueRisque
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Criticite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Decision;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Strategique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Processlie;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatRisque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commentaires;

    /**
     * @ORM\Column(type="date")
     */
    private $DateENregistrement;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $NumeroAction = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCriticite(): ?int
    {
        return $this->Criticite;
    }

    public function setCriticite(int $Criticite): self
    {
        $this->Criticite = $Criticite;

        return $this;
    }

    public function getDecision(): ?string
    {
        return $this->Decision;
    }

    public function setDecision(string $Decision): self
    {
        $this->Decision = $Decision;

        return $this;
    }

    public function getStrategique(): ?string
    {
        return $this->Strategique;
    }

    public function setStrategique(string $Strategique): self
    {
        $this->Strategique = $Strategique;

        return $this;
    }

    public function getProcesslie(): ?string
    {
        return $this->Processlie;
    }

    public function setProcesslie(string $Processlie): self
    {
        $this->Processlie = $Processlie;

        return $this;
    }



    public function getEtatRisque(): ?string
    {
        return $this->EtatRisque;
    }

    public function setEtatRisque(string $EtatRisque): self
    {
        $this->EtatRisque = $EtatRisque;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->Commentaires;
    }

    public function setCommentaires(string $Commentaires): self
    {
        $this->Commentaires = $Commentaires;

        return $this;
    }

    public function getDateENregistrement(): ?\DateTimeInterface
    {
        return $this->DateENregistrement;
    }

    public function setDateENregistrement(\DateTimeInterface $DateENregistrement): self
    {
        $this->DateENregistrement = $DateENregistrement;

        return $this;
    }

    public function getNumeroAction(): ?array
    {
        return $this->NumeroAction;
    }

    public function setNumeroAction(?array $NumeroAction): self
    {
        $this->NumeroAction = $NumeroAction;

        return $this;
    }
}
