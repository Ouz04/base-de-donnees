<?php

namespace App\Entity;

use App\Repository\TclientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TclientRepository::class)
 */
class Tclient
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
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Tbpartner::class, inversedBy="tclients")
     */
    private $clrBpt;

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
     * @ORM\ManyToOne(targetEntity=Tcommercial::class, inversedBy="tclients")
     */
    private $clrCml;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xAct;

    /**
     * @ORM\OneToMany(targetEntity=Tcotcli::class, mappedBy="clrCli")
     */
    private $tcotclis;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $rso;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cpltNom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
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
     * @ORM\Column(type="string", length=20)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lclt;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ctc;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telBur;

    /**
     * @ORM\ManyToOne(targetEntity=Tpays::class)
     */
    private $clrPys;

    /**
     * @ORM\ManyToOne(targetEntity=Tfamcli::class, inversedBy="tclients")
     */
    private $clrFamcli;

    /**
     * @ORM\OneToMany(targetEntity=Tgritarett::class, mappedBy="clrCli")
     */
    private $tgritaretts;

    /**
     * @ORM\ManyToOne(targetEntity=Tsociete::class, inversedBy="tclients")
     */
    private $clrSoc;

    /**
     * @ORM\ManyToOne(targetEntity=Tsocgpe::class, inversedBy="tclients")
     */
    private $clrSocgpe;

    /**
     * @ORM\ManyToOne(targetEntity=Tsocgpt::class, inversedBy="tclients")
     */
    private $clrSocgpt;

    /**
     * @ORM\OneToMany(targetEntity=TcliOrg::class, mappedBy="clrCli")
     */
    private $tcliOrgs;

    public function __construct()
    {
        //   $this->torganisations = new ArrayCollection();
        $this->tcotclis = new ArrayCollection();
        $this->tgritaretts = new ArrayCollection();
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



    public function getClrCml(): ?Tcommercial
    {
        return $this->clrCml;
    }

    public function setClrCml(?Tcommercial $clrCml): self
    {
        $this->clrCml = $clrCml;

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

    /**
     * @return Collection|Tcotcli[]
     */
    public function getTcotclis(): Collection
    {
        return $this->tcotclis;
    }

    public function addTcotcli(Tcotcli $tcotcli): self
    {
        if (!$this->tcotclis->contains($tcotcli)) {
            $this->tcotclis[] = $tcotcli;
            $tcotcli->setClrCli($this);
        }

        return $this;
    }

    public function removeTcotcli(Tcotcli $tcotcli): self
    {
        if ($this->tcotclis->removeElement($tcotcli)) {
            // set the owning side to null (unless already changed)
            if ($tcotcli->getClrCli() === $this) {
                $tcotcli->setClrCli(null);
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

    public function setAdr(?string $adr): self
    {
        $this->adr = $adr;

        return $this;
    }

    public function getCpltAdr(): ?string
    {
        return $this->cpltAdr;
    }

    public function setCpltAdr(string $cpltAdr): self
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

    public function getClrPys(): ?Tpays
    {
        return $this->clrPys;
    }

    public function setClrPys(?Tpays $clrPys): self
    {
        $this->clrPys = $clrPys;

        return $this;
    }

    public function __toString()
    {
        return $this->getCod();
    }

    public function getClrFamcli(): ?Tfamcli
    {
        return $this->clrFamcli;
    }

    public function setClrFamcli(?Tfamcli $clrFamcli): self
    {
        $this->clrFamcli = $clrFamcli;

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
            $tgritarett->setClrCli($this);
        }

        return $this;
    }

    public function removeTgritarett(Tgritarett $tgritarett): self
    {
        if ($this->tgritaretts->removeElement($tgritarett)) {
            // set the owning side to null (unless already changed)
            if ($tgritarett->getClrCli() === $this) {
                $tgritarett->setClrCli(null);
            }
        }

        return $this;
    }

    public function getClrSoc(): ?Tsociete
    {
        return $this->clrSoc;
    }

    public function setClrSoc(?Tsociete $clrSoc): self
    {
        $this->clrSoc = $clrSoc;

        return $this;
    }

    public function getClrSocgpe(): ?Tsocgpe
    {
        return $this->clrSocgpe;
    }

    public function setClrSocgpe(?Tsocgpe $clrSocgpe): self
    {
        $this->clrSocgpe = $clrSocgpe;

        return $this;
    }

    public function getClrSocgpt(): ?Tsocgpt
    {
        return $this->clrSocgpt;
    }

    public function setClrSocgpt(?Tsocgpt $clrSocgpt): self
    {
        $this->clrSocgpt = $clrSocgpt;

        return $this;
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
            $tcliOrg->setClrCli($this);
        }

        return $this;
    }

    public function removeTcliOrg(TcliOrg $tcliOrg): self
    {
        if ($this->tcliOrgs->removeElement($tcliOrg)) {
            // set the owning side to null (unless already changed)
            if ($tcliOrg->getClrCli() === $this) {
                $tcliOrg->setClrCli(null);
            }
        }

        return $this;
    }
}
