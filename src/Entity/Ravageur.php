<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RavageurRepository")
 */
class Ravageur extends Bioagresseur
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\bioagresseur", inversedBy="ravageurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bioagresseur;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $stadeactif;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbgenerations;


    public function getStadeactif(): ?string
    {
        return $this->stadeactif;
    }

    public function setStadeactif(string $stadeactif): self
    {
        $this->stadeactif = $stadeactif;

        return $this;
    }

    public function getNbgenerations(): ?int
    {
        return $this->nbgenerations;
    }

    public function setNbgenerations(int $nbgenerations): self
    {
        $this->nbgenerations = $nbgenerations;

        return $this;
    }

    public function getBioagresseur(): ?bioagresseur
    {
        return $this->bioagresseur;
    }

    public function setBioagresseur(?bioagresseur $bioagresseur): self
    {
        $this->bioagresseur = $bioagresseur;

        return $this;
    }
}
