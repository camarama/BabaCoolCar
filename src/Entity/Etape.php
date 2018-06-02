<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapeRepository")
 */
class Etape
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nometape;

    /**
     * @ORM\Column(type="time")
     */
    private $heureetape;

    /**
     * @ORM\Column(type="float")
     */
    private $prixetape;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="etapes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trajet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="etapes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adresse;

    public function getId()
    {
        return $this->id;
    }

    public function getNometape(): ?string
    {
        return $this->nometape;
    }

    public function setNometape(?string $nometape): self
    {
        $this->nometape = $nometape;

        return $this;
    }

    public function getHeureetape(): ?\DateTimeInterface
    {
        return $this->heureetape;
    }

    public function setHeureetape(\DateTimeInterface $heureetape): self
    {
        $this->heureetape = $heureetape;

        return $this;
    }

    public function getPrixetape(): ?float
    {
        return $this->prixetape;
    }

    public function setPrixetape(float $prixetape): self
    {
        $this->prixetape = $prixetape;

        return $this;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->trajet;
    }

    public function setTrajet(?Trajet $trajet): self
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
