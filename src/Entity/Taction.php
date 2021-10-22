<?php

namespace App\Entity;

use App\Repository\TactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TactionRepository::class)
 */
class Taction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $cod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dsg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dsgLng;

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

    /**
     * @ORM\ManyToOne(targetEntity=Trole::class)
     */
    private $clrRol;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rngAff;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $typ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlSit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCod(): ?string
    {
        return $this->cod;
    }

    public function setCod(string $cod): self
    {
        $this->cod = $cod;

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

    public function getDsgLng(): ?string
    {
        return $this->dsgLng;
    }

    public function setDsgLng(?string $dsgLng): self
    {
        $this->dsgLng = $dsgLng;

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

    public function getClrRol(): ?Trole
    {
        return $this->clrRol;
    }

    public function setClrRol(?Trole $clrRol): self
    {
        $this->clrRol = $clrRol;

        return $this;
    }

    public function getRngAff(): ?int
    {
        return $this->rngAff;
    }

    public function setRngAff(?int $rngAff): self
    {
        $this->rngAff = $rngAff;

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

    public function getUrlSit(): ?string
    {
        return $this->urlSit;
    }

    public function setUrlSit(?string $urlSit): self
    {
        $this->urlSit = $urlSit;

        return $this;
    }

    public function getRte(): ?string
    {
        return $this->rte;
    }

    public function setRte(?string $rte): self
    {
        $this->rte = $rte;

        return $this;
    }
}
