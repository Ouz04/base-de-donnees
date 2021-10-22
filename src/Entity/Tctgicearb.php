<?php

namespace App\Entity;

use App\Repository\TctgicearbRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TctgicearbRepository::class)
 */
class Tctgicearb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idIce;

    /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class)
     */
    private $clrNiv1;

    /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class)
     */
    private $clrNiv2;

    /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class)
     */
    private $clrNiv3;

    /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class)
     */
    private $clrNiv4;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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

    /**
     * @ORM\Column(type="integer")
     */
    private $qteArt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdIce(): ?int
    {
        return $this->idIce;
    }

    public function setIdIce(int $idIce): self
    {
        $this->idIce = $idIce;

        return $this;
    }

    public function getClrNiv1(): ?Tctgiceniv
    {
        return $this->clrNiv1;
    }

    public function setClrNiv1(?Tctgiceniv $clrNiv1): self
    {
        $this->clrNiv1 = $clrNiv1;

        return $this;
    }

    public function getClrNiv2(): ?Tctgiceniv
    {
        return $this->clrNiv2;
    }

    public function setClrNiv2(?Tctgiceniv $clrNiv2): self
    {
        $this->clrNiv2 = $clrNiv2;

        return $this;
    }

    public function getClrNiv3(): ?Tctgiceniv
    {
        return $this->clrNiv3;
    }

    public function setClrNiv3(?Tctgiceniv $clrNiv3): self
    {
        $this->clrNiv3 = $clrNiv3;

        return $this;
    }

    public function getClrNiv4(): ?Tctgiceniv
    {
        return $this->clrNiv4;
    }

    public function setClrNiv4(?Tctgiceniv $clrNiv4): self
    {
        $this->clrNiv4 = $clrNiv4;

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

    public function setDatIns(?\DateTimeInterface $datIns): self
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

    public function getQteArt(): ?int
    {
        return $this->qteArt;
    }

    public function setQteArt(int $qteArt): self
    {
        $this->qteArt = $qteArt;

        return $this;
    }
}
