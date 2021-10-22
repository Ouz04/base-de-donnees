<?php

namespace App\Entity;

use App\Repository\TficstrpstRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TficstrpstRepository::class)
 */
class Tficstrpst
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tficstrett::class)
     */
    private $clrFicstr;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $chp;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dsg;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $typ;

    /**
     * @ORM\Column(type="integer", nullable=true)
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

    /**
     * @ORM\Column(type="integer")
     */
    private $rng;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClrFicstr(): ?Tficstrett
    {
        return $this->clrFicstr;
    }

    public function setClrFicstr(?Tficstrett $clrFicstr): self
    {
        $this->clrFicstr = $clrFicstr;

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

    public function setTyp(?string $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

    public function getLng(): ?int
    {
        return $this->lng;
    }

    public function setLng(?int $lng): self
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

    public function getRng(): ?int
    {
        return $this->rng;
    }

    public function setRng(int $rng): self
    {
        $this->rng = $rng;

        return $this;
    }

    public function getPos(): ?int
    {
        return $this->pos;
    }

    public function setPos(?int $pos): self
    {
        $this->pos = $pos;

        return $this;
    }
}
