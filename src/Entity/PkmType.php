<?php

namespace App\Entity;

use Doctrine\Common\Annotations;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PkmTypeRepository")
 */
class PkmType
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
     * @ORM\Column(type="string", length=255)
     */
    private $attribute;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AtkType", cascade={"persist"})
     * @ORM\JoinTable(name="resist")
     */
    private $resist;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AtkType", cascade={"persist"})
     * @ORM\JoinTable(name="weak")
     */
    private $weak;

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

    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getResists()
    {
        return $this->resist;
    }
    
    public function addResist(AtkType $resist)
    {
        $this->resists[] = $resist;
    }

    public function removeResist(AtkType $resist)
    {
        $this->resists->removeElement($resist);
    }

    public function getWeaks()
    {
        return $this->weak;
    }
    
    public function addWeak(AtkType $weak)
    {
        $this->weaks[] = $weak;
    }

    public function removeWeak(AtkType $weak)
    {
        $this->weaks->removeElement($weak);
    }
}
