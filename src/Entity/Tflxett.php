<?php

namespace App\Entity;

use App\Repository\TflxettRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TflxettRepository::class)
 */
class Tflxett
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tperiodicite::class)
     */
    private $clrPer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomFic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rptFic;

    /**
     * @ORM\ManyToOne(targetEntity=Tfournisseur::class)
     */
    private $fou;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmt;

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
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ecgFic;

    /**
     * @ORM\ManyToOne(targetEntity=Tficstrett::class)
     */
    private $clrFicstr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClrPer(): ?Tperiodicite
    {
        return $this->clrPer;
    }

    public function setClrPer(?Tperiodicite $ClrPer): self
    {
        $this->ClrPer = $ClrPer;

        return $this;
    }

    public function getNomFic(): ?string
    {
        return $this->nomFic;
    }

    public function setNomFic(?string $nomFic): self
    {
        $this->nomFic = $nomFic;

        return $this;
    }

    public function getRptFic(): ?string
    {
        return $this->rptFic;
    }

    public function setRptFic(?string $rptFic): self
    {
        $this->rptFic = $rptFic;

        return $this;
    }

    public function getFou(): ?Tfournisseur
    {
        return $this->fou;
    }

    public function setFou(?Tfournisseur $fou): self
    {
        $this->fou = $fou;

        return $this;
    }

    public function getCmt(): ?string
    {
        return $this->cmt;
    }

    public function setCmt(?string $cmt): self
    {
        $this->cmt = $cmt;

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

    public function getEcgFic(): ?string
    {
        return $this->ecgFic;
    }

    public function setEcgFic(?string $ecgFic): self
    {
        $this->ecgFic = $ecgFic;

        return $this;
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
}
