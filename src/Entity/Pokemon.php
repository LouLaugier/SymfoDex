<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pokemon")
 * @ORM\Entity(repositoryClass="App\Repository\PokemonRepository")
 */
class Pokemon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PkmType", cascade={"persist"})
     */
    private $types;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ability", cascade={"persist"})
     */
    private $abilities;

    /**
     * @ORM\Column(type="integer",name="base_stat_pv")
     */
    private $baseStat_Pv;

    /**
     * @ORM\Column(type="integer",name="base_stat_atk")
     */
    private $baseStat_Atk;

    /**
     * @ORM\Column(type="integer",name="base_stat_def")
     */
    private $baseStat_Def;

    /**
     * @ORM\Column(type="integer",name="base_stat_spa")
     */
    private $baseStat_SpA;

    /**
     * @ORM\Column(type="integer",name="base_stat_spd")
     */
    private $baseStat_SpD;

    /**
     * @ORM\Column(type="integer",name="base_stat_spe")
     */
    private $baseStat_Spe;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Move", cascade={"persist"})
     */
    private $moves;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
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

    public function getTypes()
    {
        return $this->types;
    }
    
    public function addType(PkmType $type)
    {
        $this->types[] = $type;
    }

    public function removeType(PkmType $type)
    {
        $this->types->removeElement($type);
    }

    public function getAbilities()
    {
        return $this->abilities;
    }

    public function addAbility(Ability $ability)
    {
        $this->abilities[] = $ability;
    }

    public function removeAbility(Ability $ability)
    {
        $this->abilities->removeElement($ability);
    }

    public function getBaseStatPv(): ?int
    {
        return $this->baseStat_Pv;
    }

    public function setBaseStatPv(int $baseStat_Pv): self
    {
        $this->baseStat_Pv = $baseStat_Pv;

        return $this;
    }

    public function getBaseStatAtk(): ?int
    {
        return $this->baseStat_Atk;
    }

    public function setBaseStatAtk(int $baseStat_Atk): self
    {
        $this->baseStat_Atk = $baseStat_Atk;

        return $this;
    }

    public function getBaseStatDef(): ?int
    {
        return $this->baseStat_Def;
    }

    public function setBaseStatDef(int $baseStat_Def): self
    {
        $this->baseStat_Def = $baseStat_Def;

        return $this;
    }

    public function getBaseStatSpA(): ?int
    {
        return $this->baseStat_SpA;
    }

    public function setBaseStatSpA(int $baseStat_SpA): self
    {
        $this->baseStat_SpA = $baseStat_SpA;

        return $this;
    }

    public function getBaseStatSpD(): ?int
    {
        return $this->baseStat_SpD;
    }

    public function setBaseStatSpD(int $baseStat_SpD): self
    {
        $this->baseStat_SpD = $baseStat_SpD;

        return $this;
    }

    public function getBaseStatSpe(): ?int
    {
        return $this->baseStat_Spe;
    }

    public function setBaseStatSpe(int $baseStat_Spe): self
    {
        $this->baseStat_Spe = $baseStat_Spe;

        return $this;
    }

    public function getMoves()
    {
        return $this->moves;
    }
    
    public function addMove(Move $move)
    {
        $this->moves[] = $move;
    }

    public function removeMove(Move $move)
    {
        $this->moves->removeElement($move);
    }
}
