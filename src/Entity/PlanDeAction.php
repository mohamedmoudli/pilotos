<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlanDeActionRepository")
 */
class PlanDeAction
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
    private $Origine;

    /**
     * @return mixed
     */
    public function getOrigine()
    {
        return $this->Origine;
    }

    /**
     * @param mixed $Origine
     */
    public function setOrigine($Origine): void
    {
        $this->Origine = $Origine;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Action;

    /**
     * @ORM\Column(type="date")
     */
    private $DateDebutPanifie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Delai;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Respensable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Realisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Consulter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Avencement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CritereDeCloture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PreuveDeCloture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CritaireEfficacite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatDeEfficacite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatActuel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exigencepi", inversedBy="planDeActions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Exigencepi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Risque", inversedBy="planDeActions")
     */
    private $Risque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Opportunite", inversedBy="NumAction")
     */
    private $opportunite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Opportunite", inversedBy="NumActionReevaluation")
     */
    private $opportuniteReevalution;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HistoriqueRisque", inversedBy="NumeroAction")
     */
    private $historiqueRisque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HistoriqueOpportunite", inversedBy="NumeroAction")
     */
    private $historiqueOpportunite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objective", inversedBy="NumAction")
     */
    private $objective;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?string
    {
        return $this->Action;
    }

    public function setAction(string $Action): self
    {
        $this->Action = $Action;

        return $this;
    }

    public function getDateDebutPanifie(): ?\DateTimeInterface
    {
        return $this->DateDebutPanifie;
    }

    public function setDateDebutPanifie(\DateTimeInterface $DateDebutPanifie): self
    {
        $this->DateDebutPanifie = $DateDebutPanifie;

        return $this;
    }

    public function getDelai(): ?string
    {
        return $this->Delai;
    }

    public function setDelai(string $Delai): self
    {
        $this->Delai = $Delai;

        return $this;
    }

    public function getRespensable(): ?string
    {
        return $this->Respensable;
    }

    public function setRespensable(string $Respensable): self
    {
        $this->Respensable = $Respensable;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->Realisateur;
    }

    public function setRealisateur(string $Realisateur): self
    {
        $this->Realisateur = $Realisateur;

        return $this;
    }

    public function getConsulter(): ?string
    {
        return $this->Consulter;
    }

    public function setConsulter(string $Consulter): self
    {
        $this->Consulter = $Consulter;

        return $this;
    }

    public function getAvencement(): ?string
    {
        return $this->Avencement;
    }

    public function setAvencement(string $Avencement): self
    {
        $this->Avencement = $Avencement;

        return $this;
    }

    public function getCritereDeCloture(): ?string
    {
        return $this->CritereDeCloture;
    }

    public function setCritereDeCloture(string $CritereDeCloture): self
    {
        $this->CritereDeCloture = $CritereDeCloture;

        return $this;
    }

    public function getPreuveDeCloture(): ?string
    {
        return $this->PreuveDeCloture;
    }

    public function setPreuveDeCloture(string $PreuveDeCloture): self
    {
        $this->PreuveDeCloture = $PreuveDeCloture;

        return $this;
    }

    public function getCritaireEfficacite(): ?string
    {
        return $this->CritaireEfficacite;
    }

    public function setCritaireEfficacite(string $CritaireEfficacite): self
    {
        $this->CritaireEfficacite = $CritaireEfficacite;

        return $this;
    }

    public function getEtatDeEfficacite(): ?string
    {
        return $this->EtatDeEfficacite;
    }

    public function setEtatDeEfficacite(string $EtatDeEfficacite): self
    {
        $this->EtatDeEfficacite = $EtatDeEfficacite;

        return $this;
    }

    public function getEtatActuel(): ?string
    {
        return $this->EtatActuel;
    }

    public function setEtatActuel(string $EtatActuel): self
    {
        $this->EtatActuel = $EtatActuel;

        return $this;
    }

    public function getExigencepi(): ?Exigencepi
    {
        return $this->Exigencepi;
    }

    public function setExigencepi(?Exigencepi $Exigencepi): self
    {
        $this->Exigencepi = $Exigencepi;

        return $this;
    }

    public function getRisque(): ?Risque
    {
        return $this->Risque;
    }

    public function setRisque(?Risque $Risque): self
    {
        $this->Risque = $Risque;

        return $this;
    }

    public function getOpportunite(): ?Opportunite
    {
        return $this->opportunite;
    }

    public function setOpportunite(?Opportunite $opportunite): self
    {
        $this->opportunite = $opportunite;

        return $this;
    }

    public function getOpportuniteReevalution(): ?Opportunite
    {
        return $this->opportuniteReevalution;
    }

    public function setOpportuniteReevalution(?Opportunite $opportuniteReevalution): self
    {
        $this->opportuniteReevalution = $opportuniteReevalution;

        return $this;
    }

    public function getHistoriqueRisque(): ?HistoriqueRisque
    {
        return $this->historiqueRisque;
    }

    public function setHistoriqueRisque(?HistoriqueRisque $historiqueRisque): self
    {
        $this->historiqueRisque = $historiqueRisque;

        return $this;
    }

    public function getHistoriqueOpportunite(): ?HistoriqueOpportunite
    {
        return $this->historiqueOpportunite;
    }

    public function setHistoriqueOpportunite(?HistoriqueOpportunite $historiqueOpportunite): self
    {
        $this->historiqueOpportunite = $historiqueOpportunite;

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->objective;
    }

    public function setObjective(?Objective $objective): self
    {
        $this->objective = $objective;

        return $this;
    }

}
