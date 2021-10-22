<?php

namespace App\Entity;

use App\Repository\TartcpdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TartcpdRepository::class)
 */
class Tartcpd
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="tartcpds")
     */
    private $clrArtaas;

    /**
     * @ORM\ManyToOne(targetEntity=Ttypcpd::class)
     */
    private $clrTypcpd;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class)
     */
    private $clrArtase;

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

    public function getClrArtaas(): ?Tarticle
    {
        return $this->clrArtaas;
    }

    public function setClrArtaas(?Tarticle $clrArtaas): self
    {
        $this->clrArtaas = $clrArtaas;

        return $this;
    }

    public function getClrTypcpd(): ?Ttypcpd
    {
        return $this->clrTypcpd;
    }

    public function setClrTypcpd(?Ttypcpd $clrTypcpd): self
    {
        $this->clrTypcpd = $clrTypcpd;

        return $this;
    }

    public function getClrArtase(): ?Tarticle
    {
        return $this->clrArtase;
    }

    public function setClrArtase(?Tarticle $clrArtase): self
    {
        $this->clrArtase = $clrArtase;

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
