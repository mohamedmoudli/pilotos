<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RisqueRepository")
 */
class Risque
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
     * @ORM\Column(type="string", length=255)
     */
    private $Causes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Censequence;

    /**
     * @ORM\Column(type="integer")
     */
    private $Gravite;

    /**
     * @ORM\Column(type="integer")
     */
    private $Probabilite;

    /**
     * @ORM\Column(type="integer")
     */
    private $detectabilite;

    /**
     * @ORM\Column(type="integer")
     */
    private $Criticite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Decision;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CourtTerm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MoyenTerm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LongTerm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DateIdentification;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatRisque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Commentaire;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Processus", inversedBy="risques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Processus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieRisque", inversedBy="risques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategorieRisque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StrategiqueRisque", inversedBy="risques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StrategiqueRisque;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanDeAction", mappedBy="Risque")
     */
    private $planDeActions;

    public function __construct()
    {
        $this->planDeActions = new ArrayCollection();
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

    public function getCauses(): ?string
    {
        return $this->Causes;
    }

    public function setCauses(string $Causes): self
    {
        $this->Causes = $Causes;

        return $this;
    }

    public function getCensequence(): ?string
    {
        return $this->Censequence;
    }

    public function setCensequence(string $Censequence): self
    {
        $this->Censequence = $Censequence;

        return $this;
    }

    public function getGravite(): ?int
    {
        return $this->Gravite;
    }

    public function setGravite(int $Gravite): self
    {
        $this->Gravite = $Gravite;

        return $this;
    }

    public function getProbabilite(): ?int
    {
        return $this->Probabilite;
    }

    public function setProbabilite(int $Probabilite): self
    {
        $this->Probabilite = $Probabilite;

        return $this;
    }

    public function getDetectabilite(): ?int
    {
        return $this->detectabilite;
    }

    public function setDetectabilite(int $detectabilite): self
    {
        $this->detectabilite = $detectabilite;

        return $this;
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

    public function getCourtTerm(): ?string
    {
        return $this->CourtTerm;
    }

    public function setCourtTerm(?string $CourtTerm): self
    {
        $this->CourtTerm = $CourtTerm;

        return $this;
    }

    public function getMoyenTerm(): ?string
    {
        return $this->MoyenTerm;
    }

    public function setMoyenTerm(?string $MoyenTerm): self
    {
        $this->MoyenTerm = $MoyenTerm;

        return $this;
    }

    public function getLongTerm(): ?string
    {
        return $this->LongTerm;
    }

    public function setLongTerm(?string $LongTerm): self
    {
        $this->LongTerm = $LongTerm;

        return $this;
    }

    public function getDateIdentification(): ?string
    {
        return $this->DateIdentification;
    }

    public function setDateIdentification(string $DateIdentification): self
    {
        $this->DateIdentification = $DateIdentification;

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

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(string $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }


    public function getProcessus(): ?Processus
    {
        return $this->Processus;
    }

    public function setProcessus(?Processus $Processus): self
    {
        $this->Processus = $Processus;

        return $this;
    }

    public function getCategorieRisque(): ?CategorieRisque
    {
        return $this->CategorieRisque;
    }

    public function setCategorieRisque(?CategorieRisque $CategorieRisque): self
    {
        $this->CategorieRisque = $CategorieRisque;

        return $this;
    }

    public function getStrategiqueRisque(): ?StrategiqueRisque
    {
        return $this->StrategiqueRisque;
    }

    public function setStrategiqueRisque(?StrategiqueRisque $StrategiqueRisque): self
    {
        $this->StrategiqueRisque = $StrategiqueRisque;

        return $this;
    }

    /**
     * @return Collection|PlanDeAction[]
     */
    public function getPlanDeActions(): Collection
    {
        return $this->planDeActions;
    }

    public function addPlanDeAction(PlanDeAction $planDeAction): self
    {
        if (!$this->planDeActions->contains($planDeAction)) {
            $this->planDeActions[] = $planDeAction;
            $planDeAction->setRisque($this);
        }

        return $this;
    }

    public function removePlanDeAction(PlanDeAction $planDeAction): self
    {
        if ($this->planDeActions->contains($planDeAction)) {
            $this->planDeActions->removeElement($planDeAction);
            // set the owning side to null (unless already changed)
            if ($planDeAction->getRisque() === $this) {
                $planDeAction->setRisque(null);
            }
        }

        return $this;
    }
}
