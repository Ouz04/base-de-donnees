<?php

namespace App\Entity;

use App\Repository\TarttrfsitwebRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TarttrfsitwebRepository::class)
 */
class Tarttrfsitweb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="tarttrfsitwebs")
     */
    private $clrArt;

    /**
     * @ORM\ManyToOne(targetEntity=Tsitweb::class, inversedBy="tarttrfsitwebs")
     */
    private $clrSitweb;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xTrf;

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

    public function getClrSitweb(): ?Tsitweb
    {
        return $this->clrSitweb;
    }

    public function setClrSitweb(?Tsitweb $clrSitweb): self
    {
        $this->clrSitweb = $clrSitweb;

        return $this;
    }

    public function getXTrf(): ?bool
    {
        return $this->xTrf;
    }

    public function setXTrf(bool $xTrf): self
    {
        $this->xTrf = $xTrf;

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
