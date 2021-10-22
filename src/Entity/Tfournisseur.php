<?php

namespace App\Entity;

use App\Repository\TfournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TfournisseurRepository::class)
 */
class Tfournisseur
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
     * @ORM\Column(type="string", length=50)
     */
    private $rso;

    /**
     * @ORM\ManyToOne(targetEntity=Tbpartner::class, inversedBy="tfournisseurs")
     */
    private $clrBpt;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $datins;

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
     * @ORM\OneToMany(targetEntity=Tartfou::class, mappedBy="clrFou")
     */
    private $tartfous;

    /**
     * @ORM\OneToMany(targetEntity=Tprxach::class, mappedBy="clpFou")
     */
    private $tprxaches;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xAct = true;

    /**
     * @ORM\OneToMany(targetEntity=Tcotation::class, mappedBy="clrFou")
     */
    private $tcotations;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $codAdx;

    public function __construct()
    {
        $this->tartfous = new ArrayCollection();
        $this->tprxaches = new ArrayCollection();
        $this->tcotations = new ArrayCollection();
    }

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

    public function getRso(): ?string
    {
        return $this->rso;
    }

    public function setRso(string $rso): self
    {
        $this->rso = $rso;

        return $this;
    }

    public function getClrBpt(): ?Tbpartner
    {
        return $this->clrBpt;
    }

    public function setClrBpt(?Tbpartner $clrBpt): self
    {
        $this->clrBpt = $clrBpt;

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

    public function setDatUpd(?\DateTimeInterface $datUpd): self
    {
        $this->datUpd = $datUpd;

        return $this;
    }

    /**
     * @return Collection|Tartfou[]
     */
    public function getTartfous(): Collection
    {
        return $this->tartfous;
    }

    public function addTartfou(Tartfou $tartfou): self
    {
        if (!$this->tartfous->contains($tartfou)) {
            $this->tartfous[] = $tartfou;
            $tartfou->setClrFou($this);
        }

        return $this;
    }

    public function removeTartfou(Tartfou $tartfou): self
    {
        if ($this->tartfous->removeElement($tartfou)) {
            // set the owning side to null (unless already changed)
            if ($tartfou->getClrFou() === $this) {
                $tartfou->setClrFou(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tprxach[]
     */
    public function getTprxaches(): Collection
    {
        return $this->tprxaches;
    }

    public function addTprxach(Tprxach $tprxach): self
    {
        if (!$this->tprxaches->contains($tprxach)) {
            $this->tprxaches[] = $tprxach;
            $tprxach->setClpFou($this);
        }

        return $this;
    }

    public function removeTprxach(Tprxach $tprxach): self
    {
        if ($this->tprxaches->removeElement($tprxach)) {
            // set the owning side to null (unless already changed)
            if ($tprxach->getClpFou() === $this) {
                $tprxach->setClpFou(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getRso();
    }

    public function getXAct(): ?bool
    {
        return $this->xAct;
    }

    public function setXAct(bool $xAct): self
    {
        $this->xAct = $xAct;

        return $this;
    }

    /**
     * @return Collection|Tcotation[]
     */
    public function getTcotations(): Collection
    {
        return $this->tcotations;
    }

    public function addTcotation(Tcotation $tcotation): self
    {
        if (!$this->tcotations->contains($tcotation)) {
            $this->tcotations[] = $tcotation;
            $tcotation->setClrFou($this);
        }

        return $this;
    }

    public function removeTcotation(Tcotation $tcotation): self
    {
        if ($this->tcotations->removeElement($tcotation)) {
            // set the owning side to null (unless already changed)
            if ($tcotation->getClrFou() === $this) {
                $tcotation->setClrFou(null);
            }
        }

        return $this;
    }

    public function getCodAdx(): ?string
    {
        return $this->codAdx;
    }

    public function setCodAdx(string $codAdx): self
    {
        $this->codAdx = $codAdx;

        return $this;
    }
}
