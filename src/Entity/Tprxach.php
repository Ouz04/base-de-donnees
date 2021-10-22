<?php

namespace App\Entity;

use App\Repository\TprxachRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TprxachRepository::class)
 */
class Tprxach
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="tprxaches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clpArt;

    /**
     * @ORM\ManyToOne(targetEntity=Tfournisseur::class, inversedBy="tprxaches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clpFou;

    /**
     * @ORM\Column(type="integer")
     */
    private $clpCndt;

    /**
     * @ORM\Column(type="date")
     */
    private $clpDat;

    /**
     * @ORM\Column(type="float")
     */
    private $pht;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pec;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pso;

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

    public function getClpArt(): ?Tarticle
    {
        return $this->clpArt;
    }

    public function setClpArt(?Tarticle $clpArt): self
    {
        $this->clpArt = $clpArt;

        return $this;
    }

    public function getClpFou(): ?Tfournisseur
    {
        return $this->clpFou;
    }

    public function setClpFou(?Tfournisseur $clpFou): self
    {
        $this->clpFou = $clpFou;

        return $this;
    }

    public function getClpCndt(): ?int
    {
        return $this->clpCndt;
    }

    public function setClpCndt(int $clpCndt): self
    {
        $this->clpCndt = $clpCndt;

        return $this;
    }

    public function getClrDat(): ?\DateTimeInterface
    {
        return $this->clrDat;
    }

    public function setClrDat(\DateTimeInterface $clrDat): self
    {
        $this->clrDat = $clrDat;

        return $this;
    }

    public function getPht(): ?float
    {
        return $this->pht;
    }

    public function setPht(float $pht): self
    {
        $this->pht = $pht;

        return $this;
    }

    public function getPec(): ?float
    {
        return $this->pec;
    }

    public function setPec(?float $pec): self
    {
        $this->pec = $pec;

        return $this;
    }

    public function getPso(): ?float
    {
        return $this->pso;
    }

    public function setPso(?float $pso): self
    {
        $this->pso = $pso;

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
