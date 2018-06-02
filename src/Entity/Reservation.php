<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateresa;

    /**
     * @ORM\Column(type="boolean")
     */
    private $annuleresa;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valideresa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trajet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    public function getId()
    {
        return $this->id;
    }

    public function getDateresa(): ?\DateTimeInterface
    {
        return $this->dateresa;
    }

    public function setDateresa(\DateTimeInterface $dateresa): self
    {
        $this->dateresa = $dateresa;

        return $this;
    }

    public function getAnnuleresa(): ?bool
    {
        return $this->annuleresa;
    }

    public function setAnnuleresa(bool $annuleresa): self
    {
        $this->annuleresa = $annuleresa;

        return $this;
    }

    public function getValideresa(): ?bool
    {
        return $this->valideresa;
    }

    public function setValideresa(bool $valideresa): self
    {
        $this->valideresa = $valideresa;

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

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }
}
