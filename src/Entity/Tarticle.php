<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TarticleRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * @ORM\Entity(repositoryClass=TarticleRepository::class)
 * @ORM\Table(indexes={@ORM\Index(columns={"cod"})})
 * @ORM\Table(indexes={@ORM\Index(columns={"ref_ctr"})})
 * @Vich\Uploadable
 */
class Tarticle
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
     * @ORM\Column(type="string", length=255)
     */
    private $libCrtFr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $libLngFr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libCrtEn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $libLngEn;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $codEan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pds;

    /**
     * @ORM\Column(type="string", length=10,nullable=true)
     */
    private $pdsUnt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vlm;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $vlmUnt;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cpc;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $cpcUnt;



    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datDebAct;


    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $refAdx;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $refCtr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lib01Adx;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lnkFchCtr;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datFinAct;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datIns;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usrIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrUpd;

    /**
     * @ORM\ManyToOne(targetEntity=Tconstructeur::class, inversedBy="tarticles")
     */
    private $clrCtr;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xAdx;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datAdxIns;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xSitWeb01;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datSitWeb01Ins;

    /**
     * @ORM\ManyToOne(targetEntity=Tcategorie::class, inversedBy="tarticles")
     */
    private $clrCtg;

    /**
     * @ORM\Column(type="boolean")
     */
    private $xAct;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $lib02Adx;

    /**
     * @ORM\OneToMany(targetEntity=Tartfou::class, mappedBy="clrArt")
     */
    private $tartfous;

    /**
     * @ORM\OneToMany(targetEntity=Tprxach::class, mappedBy="clpArt")
     */
    private $tprxaches;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $dms;

    /**
     * @ORM\OneToMany(targetEntity=Tgritar::class, mappedBy="ClrArtId")
     */
    private $tgritars;

    /**
     * @ORM\OneToMany(targetEntity=Tartcot::class, mappedBy="clrArt")
     */
    private $tartcots;

    /**
     * @ORM\OneToMany(targetEntity=Tgritarpst::class, mappedBy="clrArt")
     */
    private $tgritarpsts;

    /**
     * @ORM\OneToMany(targetEntity=Tartcpd::class, mappedBy="clrArtaas")
     */
    private $tartcpds;

    /**
     * @ORM\ManyToOne(targetEntity=Tctgicearb::class, inversedBy="tarticles")
     */
    private $clrCtgice;

    /**
     * @ORM\ManyToOne(targetEntity=Tmrqice::class, inversedBy="tarticles")
     */
    private $clrMrqice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;
    /**
     * @var string|null
     * @ORM\Column(type="string",length=255, nullable=true) 
     */
    private $ficImg2;

    // 
    /**
     * @var File|null
     * @Vich\UploadableField(mapping="article_photo",fileNameProperty="ficImg2")
     */
    private $img2;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $chpTrv;

    /**
     * @ORM\OneToMany(targetEntity=Tarttrfadx::class, mappedBy="clrArt")
     */
    private $tarttrfadxes;

    /**
     * @ORM\ManyToOne(targetEntity=Tsite::class)
     */
    private $clrSitStk01Adx;

    /**
     * @ORM\ManyToOne(targetEntity=Tsite::class)
     */
    private $clrSitStk02Adx;

    /**
     * @ORM\ManyToOne(targetEntity=Tsociete::class)
     */
    private $clrApcAdx;

    /**
     * @ORM\ManyToOne(targetEntity=Tfamartadx::class, inversedBy="tarticles")
     */
    private $clrFamniv1Adx;

    /**
     * @ORM\ManyToOne(targetEntity=Tfamartadx::class)
     */
    private $clrFamniv2Adx;

    /**
     * @ORM\ManyToOne(targetEntity=Tfamartadx::class)
     */
    private $clrFamniv3Adx;

    /**
     * @ORM\ManyToOne(targetEntity=Tsite::class)
     */
    private $clrSitPrpAdx;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $modGstAdx;

    /**
     * @ORM\ManyToOne(targetEntity=Tcodctaadx::class)
     */
    private $clrCodCtaAdx;

    /**
     * @ORM\ManyToOne(targetEntity=Ttaxadx::class)
     */
    private $clrNivTaxAdx;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $codArtAncAdx;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prxBasAdx;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mrgMinAdx;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $ctgAdx;

    /**
     * @ORM\ManyToOne(targetEntity=Ttabpstadx::class)
     */
    private $clrAhrAdx;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xGstEmpAdx;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lib03Adx;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cleRchAdx;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $nrmAdx;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $modReaAdx;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $typSugAdx;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $seiReaAdx;

    /**
     * @ORM\OneToMany(targetEntity=Tarttrfsitweb::class, mappedBy="clrArt")
     */
    private $tarttrfsitwebs;
    /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class, inversedBy="tarticles")
     */
    private $clrCtgiceniv1;
   /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class, inversedBy="tarticles")
     */
    private $clrCtgiceniv2;    
       /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class, inversedBy="tarticles")
     */
    private $clrCtgiceniv3;
   /**
     * @ORM\ManyToOne(targetEntity=Tctgiceniv::class, inversedBy="tarticles")
     */
    private $clrCtgiceniv4;

    /**
     * @ORM\OneToMany(targetEntity=Timage::class, mappedBy="articles", cascade={"persist"})
     */
    private $timages;    
    public function __construct()
    {
        $this->tartfous = new ArrayCollection();
        $this->tprxaches = new ArrayCollection();
        $this->tgritaretts = new ArrayCollection();
        $this->tartcots = new ArrayCollection();
        $this->tgritarpsts = new ArrayCollection();
        $this->tartcpds = new ArrayCollection();
        $this->tarttrfadxes = new ArrayCollection();
        $this->tarttrfsitwebs = new ArrayCollection();
        $this->timages = new ArrayCollection();
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

    public function getLibCrtFr(): ?string
    {
        return $this->libCrtFr;
    }

    public function setLibCrtFr(string $libCrtFr): self
    {
        $this->libCrtFr = $libCrtFr;

        return $this;
    }

    public function getLibLngFr(): ?string
    {
        return $this->libLngFr;
    }

    public function setLibLngFr(?string $libLngFr): self
    {
        $this->libLngFr = $libLngFr;

        return $this;
    }

    public function getLibCrtEn(): ?string
    {
        return $this->libCrtEn;
    }

    public function setLibCrtEn(?string $libCrtEn): self
    {
        $this->libCrtEn = $libCrtEn;

        return $this;
    }

    public function getLibLngEn(): ?string
    {
        return $this->libLngEn;
    }

    public function setLibLngEn(?string $libLngEn): self
    {
        $this->libLngEn = $libLngEn;

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

    public function getPds(): ?float
    {
        return $this->pds;
    }

    public function setPds(?int $pds): self
    {
        $this->pds = $pds;

        return $this;
    }

    public function getPdsUnt(): ?string
    {
        return $this->pdsUnt;
    }

    public function setPdsUnt(string $pdsUnt): self
    {
        $this->pdsUnt = $pdsUnt;

        return $this;
    }

    public function getVlm(): ?float
    {
        return $this->vlm;
    }

    public function setVlm(?float $vlm): self
    {
        $this->vlm = $vlm;

        return $this;
    }

    public function getVlmUnt(): ?string
    {
        return $this->vlmUnt;
    }

    public function setVlmUnt(?string $vlmUnt): self
    {
        $this->vlmUnt = $vlmUnt;

        return $this;
    }

    public function getCpc(): ?string
    {
        return $this->cpc;
    }

    public function setCpc(?string $cpc): self
    {
        $this->cpc = $cpc;

        return $this;
    }

    public function getCpcUnt(): ?string
    {
        return $this->cpcUnt;
    }

    public function setCpcUnt(?string $cpcUnt): self
    {
        $this->cpcUnt = $cpcUnt;

        return $this;
    }


    public function getdatDebAct(): ?\DateTimeInterface
    {
        return $this->datDebAct;
    }

    public function setdatDebAct(?\DateTimeInterface $datDebAct): self
    {
        $this->datDebAct = $datDebAct;

        return $this;
    }


    public function getRefAdx(): ?string
    {
        return $this->refAdx;
    }

    public function setRefAdx(?string $refAdx): self
    {
        $this->refAdx = $refAdx;

        return $this;
    }

    public function getRefCtr(): ?string
    {
        return $this->refCtr;
    }

    public function setRefCtr(?string $refCtr): self
    {
        $this->refCtr = $refCtr;

        return $this;
    }

    public function getLib01Adx(): ?string
    {
        return $this->lib01Adx;
    }

    public function setLib01Adx(?string $lib01Adx): self
    {
        $this->lib01Adx = $lib01Adx;

        return $this;
    }

    public function getLnkFchCtr(): ?string
    {
        return $this->lnkFchCtr;
    }

    public function setLnkFchCtr(?string $lnkFchCtr): self
    {
        $this->lnkFchCtr = $lnkFchCtr;

        return $this;
    }


    public function getdatFinAct(): ?\DateTimeInterface
    {
        return $this->datFinAct;
    }

    public function setdatFinAct(?\DateTimeInterface $datFinAct): self
    {
        $this->datFinAct = $datFinAct;

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

    public function getDatUpd(): ?\DateTimeInterface
    {
        return $this->datUpd;
    }

    public function setDatUpd(?\DateTimeInterface $datUpd): self
    {
        $this->datUpd = $datUpd;

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

    public function getUsrUpd(): ?Tuser
    {
        return $this->usrUpd;
    }

    public function setUsrUpd(?Tuser $usrUpd): self
    {
        $this->usrUpd = $usrUpd;

        return $this;
    }

    public function getClrCtr(): ?Tconstructeur
    {
        return $this->clrCtr;
    }

    public function setClrCtr(?Tconstructeur $clrCtr): self
    {
        $this->clrCtr = $clrCtr;

        return $this;
    }

    public function getXAdx(): ?bool
    {
        return $this->xAdx;
    }

    public function setXAdx(?bool $xAdx): self
    {
        $this->xAdx = $xAdx;

        return $this;
    }

    public function getDatAdxIns(): ?\DateTimeInterface
    {
        return $this->datAdxIns;
    }

    public function setDatAdxIns(?\DateTimeInterface $datAdxIns): self
    {
        $this->datAdxIns = $datAdxIns;

        return $this;
    }

    public function getxSitWeb01(): ?bool
    {
        return $this->xSitWeb01;
    }

    public function setxSitWeb01(?bool $xSitWeb01): self
    {
        $this->xSitWeb01 = $xSitWeb01;

        return $this;
    }

    public function getdatSitWeb01Ins(): ?\DateTimeInterface
    {
        return $this->datSitWeb01Ins;
    }

    public function setdatSitWeb01Ins(?\DateTimeInterface $datSitWeb01Ins): self
    {
        $this->datSitWeb01Ins = $datSitWeb01Ins;

        return $this;
    }

    public function getClrCtg(): ?Tcategorie
    {
        return $this->clrCtg;
    }

    public function setClrCtg(?Tcategorie $clrCtg): self
    {
        $this->clrCtg = $clrCtg;

        return $this;
    }

    public function getxAct(): ?bool
    {
        return $this->xAct;
    }

    public function setxAct(bool $xAct): self
    {
        $this->xAct = $xAct;

        return $this;
    }

    public function getLib02Adx(): ?string
    {
        return $this->lib02Adx;
    }

    public function setLib02Adx(string $lib02Adx): self
    {
        $this->lib02Adx = $lib02Adx;

        return $this;
    }

    /**
     * @return Collection|Tartfou[]
     */
    public function getTartfous(): Collection
    {
        return $this->tartfous;
    }

    public function addTartfou(Tartfou $tartfou): self
    {
        if (!$this->tartfous->contains($tartfou)) {
            $this->tartfous[] = $tartfou;
            $tartfou->setClrArt($this);
        }

        return $this;
    }

    public function removeTartfou(Tartfou $tartfou): self
    {
        if ($this->tartfous->removeElement($tartfou)) {
            // set the owning side to null (unless already changed)
            if ($tartfou->getClrArt() === $this) {
                $tartfou->setClrArt(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tprxach[]
     */
    public function getTprxaches(): Collection
    {
        return $this->tprxaches;
    }

    public function addTprxach(Tprxach $tprxach): self
    {
        if (!$this->tprxaches->contains($tprxach)) {
            $this->tprxaches[] = $tprxach;
            $tprxach->setClpArt($this);
        }

        return $this;
    }

    public function removeTprxach(Tprxach $tprxach): self
    {
        if ($this->tprxaches->removeElement($tprxach)) {
            // set the owning side to null (unless already changed)
            if ($tprxach->getClpArt() === $this) {
                $tprxach->setClpArt(null);
            }
        }

        return $this;
    }

    public function getDms(): ?string
    {
        return $this->dms;
    }

    public function setDms(?string $dms): self
    {
        $this->dms = $dms;

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
            $tartcot->setClrArt($this);
        }

        return $this;
    }

    public function removeTartcot(Tartcot $tartcot): self
    {
        if ($this->tartcots->removeElement($tartcot)) {
            // set the owning side to null (unless already changed)
            if ($tartcot->getClrArt() === $this) {
                $tartcot->setClrArt(null);
            }
        }

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
            $tgritarpst->setClrArt($this);
        }

        return $this;
    }

    public function removeTgritarpst(Tgritarpst $tgritarpst): self
    {
        if ($this->tgritarpsts->removeElement($tgritarpst)) {
            // set the owning side to null (unless already changed)
            if ($tgritarpst->getClrArt() === $this) {
                $tgritarpst->setClrArt(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tartcpd[]
     */
    public function getTartcpds(): Collection
    {
        return $this->tartcpds;
    }

    public function addTartcpd(Tartcpd $tartcpd): self
    {
        if (!$this->tartcpds->contains($tartcpd)) {
            $this->tartcpds[] = $tartcpd;
            $tartcpd->setClrArtaas($this);
        }

        return $this;
    }

    public function removeTartcpd(Tartcpd $tartcpd): self
    {
        if ($this->tartcpds->removeElement($tartcpd)) {
            // set the owning side to null (unless already changed)
            if ($tartcpd->getClrArtaas() === $this) {
                $tartcpd->setClrArtaas(null);
            }
        }

        return $this;
    }

    public function getClrCtgice(): ?Tctgicearb
    {
        return $this->clrCtgice;
    }

    public function setClrCtgice(?Tctgicearb $clrCtgice): self
    {
        $this->clrCtgice = $clrCtgice;

        return $this;
    }

    public function getClrMrqice(): ?Tmrqice
    {
        return $this->clrMrqice;
    }

    public function setClrMrqice(?Tmrqice $clrMrqice): self
    {
        $this->clrMrqice = $clrMrqice;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {

        $this->img = $img;
        if ($this->img instanceof UploadedFile) {
            $this->datUpd = new \DateTime('now');
        }
        return $this;
    }
    public function __toString()
    {
        return $this->getCod();
    }

    public function getChpTrv(): ?string
    {
        return $this->chpTrv;
    }

    public function setChpTrv(?string $chpTrv): self
    {
        $this->chpTrv = $chpTrv;

        return $this;
    }


    /**
     * Get the value of img2
     *
     * @return  File|null
     */
    public function getImg2()
    {
        return $this->img2;
    }

    /**
     * Set the value of img2
     *
     * @param  File|null  $img2
     *
     * @return  self
     */
    public function setImg2($img2)
    {
        $this->img2 = $img2;
        if ($this->img2 instanceof UploadedFile) {
            $this->datUpd = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get the value of ficImg2
     *
     * @return  string|null
     */
    public function getFicImg2()
    {
        return $this->ficImg2;
    }

    /**
     * Set the value of ficImg2
     *
     * @param  string|null  $ficImg2
     *
     * @return  self
     */
    public function setFicImg2($ficImg2)
    {
        $this->ficImg2 = $ficImg2;

        return $this;
    }

    /**
     * @return Collection|Tarttrfadx[]
     */
    public function getTarttrfadxes(): Collection
    {
        return $this->tarttrfadxes;
    }

    public function addTarttrfadx(Tarttrfadx $tarttrfadx): self
    {
        if (!$this->tarttrfadxes->contains($tarttrfadx)) {
            $this->tarttrfadxes[] = $tarttrfadx;
            $tarttrfadx->setClrArt($this);
        }

        return $this;
    }

    public function removeTarttrfadx(Tarttrfadx $tarttrfadx): self
    {
        if ($this->tarttrfadxes->removeElement($tarttrfadx)) {
            // set the owning side to null (unless already changed)
            if ($tarttrfadx->getClrArt() === $this) {
                $tarttrfadx->setClrArt(null);
            }
        }

        return $this;
    }



    public function getClrSitStk01Adx(): ?Tsite
    {
        return $this->clrSitStk01Adx;
    }

    public function setClrSitStk01Adx(?Tsite $clrSitStk01Adx): self
    {
        $this->clrSitStk01Adx = $clrSitStk01Adx;

        return $this;
    }

    public function getClrSitStk02Adx(): ?Tsite
    {
        return $this->clrSitStk02Adx;
    }

    public function setClrSitStk02Adx(?Tsite $clrSitStk02Adx): self
    {
        $this->clrSitStk02Adx = $clrSitStk02Adx;

        return $this;
    }

    public function getClrApcAdx(): ?Tsociete
    {
        return $this->clrApcAdx;
    }

    public function setClrApcAdx(?Tsociete $clrApcAdx): self
    {
        $this->clrApcAdx = $clrApcAdx;

        return $this;
    }

    public function getClrFamniv1Adx(): ?Tfamartadx
    {
        return $this->clrFamniv1Adx;
    }

    public function setClrFamniv1Adx(?Tfamartadx $clrFamniv1Adx): self
    {
        $this->clrFamniv1Adx = $clrFamniv1Adx;

        return $this;
    }

    public function getClrFamniv2Adx(): ?Tfamartadx
    {
        return $this->clrFamniv2Adx;
    }

    public function setClrFamniv2Adx(?Tfamartadx $clrFamniv2Adx): self
    {
        $this->clrFamniv2Adx = $clrFamniv2Adx;

        return $this;
    }

    public function getClrFamniv3Adx(): ?Tfamartadx
    {
        return $this->clrFamniv3Adx;
    }

    public function setClrFamniv3Adx(?Tfamartadx $clrFamniv3Adx): self
    {
        $this->clrFamniv3Adx = $clrFamniv3Adx;

        return $this;
    }

    public function getClrSitPrpAdx(): ?Tsite
    {
        return $this->clrSitPrpAdx;
    }

    public function setClrSitPrpAdx(?Tsite $clrSitPrpAdx): self
    {
        $this->clrSitPrpAdx = $clrSitPrpAdx;

        return $this;
    }

    public function getModGstAdx(): ?string
    {
        return $this->modGstAdx;
    }

    public function setModGstAdx(?string $modGstAdx): self
    {
        $this->modGstAdx = $modGstAdx;

        return $this;
    }

    public function getClrCodCtaAdx(): ?Tcodctaadx
    {
        return $this->clrCodCtaAdx;
    }

    public function setClrCodCtaAdx(?Tcodctaadx $clrCodCtaAdx): self
    {
        $this->clrCodCtaAdx = $clrCodCtaAdx;

        return $this;
    }

    public function getClrNivTaxAdx(): ?Ttaxadx
    {
        return $this->clrNivTaxAdx;
    }

    public function setClrNivTaxAdx(?Ttaxadx $clrNivTaxAdx): self
    {
        $this->clrNivTaxAdx = $clrNivTaxAdx;

        return $this;
    }

    public function getCodArtAncAdx(): ?string
    {
        return $this->codArtAncAdx;
    }

    public function setCodArtAncAdx(?string $codArtAncAdx): self
    {
        $this->codArtAncAdx = $codArtAncAdx;

        return $this;
    }

    public function getPrxBasAdx(): ?float
    {
        return $this->prxBasAdx;
    }

    public function setPrxBasAdx(?float $prxBasAdx): self
    {
        $this->prxBasAdx = $prxBasAdx;

        return $this;
    }

    public function getMrgMinAdx(): ?float
    {
        return $this->mrgMinAdx;
    }

    public function setMrgMinAdx(?float $mrgMinAdx): self
    {
        $this->mrgMinAdx = $mrgMinAdx;

        return $this;
    }

    public function getCtgAdx(): ?string
    {
        return $this->ctgAdx;
    }

    public function setCtgAdx(?string $ctgAdx): self
    {
        $this->ctgAdx = $ctgAdx;

        return $this;
    }

    public function getClrAhrAdx(): ?Ttabpstadx
    {
        return $this->clrAhrAdx;
    }

    public function setClrAhrAdx(?Ttabpstadx $clrAhrAdx): self
    {
        $this->clrAhrAdx = $clrAhrAdx;

        return $this;
    }

    public function getXGstEmpAdx(): ?bool
    {
        return $this->xGstEmpAdx;
    }

    public function setXGstEmpAdx(?bool $xGstEmpAdx): self
    {
        $this->xGstEmpAdx = $xGstEmpAdx;

        return $this;
    }

    public function getLib03Adx(): ?string
    {
        return $this->lib03Adx;
    }

    public function setLib03Adx(?string $lib03Adx): self
    {
        $this->lib03Adx = $lib03Adx;

        return $this;
    }

    public function getCleRchAdx(): ?string
    {
        return $this->cleRchAdx;
    }

    public function setCleRchAdx(?string $cleRchAdx): self
    {
        $this->cleRchAdx = $cleRchAdx;

        return $this;
    }

    public function getNrmAdx(): ?string
    {
        return $this->nrmAdx;
    }

    public function setNrmAdx(?string $nrmAdx): self
    {
        $this->nrmAdx = $nrmAdx;

        return $this;
    }

    public function getModReaAdx(): ?string
    {
        return $this->modReaAdx;
    }

    public function setModReaAdx(?string $modReaAdx): self
    {
        $this->modReaAdx = $modReaAdx;

        return $this;
    }

    public function getTypSugAdx(): ?string
    {
        return $this->typSugAdx;
    }

    public function setTypSugAdx(?string $typSugAdx): self
    {
        $this->typSugAdx = $typSugAdx;

        return $this;
    }

    public function getSeiReaAdx(): ?string
    {
        return $this->seiReaAdx;
    }

    public function setSeiReaAdx(?string $seiReaAdx): self
    {
        $this->seiReaAdx = $seiReaAdx;

        return $this;
    }

    /**
     * @return Collection|Tarttrfsitweb[]
     */
    public function getTarttrfsitwebs(): Collection
    {
        return $this->tarttrfsitwebs;
    }

    public function addTarttrfsitweb(Tarttrfsitweb $tarttrfsitweb): self
    {
        if (!$this->tarttrfsitwebs->contains($tarttrfsitweb)) {
            $this->tarttrfsitwebs[] = $tarttrfsitweb;
            $tarttrfsitweb->setClrArt($this);
        }

        return $this;
    }

    public function removeTarttrfsitweb(Tarttrfsitweb $tarttrfsitweb): self
    {
        if ($this->tarttrfsitwebs->removeElement($tarttrfsitweb)) {
            // set the owning side to null (unless already changed)
            if ($tarttrfsitweb->getClrArt() === $this) {
                $tarttrfsitweb->setClrArt(null);
            }
        }

        return $this;
    }

    

  

    /**
     * Get the value of clrCtgiceniv1
     */ 
    public function getClrCtgiceniv1()
    {
        return $this->clrCtgiceniv1;
    }

    /**
     * Set the value of clrCtgiceniv1
     *
     * @return  self
     */ 
    public function setClrCtgiceniv1($clrCtgiceniv1)
    {
        $this->clrCtgiceniv1 = $clrCtgiceniv1;

        return $this;
    }

    /**
     * Get the value of clrCtgiceniv2
     */ 
    public function getClrCtgiceniv2()
    {
        return $this->clrCtgiceniv2;
    }

    /**
     * Set the value of clrCtgiceniv2
     *
     * @return  self
     */ 
    public function setClrCtgiceniv2($clrCtgiceniv2)
    {
        $this->clrCtgiceniv2 = $clrCtgiceniv2;

        return $this;
    }

    /**
     * Get the value of clrCtgiceniv3
     */ 
    public function getClrCtgiceniv3()
    {
        return $this->clrCtgiceniv3;
    }

    /**
     * Set the value of clrCtgiceniv3
     *
     * @return  self
     */ 
    public function setClrCtgiceniv3($clrCtgiceniv3)
    {
        $this->clrCtgiceniv3 = $clrCtgiceniv3;

        return $this;
    }

    /**
     * Get the value of clrCtgiceniv4
     */ 
    public function getClrCtgiceniv4()
    {
        return $this->clrCtgiceniv4;
    }

    /**
     * Set the value of clrCtgiceniv4
     *
     * @return  self
     */ 
    public function setClrCtgiceniv4($clrCtgiceniv4)
    {
        $this->clrCtgiceniv4 = $clrCtgiceniv4;

        return $this;
    }

    /**
     * @return Collection|Timage[]
     */
    public function getTimages(): Collection
    {
        return $this->timages;
    }

    public function addTimage(Timage $timage): self
    {
        if (!$this->timages->contains($timage)) {
            $this->timages[] = $timage;
            $timage->setArticles($this);
        }

        return $this;
    }

    public function removeTimage(Timage $timage): self
    {
        if ($this->timages->removeElement($timage)) {
            // set the owning side to null (unless already changed)
            if ($timage->getArticles() === $this) {
                $timage->setArticles(null);
            }
        }

        return $this;
    }
}
