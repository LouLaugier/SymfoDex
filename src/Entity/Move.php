<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="move")
 * @ORM\Entity(repositoryClass="App\Repository\MoveRepository", readOnly=true)
 */
class Move
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AtkType", cascade={"persist"})
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $basePower;

    /**
     * @ORM\Column(type="integer")
     */
    private $precision;

    /**
     * @ORM\Column(type="integer", name="PP")
     */
    private $PP;
    
    /**
    * @ORM\Column(type="integer")
    */
   private $classe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $effect;

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

    public function getTypeId()
    {
        return $this->type;
    }

    public function setTypeId(AtkType $type)
    {
        $this->type = $type;

        return $this;
    }

    public function getBasePower(): ?int
    {
        return $this->basePower;
    }

    public function setBasePower(int $basePower): self
    {
        $this->basePower = $basePower;

        return $this;
    }

    public function getPrecision(): ?int
    {
        return $this->precision;
    }

    public function setPrecision(int $precision): self
    {
        $this->precision = $precision;

        return $this;
    }

    public function getPP(): ?int
    {
        return $this->PP;
    }

    public function setPP(int $PP): self
    {
        $this->PP = $PP;

        return $this;
    }

    public function getClasse(): ?int
    {
        return $this->classe;
    }

    public function setClasse(int $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }
}
