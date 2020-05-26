<?php

namespace App\Entity;

use Doctrine\Common\Annotations;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AtkTypeRepository")
 */
class AtkType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PkmType", cascade={"persist"})
     * @ORM\JoinTable(name="effective_against")
     */
    private $effectiveAgainst;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PkmType", cascade={"persist"})
     * @ORM\JoinTable(name="weak_against")
     */
    private $weakAgainst;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEffectiveAgainsts()
    {
        return $this->effectiveAgainst;
    }
    
    public function addEffectiveAgainst(PkmType $effectiveAgainst)
    {
        $this->effectiveAgainsts[] = $effectiveAgainst;
    }

    public function removeEffectiveAgainst(PkmType $effectiveAgainst)
    {
        $this->effectiveAgainsts->removeElement($effectiveAgainst);
    }

    public function getWeakAgainsts()
    {
        return $this->weakAgainst;
    }
    
    public function addWeakAgainst(PkmType $weakAgainst)
    {
        $this->weakAgainsts[] = $weakAgainst;
    }

    public function removeWeakAgainst(PkmType $weakAgainst)
    {
        $this->weakAgainsts->removeElement($weakAgainst);
    }
}
