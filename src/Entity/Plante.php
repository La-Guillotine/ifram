<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanteRepository")
 */
class Plante
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\bioagresseur", inversedBy="plantes_sensibles")
     */
    private $sensible;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Observation", mappedBy="plante", orphanRemoval=true)
     */
    private $observations;

    public function __construct()
    {
        $this->sensible = new ArrayCollection();
        $this->observations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection|bioagresseur[]
     */
    public function getSensible(): Collection
    {
        return $this->sensible;
    }

    public function addSensible(bioagresseur $sensible): self
    {
        if (!$this->sensible->contains($sensible)) {
            $this->sensible[] = $sensible;
        }

        return $this;
    }

    public function removeSensible(bioagresseur $sensible): self
    {
        if ($this->sensible->contains($sensible)) {
            $this->sensible->removeElement($sensible);
        }

        return $this;
    }

    /**
     * @return Collection|Observation[]
     */
    public function getObservations(): Collection
    {
        return $this->observations;
    }

    public function addObservation(Observation $observation): self
    {
        if (!$this->observations->contains($observation)) {
            $this->observations[] = $observation;
            $observation->setPlante($this);
        }

        return $this;
    }

    public function removeObservation(Observation $observation): self
    {
        if ($this->observations->contains($observation)) {
            $this->observations->removeElement($observation);
            // set the owning side to null (unless already changed)
            if ($observation->getPlante() === $this) {
                $observation->setPlante(null);
            }
        }

        return $this;
    }
}
