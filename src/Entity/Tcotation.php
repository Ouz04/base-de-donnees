<?php

namespace App\Entity;

use App\Repository\TcotationRepository;
use App\Entity\Tuser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=TcotationRepository::class)
 * @ORM\Table(indexes={@ORM\Index(columns={"cod"})})
 */
class Tcotation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $cod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dsg;

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
     * @ORM\OneToMany(targetEntity=Tartcot::class, mappedBy="cltCot")
     */
    private $tartcots;


    /**
     * @ORM\OneToMany(targetEntity=Tcotorg::class, mappedBy="clrCot")
     */
    private $tcotorgs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xAct;

    /**
     * @ORM\ManyToOne(targetEntity=Tfournisseur::class, inversedBy="tcotations")
     */
    private $clrFou;

    /**
     * @ORM\OneToMany(targetEntity=Tcotcli::class, mappedBy="clrCot")
     */
    private $tcotclis;

    /**
     * @ORM\OneToMany(targetEntity=Tcotfamcli::class, mappedBy="clrCot")
     */
    private $tcotfamclis;

    public function __construct()
    {
        $this->tartcots = new ArrayCollection();
        $this->tcotorgs = new ArrayCollection();
        $this->tcotclis = new ArrayCollection();
        $this->tcotfamclis = new ArrayCollection();
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
     * @return Collection|Tartcot[]
     */
    public function getTartcots(): Collection
    {
        return $this->tartcots;
    }

    public function addTartcot(Tartcot $tartcot): self
    {
        if (!$this->tartcots->contains($tartcot)) {
            $this->tartcots[] = $tartcot;
            $tartcot->setClrCot($this);
        }

        return $this;
    }

    public function removeTartcot(Tartcot $tartcot): self
    {
        if ($this->tartcots->removeElement($tartcot)) {
            // set the owning side to null (unless already changed)
            if ($tartcot->getClrCot() === $this) {
                $tartcot->setClrCot(null);
            }
        }

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
            $tcotorg->setClrCot($this);
        }

        return $this;
    }

    public function removeTcotorg(Tcotorg $tcotorg): self
    {
        if ($this->tcotorgs->removeElement($tcotorg)) {
            // set the owning side to null (unless already changed)
            if ($tcotorg->getClrCot() === $this) {
                $tcotorg->setClrCot(null);
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

    public function getClrFou(): ?Tfournisseur
    {
        return $this->clrFou;
    }

    public function setClrFou(?Tfournisseur $clrFou): self
    {
        $this->clrFou = $clrFou;

        return $this;
    }
    public function __toString()
    {
        return $this->getCod();
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
            $tcotcli->setClrCot($this);
        }

        return $this;
    }

    public function removeTcotcli(Tcotcli $tcotcli): self
    {
        if ($this->tcotclis->removeElement($tcotcli)) {
            // set the owning side to null (unless already changed)
            if ($tcotcli->getClrCot() === $this) {
                $tcotcli->setClrCot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tcotfamcli[]
     */
    public function getTcotfamclis(): Collection
    {
        return $this->tcotfamclis;
    }

    public function addTcotfamcli(Tcotfamcli $tcotfamcli): self
    {
        if (!$this->tcotfamclis->contains($tcotfamcli)) {
            $this->tcotfamclis[] = $tcotfamcli;
            $tcotfamcli->setClrCot($this);
        }

        return $this;
    }

    public function removeTcotfamcli(Tcotfamcli $tcotfamcli): self
    {
        if ($this->tcotfamclis->removeElement($tcotfamcli)) {
            // set the owning side to null (unless already changed)
            if ($tcotfamcli->getClrCot() === $this) {
                $tcotfamcli->setClrCot(null);
            }
        }

        return $this;
    }
}
