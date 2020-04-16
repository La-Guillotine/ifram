<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaladieRepository")
 */
class Maladie extends Bioagresseur
{

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $conditionsfavorables;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\bioagresseur", inversedBy="maladies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bioagresseur;

    public function getConditionsfavorables(): ?string
    {
        return $this->conditionsfavorables;
    }

    public function setConditionsfavorables(string $conditionsfavorables): self
    {
        $this->conditionsfavorables = $conditionsfavorables;

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
