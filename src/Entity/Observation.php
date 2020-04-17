<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\plante", inversedBy="observations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plante;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $coordonnees;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="observations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\bioagresseur", inversedBy="observations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bioagresseurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlante(): ?plante
    {
        return $this->plante;
    }

    public function setPlante(?plante $plante): self
    {
        $this->plante = $plante;

        return $this;
    }

    public function getCoordonnees(): ?string
    {
        return $this->coordonnees;
    }

    public function setCoordonnees(?string $coordonnees): self
    {
        $this->coordonnees = $coordonnees;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBioagresseurs(): ?bioagresseur
    {
        return $this->bioagresseurs;
    }

    public function setBioagresseurs(?bioagresseur $bioagresseurs): self
    {
        $this->bioagresseurs = $bioagresseurs;

        return $this;
    }
}
