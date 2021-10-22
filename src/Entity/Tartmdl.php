<?php

namespace App\Entity;

use App\Repository\TartMdlimpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TartMdlimpRepository::class)
 */
class Tartmdl
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class)
     */
    private $clrArt;

    /**
     * @ORM\ManyToOne(targetEntity=Tmodele::class)
     */
    private $clrMdl;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClrArt(): ?Tarticle
    {
        return $this->clrArt;
    }

    public function setClrArt(?Tarticle $clrArt): self
    {
        $this->clrArt = $clrArt;

        return $this;
    }

    public function getClrMdl(): ?Tmodele
    {
        return $this->clrMdl;
    }

    public function setClrMdlimp(?Tmodele $clrMdl): self
    {
        $this->clrMdl = $clrMdl;

        return $this;
    }

    public function getUsrIns(): ?Tuser
    {
        return $this->usrIns;
    }

    public function setUsrIns(?Tuser $usrIns): self
    {
        $this->usrIns = $usrIns;

        return $this;
    }

    public function getDatIns(): ?\DateTimeInterface
    {
        return $this->datIns;
    }

    public function setDatIns(\DateTimeInterface $datIns): self
    {
        $this->datIns = $datIns;

        return $this;
    }

    public function getUsrUpd(): ?Tuser
    {
        return $this->usrUpd;
    }

    public function setUsrUpd(?Tuser $usrUpd): self
    {
        $this->usrUpd = $usrUpd;

        return $this;
    }

    public function getDatUpd(): ?\DateTimeInterface
    {
        return $this->datUpd;
    }

    public function setDatUpd(?\DateTimeInterface $datUpd): self
    {
        $this->datUpd = $datUpd;

        return $this;
    }
}
