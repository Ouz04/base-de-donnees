<?php

namespace App\Entity;

use App\Repository\TmrqiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TmrqiceRepository::class)
 */
class Tmrqice
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
    private $nom;

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
     * @ORM\OneToMany(targetEntity=Tarticle::class, mappedBy="clrIcemrq")
     */
    private $tarticles;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cod;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xAct;

    public function __construct()
    {
        $this->tarticles = new ArrayCollection();
    }

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    /**
     * @return Collection|Tarticle[]
     */
    public function getTarticles(): Collection
    {
        return $this->tarticles;
    }

    public function addTarticle(Tarticle $tarticle): self
    {
        if (!$this->tarticles->contains($tarticle)) {
            $this->tarticles[] = $tarticle;
            $tarticle->setClrMrqice($this);
        }

        return $this;
    }

    public function removeTarticle(Tarticle $tarticle): self
    {
        if ($this->tarticles->removeElement($tarticle)) {
            // set the owning side to null (unless already changed)
            if ($tarticle->getClrMrqice() === $this) {
                $tarticle->setClrMrqice(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNom();
    }

    public function getCod(): ?string
    {
        return $this->cod;
    }

    public function setCod(?string $cod): self
    {
        $this->cod = $cod;

        return $this;
    }

    public function getXAct(): ?bool
    {
        return $this->xAct;
    }

    public function setXAct(?bool $xAct): self
    {
        $this->xAct = $xAct;

        return $this;
    }
}
