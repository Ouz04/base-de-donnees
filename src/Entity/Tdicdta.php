<?php

namespace App\Entity;

use App\Repository\TdicdtaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TdicdtaRepository::class)
 */
class Tdicdta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $tabnam;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $chpnam;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $typ;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $lng;

    /**
     * @ORM\Column(type="date")
     */
    private $datIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="integer")
     */
    private $rng;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $ctq;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $dsg;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTabnam(): ?string
    {
        return $this->tabnam;
    }

    public function setTabnam(string $tabnam): self
    {
        $this->tabnam = $tabnam;

        return $this;
    }

    public function getChpnam(): ?string
    {
        return $this->chpnam;
    }

    public function setChpnam(string $chpnam): self
    {
        $this->chpnam = $chpnam;

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

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(?string $lng): self
    {
        $this->lng = $lng;

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

    public function getUsrIns(): ?Tuser
    {
        return $this->usrIns;
    }

    public function setUsrIns(?Tuser $usrIns): self
    {
        $this->usrIns = $usrIns;

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

    public function getUsrUpd(): ?Tuser
    {
        return $this->usrUpd;
    }

    public function setUsrUpd(?Tuser $usrUpd): self
    {
        $this->usrUpd = $usrUpd;

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

    public function getCtq(): ?string
    {
        return $this->ctq;
    }

    public function setCtq(?string $ctq): self
    {
        $this->ctq = $ctq;

        return $this;
    }

    public function getDsg(): ?string
    {
        return $this->dsg;
    }

    public function setDsg(?string $dsg): self
    {
        $this->dsg = $dsg;

        return $this;
    }
}
