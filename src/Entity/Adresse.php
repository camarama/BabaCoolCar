<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 */
class Adresse
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
    private $lieudepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieudestination;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etape", mappedBy="adresse")
     */
    private $etapes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLieudepart(): ?string
    {
        return $this->lieudepart;
    }

    public function setLieudepart(string $lieudepart): self
    {
        $this->lieudepart = $lieudepart;

        return $this;
    }

    public function getLieudestination(): ?string
    {
        return $this->lieudestination;
    }

    public function setLieudestination(string $lieudestination): self
    {
        $this->lieudestination = $lieudestination;

        return $this;
    }

    /**
     * @return Collection|Etape[]
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setAdresse($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->etapes->contains($etape)) {
            $this->etapes->removeElement($etape);
            // set the owning side to null (unless already changed)
            if ($etape->getAdresse() === $this) {
                $etape->setAdresse(null);
            }
        }

        return $this;
    }
}
