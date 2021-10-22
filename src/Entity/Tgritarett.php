<?php

namespace App\Entity;

use App\Repository\TgritarettRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TgritarettRepository::class)
 */
class Tgritarett
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Torganisation::class, inversedBy="tgritaretts")
     */
    private $clrOrg;

    /**
     * @ORM\Column(type="date")
     */
    private $datDeb;

    /**
     * @ORM\Column(type="date")
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
     * @ORM\OneToMany(targetEntity=Tgritarpst::class, mappedBy="clrGta")
     */
    private $tgritarpsts;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $cod;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dsg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmt;

    /**
     * @ORM\ManyToOne(targetEntity=Ttyporigta::class, inversedBy="tgritaretts")
     */
    private $clrTog;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $codCtt;

    /**
     * @ORM\ManyToOne(targetEntity=Tclient::class, inversedBy="tgritaretts")
     */
    private $clrCli;

    public function __construct()
    {
        $this->tgritarpsts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $tgritarpst->setClrGta($this);
        }

        return $this;
    }

    public function removeTgritarpst(Tgritarpst $tgritarpst): self
    {
        if ($this->tgritarpsts->removeElement($tgritarpst)) {
            // set the owning side to null (unless already changed)
            if ($tgritarpst->getClrGta() === $this) {
                $tgritarpst->setClrGta(null);
            }
        }

        return $this;
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

    public function setDsg(?string $dsg): self
    {
        $this->dsg = $dsg;

        return $this;
    }

    public function getCmt(): ?string
    {
        return $this->cmt;
    }

    public function setCmt(?string $cmt): self
    {
        $this->cmt = $cmt;

        return $this;
    }

    public function getClrTog(): ?Ttyporigta
    {
        return $this->clrTog;
    }

    public function setClrTog(?Ttyporigta $clrTog): self
    {
        $this->clrTog = $clrTog;

        return $this;
    }

    public function getCodCtt(): ?string
    {
        return $this->codCtt;
    }

    public function setCodCtt(?string $codCtt): self
    {
        $this->codCtt = $codCtt;

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

    
}
