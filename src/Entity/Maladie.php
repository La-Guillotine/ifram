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

    public function getConditionsfavorables(): ?string
    {
        return $this->conditionsfavorables;
    }

    public function setConditionsfavorables(string $conditionsfavorables): self
    {
        $this->conditionsfavorables = $conditionsfavorables;

        return $this;
    }

}
