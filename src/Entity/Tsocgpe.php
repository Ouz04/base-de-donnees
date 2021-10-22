<?php

namespace App\Entity;

use App\Repository\TsocgpeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TsocgpeRepository::class)
 */
class Tsocgpe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dsg;

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
     * 
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\OneToMany(targetEntity=Tclient::class, mappedBy="clrSocgpe")
     */
    private $tclients;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xAct;

    public function __construct()
    {
        $this->tclients = new ArrayCollection();
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

    public function getDsg(): ?string
    {
        return $this->dsg;
    }

    public function setDsg(string $dsg): self
    {
        $this->dsg = $dsg;

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

    /**
     * @return Collection|Tclient[]
     */
    public function getTclients(): Collection
    {
        return $this->tclients;
    }

    public function addTclient(Tclient $tclient): self
    {
        if (!$this->tclients->contains($tclient)) {
            $this->tclients[] = $tclient;
            $tclient->setClrSocgpe($this);
        }

        return $this;
    }

    public function removeTclient(Tclient $tclient): self
    {
        if ($this->tclients->removeElement($tclient)) {
            // set the owning side to null (unless already changed)
            if ($tclient->getClrSocgpe() === $this) {
                $tclient->setClrSocgpe(null);
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
    public function __toString()
    {
        return $this->getCod();
    }
}
