<?php

namespace App\Entity;

use App\Repository\TcommercialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TcommercialRepository::class)
 */
class Tcommercial
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
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

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
     * @ORM\OneToMany(targetEntity=Tusrcml::class, mappedBy="clrCml")
     */
    private $tusrcmls;

    /**
     * @ORM\OneToMany(targetEntity=Torganisation::class, mappedBy="clrCml")
     */
    private $torganisations;

    /**
     * @ORM\OneToMany(targetEntity=Tclient::class, mappedBy="clrCml")
     */
    private $tclients;


    public function __construct()
    {
        $this->tcmlusrs = new ArrayCollection();
        $this->tusrcmls = new ArrayCollection();
        $this->torganisations = new ArrayCollection();
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
     * @return Collection|Tusrcml[]
     */
    public function getTusrcmls(): Collection
    {
        return $this->tusrcmls;
    }

    public function addTusrcml(Tusrcml $tusrcml): self
    {
        if (!$this->tusrcmls->contains($tusrcml)) {
            $this->tusrcmls[] = $tusrcml;
            $tusrcml->setClrCml($this);
        }

        return $this;
    }

    public function removeTusrcml(Tusrcml $tusrcml): self
    {
        if ($this->tusrcmls->removeElement($tusrcml)) {
            // set the owning side to null (unless already changed)
            if ($tusrcml->getClrCml() === $this) {
                $tusrcml->setClrCml(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Torganisation[]
     */
    public function getTorganisations(): Collection
    {
        return $this->torganisations;
    }

    public function addTorganisation(Torganisation $torganisation): self
    {
        if (!$this->torganisations->contains($torganisation)) {
            $this->torganisations[] = $torganisation;
            $torganisation->setClrCml($this);
        }

        return $this;
    }

    public function removeTorganisation(Torganisation $torganisation): self
    {
        if ($this->torganisations->removeElement($torganisation)) {
            // set the owning side to null (unless already changed)
            if ($torganisation->getClrCml() === $this) {
                $torganisation->setClrCml(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNom();
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
            $tclient->setClrCml($this);
        }

        return $this;
    }

    public function removeTclient(Tclient $tclient): self
    {
        if ($this->tclients->removeElement($tclient)) {
            // set the owning side to null (unless already changed)
            if ($tclient->getClrCml() === $this) {
                $tclient->setClrCml(null);
            }
        }

        return $this;
    }
}
