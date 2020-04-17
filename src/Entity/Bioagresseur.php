<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MappedSuperClass
 * @ORM\Entity(repositoryClass="App\Repository\BioagresseurRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="categorie", type="string")
 * @ORM\DiscriminatorMap({"maladie" = "Maladie", "ravageur" = "Ravageur"})
 */
abstract class Bioagresseur
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
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $periodesrisques;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $symptomes;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $stadesensible;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plante", mappedBy="sensible")
     */
    private $plantes_sensibles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Organe", mappedBy="bioagresseurs")
     */
    private $organes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Traitement", mappedBy="bioagresseurs")
     */
    private $traitements;

    public function __construct()
    {
        $this->plantes_sensibles = new ArrayCollection();
        $this->organes = new ArrayCollection();
        $this->traitements = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPeriodesrisques(): ?string
    {
        return $this->periodesrisques;
    }

    public function setPeriodesrisques(?string $periodesrisques): self
    {
        $this->periodesrisques = $periodesrisques;

        return $this;
    }

    public function getSymptomes(): ?string
    {
        return $this->symptomes;
    }

    public function setSymptomes(?string $symptomes): self
    {
        $this->symptomes = $symptomes;

        return $this;
    }

    public function getStadesensible(): ?string
    {
        return $this->stadesensible;
    }

    public function setStadesensible(?string $stadesensible): self
    {
        $this->stadesensible = $stadesensible;

        return $this;
    }   

    /**
     * @return Collection|Plante[]
     */
    public function getPlantesSensibles(): Collection
    {
        return $this->plantes_sensibles;
    }

    public function addPlantesSensible(Plante $plantesSensible): self
    {
        if (!$this->plantes_sensibles->contains($plantesSensible)) {
            $this->plantes_sensibles[] = $plantesSensible;
            $plantesSensible->addSensible($this);
        }

        return $this;
    }

    public function removePlantesSensible(Plante $plantesSensible): self
    {
        if ($this->plantes_sensibles->contains($plantesSensible)) {
            $this->plantes_sensibles->removeElement($plantesSensible);
            $plantesSensible->removeSensible($this);
        }

        return $this;
    }

    /**
     * @return Collection|Organe[]
     */
    public function getOrganes(): Collection
    {
        return $this->organes;
    }

    public function addOrgane(Organe $organe): self
    {
        if (!$this->organes->contains($organe)) {
            $this->organes[] = $organe;
            $organe->addBioagresseur($this);
        }

        return $this;
    }

    public function removeOrgane(Organe $organe): self
    {
        if ($this->organes->contains($organe)) {
            $this->organes->removeElement($organe);
            $organe->removeBioagresseur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Traitement[]
     */
    public function getTraitements(): Collection
    {
        return $this->traitements;
    }

    public function addTraitement(Traitement $traitement): self
    {
        if (!$this->traitements->contains($traitement)) {
            $this->traitements[] = $traitement;
            $traitement->addBioagresseur($this);
        }

        return $this;
    }

    public function removeTraitement(Traitement $traitement): self
    {
        if ($this->traitements->contains($traitement)) {
            $this->traitements->removeElement($traitement);
            $traitement->removeBioagresseur($this);
        }

        return $this;
    }
}
