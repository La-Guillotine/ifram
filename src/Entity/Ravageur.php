<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RavageurRepository")
 */
class Ravageur extends Bioagresseur
{
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

}
