<?php

namespace App\Entity;

use App\Repository\TgritarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TgritarRepository::class)
 */
class Tgritar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Torganisation::class, inversedBy="tgritars")
     */
    private $clrOrg;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="tgritars")
     */
    private $ClrArtId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libArt;

    /**
     * @ORM\Column(type="float")
     */
    private $prxAch;

    /**
     * @ORM\Column(type="float")
     */
    private $prxVte;

    /**
     * @ORM\Column(type="float")
     */
    private $pec;

    /**
     * @ORM\Column(type="float")
     */
    private $pso;

    /**
     * @ORM\Column(type="date")
     */
    private $datDeb;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datFin;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datins;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datUpd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClrOrg(): ?Torganisation
    {
        return $this->clrOrg;
    }

    public function setClrOrg(?Torganisation $clrOrg): self
    {
        $this->clrOrg = $clrOrg;

        return $this;
    }

    public function getClrArtId(): ?Tarticle
    {
        return $this->ClrArtId;
    }

    public function setClrArtId(?Tarticle $ClrArtId): self
    {
        $this->ClrArtId = $ClrArtId;

        return $this;
    }

    public function getLibArt(): ?string
    {
        return $this->libArt;
    }

    public function setLibArt(string $libArt): self
    {
        $this->libArt = $libArt;

        return $this;
    }

    public function getPrxAch(): ?float
    {
        return $this->prxAch;
    }

    public function setPrxAch(float $prxAch): self
    {
        $this->prxAch = $prxAch;

        return $this;
    }

    public function getPrxVte(): ?float
    {
        return $this->prxVte;
    }

    public function setPrxVte(float $prxVte): self
    {
        $this->prxVte = $prxVte;

        return $this;
    }

    public function getPec(): ?float
    {
        return $this->pec;
    }

    public function setPec(float $pec): self
    {
        $this->pec = $pec;

        return $this;
    }

    public function getPso(): ?float
    {
        return $this->pso;
    }

    public function setPso(float $pso): self
    {
        $this->pso = $pso;

        return $this;
    }

    public function getDatDeb(): ?\DateTimeInterface
    {
        return $this->datDeb;
    }

    public function setDatDeb(\DateTimeInterface $datDeb): self
    {
        $this->datDeb = $datDeb;

        return $this;
    }

    public function getDatFin(): ?\DateTimeInterface
    {
        return $this->datFin;
    }

    public function setDatFin(?\DateTimeInterface $datFin): self
    {
        $this->datFin = $datFin;

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

    public function getDatins(): ?\DateTimeInterface
    {
        return $this->datins;
    }

    public function setDatins(\DateTimeInterface $datins): self
    {
        $this->datins = $datins;

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

    public function setDatUpd(\DateTimeInterface $datUpd): self
    {
        $this->datUpd = $datUpd;

        return $this;
    }
}
