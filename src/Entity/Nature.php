<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="nature")
 * @ORM\Entity(repositoryClass="App\Repository\NatureRepository", readOnly=true)
 */
class Nature
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
     * @ORM\Column(type="float",name="atk_bonus")
     */
    private $AtkBonus;

    /**
     * @ORM\Column(type="float",name="def_bonus")
     */
    private $DefBonus;

    /**
     * @ORM\Column(type="float",name="spa_bonus")
     */
    private $SpABonus;

    /**
     * @ORM\Column(type="float",name="spd_bonus")
     */
    private $SpDBonus;

    /**
     * @ORM\Column(type="float",name="spe_bonus")
     */
    private $SpeBonus;

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

    public function getAtkBonus(): ?float
    {
        return $this->AtkBonus;
    }

    public function setAtkBonus(float $AtkBonus): self
    {
        $this->AtkBonus = $AtkBonus;

        return $this;
    }

    public function getDefBonus(): ?float
    {
        return $this->DefBonus;
    }

    public function setDefBonus(float $DefBonus): self
    {
        $this->DefBonus = $DefBonus;

        return $this;
    }

    public function getSpABonus(): ?float
    {
        return $this->SpABonus;
    }

    public function setSpABonus(float $SpABonus): self
    {
        $this->SpABonus = $SpABonus;

        return $this;
    }

    public function getSpDBonus(): ?float
    {
        return $this->SpDBonus;
    }

    public function setSpDBonus(float $SpDBonus): self
    {
        $this->SpDBonus = $SpDBonus;

        return $this;
    }

    public function getSpeBonus(): ?float
    {
        return $this->SpeBonus;
    }

    public function setSpeBonus(float $SpeBonus): self
    {
        $this->SpeBonus = $SpeBonus;

        return $this;
    }
}
