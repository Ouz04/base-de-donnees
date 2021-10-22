<?php

namespace App\Entity;

use App\Repository\TbpartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TbpartnerRepository::class)
 */
class Tbpartner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomSoc;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cpltNom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cpltAdr;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $numRue;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $cpltNumRue;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomRue;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lieuDit;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lclt;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $cpCdx;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lcltCdx;


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
     * @ORM\OneToMany(targetEntity=Tfournisseur::class, mappedBy="clrBpt")
     */
    private $tfournisseurs;

    /**
     * @ORM\OneToMany(targetEntity=Tclient::class, mappedBy="clrBpt")
     */
    private $tclients;

    /**
     * @ORM\OneToMany(targetEntity=Torganisation::class, mappedBy="clrBpt")
     */
    private $torganisations;

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
     * @ORM\ManyToOne(targetEntity=Tpays::class)
     */
    private $clrPys;

    public function __construct()
    {
        $this->tfournisseurs = new ArrayCollection();
        $this->tclients = new ArrayCollection();
        $this->torganisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSoc(): ?string
    {
        return $this->nomSoc;
    }

    public function setNomSoc(?string $nomSoc): self
    {
        $this->nomSoc = $nomSoc;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getCpltAdr(): ?string
    {
        return $this->cpltAdr;
    }

    public function setCpltAdr(?string $cpltAdr): self
    {
        $this->cpltAdr = $cpltAdr;

        return $this;
    }

    public function getNumRue(): ?string
    {
        return $this->numRue;
    }

    public function setNumRue(?string $numRue): self
    {
        $this->numRue = $numRue;

        return $this;
    }

    public function getCpltNumRue(): ?string
    {
        return $this->cpltNumRue;
    }

    public function setCpltNumRue(?string $cpltNumRue): self
    {
        $this->cpltNumRue = $cpltNumRue;

        return $this;
    }

    public function getNomRue(): ?string
    {
        return $this->nomRue;
    }

    public function setNomRue(?string $nomRue): self
    {
        $this->nomRue = $nomRue;

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

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getLclt(): ?string
    {
        return $this->lclt;
    }

    public function setLclt(?string $lclt): self
    {
        $this->lclt = $lclt;

        return $this;
    }

    public function getCpCdx(): ?string
    {
        return $this->cpCdx;
    }

    public function setCpCdx(?string $cpCdx): self
    {
        $this->cpCdx = $cpCdx;

        return $this;
    }

    public function getLcltCdx(): ?string
    {
        return $this->lcltCdx;
    }

    public function setLcltCdx(?string $lcltCdx): self
    {
        $this->lcltCdx = $lcltCdx;

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
     * @return Collection|Tfournisseur[]
     */
    public function getTfournisseurs(): Collection
    {
        return $this->tfournisseurs;
    }

    public function addTfournisseur(Tfournisseur $tfournisseur): self
    {
        if (!$this->tfournisseurs->contains($tfournisseur)) {
            $this->tfournisseurs[] = $tfournisseur;
            $tfournisseur->setClrBpt($this);
        }

        return $this;
    }

    public function removeTfournisseur(Tfournisseur $tfournisseur): self
    {
        if ($this->tfournisseurs->removeElement($tfournisseur)) {
            // set the owning side to null (unless already changed)
            if ($tfournisseur->getClrBpt() === $this) {
                $tfournisseur->setClrBpt(null);
            }
        }

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
            $tclient->setClrBpt($this);
        }

        return $this;
    }

    public function removeTclient(Tclient $tclient): self
    {
        if ($this->tclients->removeElement($tclient)) {
            // set the owning side to null (unless already changed)
            if ($tclient->getClrBpt() === $this) {
                $tclient->setClrBpt(null);
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
            $torganisation->setClrBpt($this);
        }

        return $this;
    }

    public function removeTorganisation(Torganisation $torganisation): self
    {
        if ($this->torganisations->removeElement($torganisation)) {
            // set the owning side to null (unless already changed)
            if ($torganisation->getClrBpt() === $this) {
                $torganisation->setClrBpt(null);
            }
        }

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
}
