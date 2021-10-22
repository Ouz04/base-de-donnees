<?php

namespace App\Entity;

use App\Repository\TcotcliRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TcotcliRepository::class)
 */
class Tcotcli
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tcotation::class, inversedBy="tcotclis")
     */
    private $clrCot;

    /**
     * @ORM\ManyToOne(targetEntity=Tclient::class, inversedBy="tcotclis")
     */
    private $clrCli;

    /**
     * @ORM\Column(type="date")
     */
    private $datDeb;

    /**
     * @ORM\Column(type="date")
     */
    private $datFin;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=false)
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

    public function getClrCot(): ?Tcotation
    {
        return $this->clrCot;
    }

    public function setClrCot(?Tcotation $clrCot): self
    {
        $this->clrCot = $clrCot;

        return $this;
    }

    public function getClrCli(): ?Tclient
    {
        return $this->clrCli;
    }

    public function setClrCli(?Tclient $clrCli): self
    {
        $this->clrCli = $clrCli;

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

    public function setDatFin(\DateTimeInterface $datFin): self
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
