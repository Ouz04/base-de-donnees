<?php

namespace App\Entity;

use App\Repository\TcotorgRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TcotorgRepository::class)
 */
class Tcotorg
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tcotation::class, inversedBy="tcotorgs")
     */
    private $clrCot;

    /**
     * @ORM\ManyToOne(targetEntity=Torganisation::class, inversedBy="tcotorgs")
     */
    private $clrOrg;

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
     * @ORM\Column(type="date")
     */
    private $datDeb;

    /**
     * @ORM\Column(type="date")
     */
    private $datFin;

    /**
     * @ORM\OneToMany(targetEntity=Tgritarpst::class, mappedBy="clrCotorg")
     */
    private $tgritarpsts;

    public function __construct()
    {
        $this->tgritarpsts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClrOrg(): ?Torganisation
    {
        return $this->clrOrg;
    }

    public function setClrOrg(?Torganisation $clrOrg): self
    {
        $this->clrOrg = $clrOrg;

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

    public function setDatFin(\DateTimeInterface $datFin): self
    {
        $this->datFin = $datFin;

        return $this;
    }

    /**
     * @return Collection|Tgritarpst[]
     */
    public function getTgritarpsts(): Collection
    {
        return $this->tgritarpsts;
    }

    public function addTgritarpst(Tgritarpst $tgritarpst): self
    {
        if (!$this->tgritarpsts->contains($tgritarpst)) {
            $this->tgritarpsts[] = $tgritarpst;
            $tgritarpst->setClrCotorg($this);
        }

        return $this;
    }

    public function removeTgritarpst(Tgritarpst $tgritarpst): self
    {
        if ($this->tgritarpsts->removeElement($tgritarpst)) {
            // set the owning side to null (unless already changed)
            if ($tgritarpst->getClrCotorg() === $this) {
                $tgritarpst->setClrCotorg(null);
            }
        }

        return $this;
    }
}
