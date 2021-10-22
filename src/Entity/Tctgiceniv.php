<?php

namespace App\Entity;

use App\Repository\TctgicenivRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TctgicenivRepository::class)
 */
class Tctgiceniv
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $dsg;

    /**
     * @ORM\Column(type="integer")
     */
    private $niv;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idIce;

    /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class, inversedBy="tctgicenivs")
     */
    private $clrCtgiceprc;

    /**
     * @ORM\OneToMany(targetEntity=Tctgiceniv::class, mappedBy="clrCtgiceprc")
     */
    private $tctgicenivs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xAct = 1;

    public function __construct()
    {
        $this->tctgicenivs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNiv(): ?int
    {
        return $this->niv;
    }

    public function setNiv(int $niv): self
    {
        $this->niv = $niv;

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

    public function getIdIce(): ?int
    {
        return $this->idIce;
    }

    public function setIdIce(?int $idIce): self
    {
        $this->idIce = $idIce;

        return $this;
    }
    public function __toString()
    {
        return $this->getDsg();
    }

    public function getClrCtgiceprc(): ?self
    {
        return $this->clrCtgiceprc;
    }

    public function setClrCtgiceprc(?self $clrCtgiceprc): self
    {
        $this->clrCtgiceprc = $clrCtgiceprc;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getTctgicenivs(): Collection
    {
        return $this->tctgicenivs;
    }

    public function addTctgiceniv(self $tctgiceniv): self
    {
        if (!$this->tctgicenivs->contains($tctgiceniv)) {
            $this->tctgicenivs[] = $tctgiceniv;
            $tctgiceniv->setClrCtgiceprc($this);
        }

        return $this;
    }

    public function removeTctgiceniv(self $tctgiceniv): self
    {
        if ($this->tctgicenivs->removeElement($tctgiceniv)) {
            // set the owning side to null (unless already changed)
            if ($tctgiceniv->getClrCtgiceprc() === $this) {
                $tctgiceniv->setClrCtgiceprc(null);
            }
        }

        return $this;
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
}
