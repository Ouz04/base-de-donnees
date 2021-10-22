<?php

namespace App\Entity;

use App\Repository\TflxpstRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TflxpstRepository::class)
 */
class Tflxpst
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tflxett::class)
     */
    private $clrFlx;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $chp;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $dsg;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $typ;

    /**
     * @ORM\Column(type="integer")
     */
    private $lng;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $frm;

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

    public function getClrFlx(): ?Tflxett
    {
        return $this->clrFlx;
    }

    public function setClrFlx(?Tflxett $clrFlx): self
    {
        $this->clrFlx = $clrFlx;

        return $this;
    }

    public function getChp(): ?string
    {
        return $this->chp;
    }

    public function setChp(string $chp): self
    {
        $this->chp = $chp;

        return $this;
    }

    public function getDsg(): ?string
    {
        return $this->dsg;
    }

    public function setDsg(string $dsg): self
    {
        $this->dsg = $dsg;

        return $this;
    }

    public function getTyp(): ?string
    {
        return $this->typ;
    }

    public function setTyp(string $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

    public function getLng(): ?int
    {
        return $this->lng;
    }

    public function setLng(int $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getFrm(): ?string
    {
        return $this->frm;
    }

    public function setFrm(?string $frm): self
    {
        $this->frm = $frm;

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
