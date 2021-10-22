<?php

namespace App\Entity;

use App\Repository\TartfouRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// use Dtc\GridBundle\Annotation as Grid;

/**
 * @ORM\Entity(repositoryClass=TartfouRepository::class)
 * @ORM\Table(indexes={@ORM\Index(columns={"x_act"})})
 * @ORM\Table(indexes={@ORM\Index(columns={"x_enr_trf_adx"})})
 */
class Tartfou
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="tartfous")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clrArt;

    /**
     * @ORM\ManyToOne(targetEntity=Tfournisseur::class, inversedBy="tartfous")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clrFou;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime",nullable=false)
     */
    private $datIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteCnd;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $dev;

    /**
     * @ORM\Column(type="date")
     */
    private $datPrx;

    /**
     * @ORM\Column(type="float")
     */
    private $prxAch;

    /**
     * @ORM\Column(type="float")
     */
    private $prxPbl;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qteStk;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prxTxe;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prxTxs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xAct;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteMin;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $codEan;

    /**
     * @ORM\OneToMany(targetEntity=Tgritarpst::class, mappedBy="clrArtfou")
     */
    private $tgritarpsts;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xEnrTrfAdx;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xCntmrq;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $codArtFou;
    /**
     * ajout zone pour le formulaire de création
     */
    /**
     * 
     */
    private $codArtFrm;

    /**
     * @ORM\ManyToOne(targetEntity=Tcotation::class)
     */
    private $clrCot;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qteMax;

    public function __construct()
    {
        $this->tgritarpsts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClrArt(): ?Tarticle
    {
        return $this->clrArt;
    }

    public function setClrArt(?Tarticle $clrArt): self
    {
        $this->clrArt = $clrArt;

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

    public function getQteCnd(): ?int
    {
        return $this->qteCnd;
    }

    public function setQteCnd(int $qteCnd): self
    {
        $this->qteCnd = $qteCnd;

        return $this;
    }

    public function getDev(): ?string
    {
        return $this->dev;
    }

    public function setDev(string $dev): self
    {
        $this->dev = $dev;

        return $this;
    }

    public function getDatPrx(): ?\DateTimeInterface
    {
        return $this->datPrx;
    }

    public function setDatPrx(\DateTimeInterface $datPrx): self
    {
        $this->datPrx = $datPrx;

        return $this;
    }

    public function getPrxAch(): ?float
    {
        return $this->prxAch;
    }

    public function setPrxAch(float $prxAch): self
    {
        $this->prxAch = $prxAch;

        return $this;
    }

    public function getPrxPbl(): ?float
    {
        return $this->prxPbl;
    }

    public function setPrxPbl(float $prxPbl): self
    {
        $this->prxPbl = $prxPbl;

        return $this;
    }

    public function getQteStk(): ?int
    {
        return $this->qteStk;
    }

    public function setQteStk(?int $qteStk): self
    {
        $this->qteStk = $qteStk;

        return $this;
    }

    public function getPrxTxe(): ?string
    {
        return $this->prxTxe;
    }

    public function setPrxTxe(?string $prxTxe): self
    {
        $this->prxTxe = $prxTxe;

        return $this;
    }

    public function getPrxTxs(): ?string
    {
        return $this->prxTxs;
    }

    public function setPrxTxs(?string $prxTxs): self
    {
        $this->prxTxs = $prxTxs;

        return $this;
    }

    public function getPrt(): ?int
    {
        return $this->prt;
    }

    public function setPrt(?int $prt): self
    {
        $this->prt = $prt;

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

    public function getQteMin(): ?int
    {
        return $this->qteMin;
    }

    public function setQteMin(int $qteMin): self
    {
        $this->qteMin = $qteMin;

        return $this;
    }

    public function getCodEan(): ?string
    {
        return $this->codEan;
    }

    public function setCodEan(?string $codEan): self
    {
        $this->codEan = $codEan;

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
            $tgritarpst->setClrArtfou($this);
        }

        return $this;
    }

    public function removeTgritarpst(Tgritarpst $tgritarpst): self
    {
        if ($this->tgritarpsts->removeElement($tgritarpst)) {
            // set the owning side to null (unless already changed)
            if ($tgritarpst->getClrArtfou() === $this) {
                $tgritarpst->setClrArtfou(null);
            }
        }

        return $this;
    }

    public function getXEnrTrfAdx(): ?bool
    {
        return $this->xEnrTrfAdx;
    }

    public function setXEnrTrfAdx(?bool $xEnrTrfAdx): self
    {
        $this->xEnrTrfAdx = $xEnrTrfAdx;

        return $this;
    }

    public function getXCntmrq(): ?bool
    {
        return $this->xCntmrq;
    }

    public function setXCntmrq(bool $xCntmrq): self
    {
        $this->xCntmrq = $xCntmrq;

        return $this;
    }

    public function getCodArtFou(): ?string
    {
        return $this->codArtFou;
    }

    public function setCodArtFou(?string $codArtFou): self
    {
        $this->codArtFou = $codArtFou;

        return $this;
    }
  

    // /**
    //  * Get ajout zone pour le formulaire de création
    //  */ 
    // public function getCodArtForm()
    // {
    //     return $this->codArtForm;
    // }

    // /**
    //  * Set ajout zone pour le formulaire de création
    //  *
    //  * @return  self
    //  */ 
    // public function setCodArtForm($codArtForm)
    // {
    //     $this->codArtForm = $codArtForm;

    //     return $this;
    // }

    /**
     * Get the value of codArtFrm
     */ 
    public function getCodArtFrm()
    {
        return $this->codArtFrm;
    }

    /**
     * Set the value of codArtFrm
     *
     * @return  self
     */ 
    public function setCodArtFrm($codArtFrm)
    {
        $this->codArtFrm = $codArtFrm;

        return $this;
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

    public function getQteMax(): ?int
    {
        return $this->qteMax;
    }

    public function setQteMax(int $qteMax): self
    {
        $this->qteMax = $qteMax;

        return $this;
    }

    // public function __toString(){
    //     return (string)$this->getId();
    // }
}
