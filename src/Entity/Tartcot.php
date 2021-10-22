<?php

namespace App\Entity;

use App\Repository\TartcotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TartcotRepository::class)
 */
class Tartcot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="tartcots")
     */
    private $clrArt;

    /**
     * @ORM\ManyToOne(targetEntity=Tcotation::class, inversedBy="tartcots")
     */
    private $clrCot;

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
     * @ORM\JoinColumn(nullable=true)
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\Column(type="float")
     */
    private $prx;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $dev;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteCnd;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteArt;

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

    public function getClrCot(): ?Tcotation
    {
        return $this->clrCot;
    }

    public function setClrCot(?Tcotation $clrCot): self
    {
        $this->clrCot = $clrCot;

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

    public function getPrx(): ?float
    {
        return $this->prx;
    }

    public function setPrx(float $prx): self
    {
        $this->prx = $prx;

        return $this;
    }

    public function getDev(): ?string
    {
        return $this->dev;
    }

    public function setDev(string $dev): self
    {
        $this->dev = $dev;

        return $this;
    }

    public function getQteCnd(): ?int
    {
        return $this->qteCnd;
    }

    public function setQteCnd(int $qteCnd): self
    {
        $this->qteCnd = $qteCnd;

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
