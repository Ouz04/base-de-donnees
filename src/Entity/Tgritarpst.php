<?php

namespace App\Entity;

use App\Repository\TgritarpstRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TgritarpstRepository::class)
 */
class Tgritarpst
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="tgritarpsts")
     */
    private $clrArt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libArt;

    /**
     * @ORM\Column(type="float")
     */
    private $prxAch;

    /**
     * @ORM\Column(type="float")
     */
    private $prxVte;

    /**
     * @ORM\Column(type="float")
     */
    private $prxTxe;

    /**
     * @ORM\Column(type="float")
     */
    private $prxTxs;

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
     * @ORM\ManyToOne(targetEntity=Tgritarett::class, inversedBy="tgritarpsts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clrGta;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $codArt;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $codCot;


    /**
     * @ORM\Column(type="boolean")
     */
    private $xBpu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xDvs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmt;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $codArtCli;

    /**
     * @ORM\ManyToOne(targetEntity=Tcotorg::class, inversedBy="tgritarpsts")
     */
    private $clrCotorg;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $txMrg;

    /**
     * @ORM\ManyToOne(targetEntity=Tartfou::class, inversedBy="tgritarpsts")
     */
    private $clrArtfou;
    /**
     * @var string
     */
    private $codArtFrm;
        /**
     * @var string
     */
    private $codCliFrm;
    
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

    public function getLibArt(): ?string
    {
        return $this->libArt;
    }

    public function setLibArt(string $libArt): self
    {
        $this->libArt = $libArt;

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

    public function getPrxVte(): ?float
    {
        return $this->prxVte;
    }

    public function setPrxVte(float $prxVte): self
    {
        $this->prxVte = $prxVte;

        return $this;
    }

    public function getPrxTxe(): ?float
    {
        return $this->prxTxe;
    }

    public function setPrxTxe(float $prxTxe): self
    {
        $this->prxTxe = $prxTxe;

        return $this;
    }

    public function getPrxTxs(): ?float
    {
        return $this->prxTxs;
    }

    public function setPrxTxs(float $prxTxs): self
    {
        $this->prxTxs = $prxTxs;

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

    public function getClrGta(): ?Tgritarett
    {
        return $this->clrGta;
    }

    public function setClrGta(?Tgritarett $clrGta): self
    {
        $this->clrGta = $clrGta;

        return $this;
    }

    public function getCodArt(): ?string
    {
        return $this->codArt;
    }

    public function setCodArt(string $codArt): self
    {
        $this->codArt = $codArt;

        return $this;
    }

    public function getCodCot(): ?string
    {
        return $this->codCot;
    }

    public function setCodCot(?string $codCot): self
    {
        $this->codCot = $codCot;

        return $this;
    }


    public function getXBpu(): ?bool
    {
        return $this->xBpu;
    }

    public function setXBpu(bool $xBpu): self
    {
        $this->xBpu = $xBpu;

        return $this;
    }

    public function getXDvs(): ?bool
    {
        return $this->xDvs;
    }

    public function setXDvs(bool $xDvs): self
    {
        $this->xDvs = $xDvs;

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

    public function getCodArtCli(): ?string
    {
        return $this->codArtCli;
    }

    public function setCodArtCli(?string $codArtCli): self
    {
        $this->codArtCli = $codArtCli;

        return $this;
    }

    public function getClrCotorg(): ?Tcotorg
    {
        return $this->clrCotorg;
    }

    public function setClrCotorg(?Tcotorg $clrCotorg): self
    {
        $this->clrCotorg = $clrCotorg;

        return $this;
    }

    public function getTxMrg(): ?string
    {
        return $this->txMrg;
    }

    public function setTxMrg(string $txMrg): self
    {
        $this->txMrg = $txMrg;

        return $this;
    }

    public function getClrArtfou(): ?Tartfou
    {
        return $this->clrArtfou;
    }

    public function setClrArtfou(?Tartfou $clrArtfou): self
    {
        $this->clrArtfou = $clrArtfou;

        return $this;
    }

    /**
     * Get the value of codArtFrm
     *
     * @return  string
     */ 
    public function getCodArtFrm()
    {
        return $this->codArtFrm;
    }

    /**
     * Set the value of codArtFrm
     *
     * @param  string  $codArtFrm
     *
     * @return  self
     */ 
    public function setCodArtFrm(string $codArtFrm)
    {
        $this->codArtFrm = $codArtFrm;

        return $this;
    }

    /**
     * Get the value of codCliFrm
     *
     * @return  string
     */ 
    public function getCodCliFrm()
    {
        return $this->codCliFrm;
    }

    /**
     * Set the value of codCliFrm
     *
     * @param  string  $codCliFrm
     *
     * @return  self
     */ 
    public function setCodCliFrm(string $codCliFrm)
    {
        $this->codCliFrm = $codCliFrm;

        return $this;
    }

    // public function __toString(){
    //     return (string)$this->getId();
    // }
}
