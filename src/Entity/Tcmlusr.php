<?php

namespace App\Entity;

use App\Repository\TcmlusrRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TcmlusrRepository::class)
 */
class Tcmlusr
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tcommercial::class, inversedBy="tcmlusrs")
     */
    private $clrCml;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class, inversedBy="tcmlusrs")
     */
    private $clrUsr;

    /**
     * @ORM\Column(type="date")
     */
    private $datDeb;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datFin;

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

    public function getClrCml(): ?Tcommercial
    {
        return $this->clrCml;
    }

    public function setClrCml(?Tcommercial $clrCml): self
    {
        $this->clrCml = $clrCml;

        return $this;
    }

    public function getClrUsr(): ?Tuser
    {
        return $this->clrUsr;
    }

    public function setClrUsr(?Tuser $clrUsr): self
    {
        $this->clrUsr = $clrUsr;

        return $this;
    }

    public function getDatDeb(): ?\DateTimeInterface
    {
        return $this->datDeb;
    }

    public function setDatDeb(\DateTimeInterface $datDeb): self
    {
        $this->datDeb = $datDeb;

        return $this;
    }

    public function getDatFin(): ?\DateTimeInterface
    {
        return $this->datFin;
    }

    public function setDatFin(?\DateTimeInterface $datFin): self
    {
        $this->datFin = $datFin;

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
