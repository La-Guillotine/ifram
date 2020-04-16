<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganeRepository")
 */
class Organe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\bioagresseur", inversedBy="organes")
     */
    private $bioagresseurs;

    public function __construct()
    {
        $this->bioagresseurs = new ArrayCollection();
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

    /**
     * @return Collection|bioagresseur[]
     */
    public function getBioagresseurs(): Collection
    {
        return $this->bioagresseurs;
    }

    public function addBioagresseur(bioagresseur $bioagresseur): self
    {
        if (!$this->bioagresseurs->contains($bioagresseur)) {
            $this->bioagresseurs[] = $bioagresseur;
        }

        return $this;
    }

    public function removeBioagresseur(bioagresseur $bioagresseur): self
    {
        if ($this->bioagresseurs->contains($bioagresseur)) {
            $this->bioagresseurs->removeElement($bioagresseur);
        }

        return $this;
    }
}
