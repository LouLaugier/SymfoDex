<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="build")
 * @ORM\Entity(repositoryClass="App\Repository\BuildRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Build
{
    const maxEV = 510;
    const maxIV = 31;

    public function __construct($dataArray = array()) {
        $this->date = new \Datetime();
        if(isset($dataArray['title'])) $this->title = $dataArray['title'];
        if(isset($dataArray['author'])) $this->author = $dataArray['author'];
        if(isset($dataArray['content'])) $this->content = $dataArray['content'];
        if(isset($dataArray['evPv'])) $this->evPv = $dataArray['evPv'];
        if(isset($dataArray['evAtk'])) $this->evAtk = $dataArray['evAtk'];
        if(isset($dataArray['evDef'])) $this->evDef = $dataArray['evDef'];
        if(isset($dataArray['evSpa'])) $this->evSpa = $dataArray['evSpa'];
        if(isset($dataArray['evSpd'])) $this->evSpd = $dataArray['evSpd'];
        if(isset($dataArray['evSpe'])) $this->evSpe = $dataArray['evSpe'];
        if(isset($dataArray['ivPv'])) $this->ivPv = $dataArray['ivPv'];
        if(isset($dataArray['ivAtk'])) $this->ivAtk = $dataArray['ivAtk'];
        if(isset($dataArray['ivDef'])) $this->ivDef = $dataArray['ivDef'];
        if(isset($dataArray['ivSpa'])) $this->ivSpa = $dataArray['ivSpa'];
        if(isset($dataArray['ivSpd'])) $this->ivSpd = $dataArray['ivSpd'];
        if(isset($dataArray['ivSpe'])) $this->ivSpe = $dataArray['ivSpe'];
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pokemon", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $pokemon;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nature", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $nature;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer",name="EV_PV", nullable=true)
     */
    private $evPv;

    /**
     * @ORM\Column(type="integer",name="EV_ATK", nullable=true)
     */
    private $evAtk;

    /**
     * @ORM\Column(type="integer",name="EV_DEF", nullable=true)
     */
    private $evDef;

    /**
     * @ORM\Column(type="integer",name="EV_SPA", nullable=true)
     */
    private $evSpa;

    /**
     * @ORM\Column(type="integer",name="EV_SPD", nullable=true)
     */
    private $evSpd;

    /**
     * @ORM\Column(type="integer",name="EV_SPE", nullable=true)
     */
    private $evSpe;

    /**
     * @ORM\Column(type="integer",name="IV_PV", nullable=true)
     */
    private $ivPv;

    /**
     * @ORM\Column(type="integer",name="IV_ATK", nullable=true)
     */
    private $ivAtk;

    /**
     * @ORM\Column(type="integer",name="IV_DEF", nullable=true)
     */
    private $ivDef;

    /**
     * @ORM\Column(type="integer",name="IV_SPA", nullable=true)
     */
    private $ivSpa;

    /**
     * @ORM\Column(type="integer",name="IV_SPD", nullable=true)
     */
    private $ivSpd;

    /**
     * @ORM\Column(type="integer",name="IV_SPE", nullable=true)
     */
    private $ivSpe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ability", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ability;

    /*
     * @ORM\ManyToMany(targetEntity="App\Entity\Move", cascade={"persist"})
     */
    //private $moves;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage(Image $image = null)
    {
        $this->image = $image;
    }

    public function getPokemon()
    {
        return $this->pokemon;
    }

    public function setPokemon(Pokemon $pokemon = null)
    {
        $this->pokemon = $pokemon;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getNature()
    {
        return $this->nature;
    }

    public function setNature(Nature $nature = null)
    {
        $this->nature = $nature;
    }

    public function getEvPv(): ?int
    {
        return $this->evPv;
    }

    public function setEvPv(int $evPv = 0): self
    {
        $this->evPv = $evPv;

        return $this;
    }

    public function getEvAtk(): ?int
    {
        return $this->evAtk;
    }

    public function setEvAtk(int $evAtk = 0): self
    {
        $this->evAtk = $evAtk;

        return $this;
    }

    public function getEvDef(): ?int
    {
        return $this->evDef;
    }

    public function setEvDef(int $evDef = 0): self
    {
        $this->evDef = $evDef;

        return $this;
    }

    public function getEvSpa(): ?int
    {
        return $this->evSpa;
    }

    public function setEvSpa(int $evSpa = 0): self
    {
        $this->evSpa = $evSpa;

        return $this;
    }

    public function getEvSpd(): ?int
    {
        return $this->evSpd;
    }

    public function setEvSpd(int $evSpd = 0): self
    {
        $this->evSpd = $evSpd;

        return $this;
    }

    public function getEvSpe(): ?int
    {
        return $this->evSpe;
    }

    public function setEvSpe(int $evSpe = 0): self
    {
        $this->evSpe = $evSpe;

        return $this;
    }

    public function getIvPv(): ?int
    {
        return $this->ivPv;
    }

    public function setIvPv(int $ivPv = 0): self
    {
        $this->ivPv = $ivPv;

        return $this;
    }

    public function getIvAtk(): ?int
    {
        return $this->ivAtk;
    }

    public function setIvAtk(int $ivAtk = 0): self
    {
        $this->ivAtk = $ivAtk;

        return $this;
    }

    public function getIvDef(): ?int
    {
        return $this->ivDef;
    }

    public function setIvDef(int $ivDef = 0): self
    {
        $this->ivDef = $ivDef;

        return $this;
    }

    public function getIvSpa(): ?int
    {
        return $this->ivSpa;
    }

    public function setIvSpa(int $ivSpa = 0): self
    {
        $this->ivSpa = $ivSpa;

        return $this;
    }

    public function getIvSpd(): ?int
    {
        return $this->ivSpd;
    }

    public function setIvSpd(int $ivSpd = 0): self
    {
        $this->ivSpd = $ivSpd;

        return $this;
    }

    public function getIvSpe(): ?int
    {
        return $this->ivSpe;
    }

    public function setIvSpe(int $ivSpe = 0): self
    {
        $this->ivSpe = $ivSpe;

        return $this;
    }

    public function getAbility()
    {
        return $this->ability;
    }

    public function setAbility(Ability $ability = null)
    {
        $this->ability = $ability;
    }

    /*public function getMoves()
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
    }*/

    /**
     * @ORM\PreUpdate
     */
    public function updateDate() {
        $this->setUpdatedAt(new \Datetime());
    }
}
