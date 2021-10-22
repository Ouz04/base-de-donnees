<?php

namespace App\Entity;

use App\Repository\TctgiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TctgiceRepository::class)
 */
class Tctgice
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
     * @ORM\Column(type="string", length=100)
     */
    private $niv1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $niv2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $niv3;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $niv4;

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

    public function getNiv1(): ?string
    {
        return $this->niv1;
    }

    public function setNiv1(string $niv1): self
    {
        $this->niv1 = $niv1;

        return $this;
    }

    public function getNiv2(): ?string
    {
        return $this->niv2;
    }

    public function setNiv2(?string $niv2): self
    {
        $this->niv2 = $niv2;

        return $this;
    }

    public function getNiv3(): ?string
    {
        return $this->niv3;
    }

    public function setNiv3(?string $niv3): self
    {
        $this->niv3 = $niv3;

        return $this;
    }

    public function getNiv4(): ?string
    {
        return $this->niv4;
    }

    public function setNiv4(?string $niv4): self
    {
        $this->niv4 = $niv4;

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
