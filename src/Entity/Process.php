<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProcessRepository")
 */
class Process
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
    private $Process;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PerformanceIndicator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pilot;

    /**
     * @ORM\OneToMany(targetEntity="ActionPlan", mappedBy="ProcessLie")
     */
    private $objectives ;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActionPlan", mappedBy="Process")
     */
    private $actionPlans;

    public function __construct()
    {

        $this->objectives = new ArrayCollection();
        $this->actionPlans = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProcess(): ?string
    {
        return $this->Process;
    }

    public function setProcess(string $Process): self
    {
        $this->Process = $Process;

        return $this;
    }

    public function getPerformanceIndicator(): ?string
    {
        return $this->PerformanceIndicator;
    }

    public function setPerformanceIndicator(string $PerformanceIndicator): self
    {
        $this->PerformanceIndicator = $PerformanceIndicator;

        return $this;
    }

    public function getPilot(): ?string
    {
        return $this->Pilot;
    }

    public function setPilot(string $Pilot): self
    {
        $this->Pilot = $Pilot;

        return $this;
    }

}
