<?php

namespace App\Entity;

use App\Entity\Tpays;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TorganisationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=TorganisationRepository::class)
 */
class Torganisation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cod;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\OneToMany(targetEntity=Tgritar::class, mappedBy="clrOrg")
     */
    private $tgritars;

    /**
     * @ORM\ManyToOne(targetEntity=Tclient::class, inversedBy="torganisations")
     */
    private $clrCli;

    /**
     * @ORM\ManyToOne(targetEntity=Tbpartner::class, inversedBy="torganisations")
     */
    private $clrBpt;

    /**
     * @ORM\OneToMany(targetEntity=Tgritarett::class, mappedBy="clrOrg")
     */
    private $tgritaretts;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $rso;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cpltNom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cpltAdr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lieuDit;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lclt;

    /**
     * @ORM\ManyToOne(targetEntity=Tpays::class)
     */
    private $clrPys;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ctc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telBur;

    /**
     * @ORM\ManyToOne(targetEntity=Tcommercial::class, inversedBy="torganisations")
     */
    private $clrCml;

    /**
     * @ORM\OneToMany(targetEntity=Tcotorg::class, mappedBy="clrOrg")
     */
    private $tcotorgs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xAct;

    /**
     * @ORM\OneToMany(targetEntity=TcliOrg::class, mappedBy="clrOrg")
     */
    private $tcliOrgs;

    public function __construct()
    {
        $this->tgritars = new ArrayCollection();
        $this->tgritaretts = new ArrayCollection();
        $this->tcotorgs = new ArrayCollection();
        $this->tcliOrgs = new ArrayCollection();
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
     * @return Collection|Tgritar[]
     */
    public function getTgritars(): Collection
    {
        return $this->tgritars;
    }

    public function addTgritar(Tgritar $tgritar): self
    {
        if (!$this->tgritars->contains($tgritar)) {
            $this->tgritars[] = $tgritar;
            $tgritar->setClrOrg($this);
        }

        return $this;
    }

    public function removeTgritar(Tgritar $tgritar): self
    {
        if ($this->tgritars->removeElement($tgritar)) {
            // set the owning side to null (unless already changed)
            if ($tgritar->getClrOrg() === $this) {
                $tgritar->setClrOrg(null);
            }
        }

        return $this;
    }

    public function getClrCli(): ?Tclient
    {
        return $this->clrCli;
    }

    public function setClrCli(?Tclient $clrCli): self
    {
        $this->clrCli = $clrCli;

        return $this;
    }


    public function addTcotation(Tcotation $tcotation): self
    {

        return $this;
    }

    public function removeTcotation(Tcotation $tcotation): self
    {

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

    /**
     * @return Collection|Tgritarett[]
     */
    public function getTgritaretts(): Collection
    {
        return $this->tgritaretts;
    }

    public function addTgritarett(Tgritarett $tgritarett): self
    {
        if (!$this->tgritaretts->contains($tgritarett)) {
            $this->tgritaretts[] = $tgritarett;
            $tgritarett->setClrOrg($this);
        }

        return $this;
    }

    public function removeTgritarett(Tgritarett $tgritarett): self
    {
        if ($this->tgritaretts->removeElement($tgritarett)) {
            // set the owning side to null (unless already changed)
            if ($tgritarett->getClrOrg() === $this) {
                $tgritarett->setClrOrg(null);
            }
        }

        return $this;
    }

    public function getRso(): ?string
    {
        return $this->rso;
    }

    public function setRso(?string $rso): self
    {
        $this->rso = $rso;

        return $this;
    }

    public function getCpltNom(): ?string
    {
        return $this->cpltNom;
    }

    public function setCpltNom(?string $cpltNom): self
    {
        $this->cpltNom = $cpltNom;

        return $this;
    }

    public function getAdr(): ?string
    {
        return $this->adr;
    }

    public function setAdr(string $adr): self
    {
        $this->adr = $adr;

        return $this;
    }

    public function getCpltAdr(): ?string
    {
        return $this->cpltAdr;
    }

    public function setCpltAdr(?string $cpltAdr): self
    {
        $this->cpltAdr = $cpltAdr;

        return $this;
    }

    public function getLieuDit(): ?string
    {
        return $this->lieuDit;
    }

    public function setLieuDit(?string $lieuDit): self
    {
        $this->lieuDit = $lieuDit;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getLclt(): ?string
    {
        return $this->lclt;
    }

    public function setLclt(string $lclt): self
    {
        $this->lclt = $lclt;

        return $this;
    }

    public function getClrPys(): ?Tpays
    {
        return $this->clrPys;
    }

    public function setClrPys(Tpays $clrPys): self
    {
        $this->pys = $clrPys;

        return $this;
    }

    public function getCtc(): ?string
    {
        return $this->ctc;
    }

    public function setCtc(?string $ctc): self
    {
        $this->ctc = $ctc;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelBur(): ?string
    {
        return $this->telBur;
    }

    public function setTelBur(?string $telBur): self
    {
        $this->telBur = $telBur;

        return $this;
    }

    public function getClrCml(): ?Tcommercial
    {
        return $this->clrCml;
    }

    public function setClrCml(?Tcommercial $clrCml): self
    {
        $this->clrCml = $clrCml;

        return $this;
    }

    /**
     * @return Collection|Tcotorg[]
     */
    public function getTcotorgs(): Collection
    {
        return $this->tcotorgs;
    }

    public function addTcotorg(Tcotorg $tcotorg): self
    {
        if (!$this->tcotorgs->contains($tcotorg)) {
            $this->tcotorgs[] = $tcotorg;
            $tcotorg->setClrOrg($this);
        }

        return $this;
    }

    public function removeTcotorg(Tcotorg $tcotorg): self
    {
        if ($this->tcotorgs->removeElement($tcotorg)) {
            // set the owning side to null (unless already changed)
            if ($tcotorg->getClrOrg() === $this) {
                $tcotorg->setClrOrg(null);
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

    /**
     * @return Collection|TcliOrg[]
     */
    public function getTcliOrgs(): Collection
    {
        return $this->tcliOrgs;
    }

    public function addTcliOrg(TcliOrg $tcliOrg): self
    {
        if (!$this->tcliOrgs->contains($tcliOrg)) {
            $this->tcliOrgs[] = $tcliOrg;
            $tcliOrg->setClrOrg($this);
        }

        return $this;
    }

    public function removeTcliOrg(TcliOrg $tcliOrg): self
    {
        if ($this->tcliOrgs->removeElement($tcliOrg)) {
            // set the owning side to null (unless already changed)
            if ($tcliOrg->getClrOrg() === $this) {
                $tcliOrg->setClrOrg(null);
            }
        }

        return $this;
    }
}
