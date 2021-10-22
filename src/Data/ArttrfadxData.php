<?php

namespace App\Data;

use App\Entity\Tsite;
use App\Entity\Tmrqice;
use App\Entity\Ttaxadx;
use App\Entity\Tsociete;
use App\Entity\Tcodctaadx;
use App\Entity\Tfamartadx;
use App\Entity\Ttabpstadx;
use App\Entity\Tfournisseur;
use Symfony\Component\Validator\Constraints as Assert;


class ArttrfadxData
{
    /**
     * @var string
     */
    private $cod = null;
    /**
     * @var string
     */
    private $refCtr = null;
    /**
     * @var string
     */
    private $codArtAncAdx;
    /**
     * @var Tmrqice
     */
    private $clrMrqIce = null;
    /**
     * @var string
     */
    private $libCrtFr = null;
    /**
     * @var string
     */
    private $codEan = null;
    /**
     * @var string
     * @Assert\NotBlank(message="La désignation est obligatoire")
     * @Assert\Length(min=5,max=30,minMessage="La désignation doit avoir au moins 5 caractères",maxMessage="La désignation Adonix ne doit pas dépasser 30 caractères."))
     */
    private $lib01Adx = null;
    /**
     * @var string
     */
    private $lib02Adx = null;
    /**
     * @var string
     */
    private $lib03Adx = null;
    /**
     * @var string
     */
    private $cleRchAdx = null;
    /**
     * @var string
     */
    private $nrmAdx = null;
    /**
     * @var float
     */
    private $pds = null;
    /**
     * @var string
     */
    private $pdsUnt = 'KG';
    /**
     * appartenace
     * @var Tsociete
     */
    private $clrApcAdx = null;
    /**
     * @var Tfamartadx
     */
    private $tfamartadx01 = null;
    /**
     * @var Tfamartadx
     */
    private $tfamartadx02 = null;
    /**
     * @var Tfamartadx
     */
    private $tfamartadx03 = null;
    /**
     * @var Tcodctaadx
     */
    private $tcodCtaadx = null;
    /**
     * @var Ttaxadx
     */
    private $ttaxadx = null;
    /**
     * @var string
     */
    private $modGstAdx = null;
    /**
     * @var Tsite
     */
    private $tsitStk01Adx = null;
    /**
     * @var Tsite
     */
    private $tsitStk02Adx = null;
    /**
     * @var Tsite
     */
    private $tsitPrpAdx = null;
    /**
     * @var Tfournisseur
     */
    private $tfou01 = null;
    /**
     * @var Tfournisseur
     */
    private $tfou02 = null;
    /**
     * @var Tfournisseur
     */
    private $tfou03;
    /**
     * @var Tfournisseur
     */
    private $tfou04 = null;
    /**
     * @var string
     */
    private $codEan01 = null;
    /**
     * @var string
     */
    private $codEan02 = null;
    /**
     * @var string
     */
    private $codEan03 = null;
    /**
     * @var string
     */
    private $codEan04 = null;
    /**
     * @var string
     */
    private $codArt01 = null;
    /**
     * @var string
     */
    private $codArt02 = null;
    /**
     * @var string
     */
    private $codArt03 = null;
    /**
     * @var string
     */
    private $codArt04 = null;
    /**
     * @var integer
     */
    private $prtFou01 = null;
    /**
     * @var integer
     */
    private $prtFou02 = null;
    /**
     * @var integer
     */
    private $prtFou03 = null;
    /**
     * @var integer
     */
    private $prtFou04 = null;
    /**
     * @var bool
     */
    private $xCntmrq01 = false;
    /**
     * @var bool
     */
    private $xCntmrq02 = false;
    /**
     * @var bool
     */
    private $xCntmrq03 = false;
    /**
     * @var bool
     */
    private $xCntmrq04 = false;
    /**
     * @var float
     */
    private $prxBasAdx = null;
    /**
     * @var float
     */
    private $mrgMinAdx = null;
    /**
     * @var string
     */
    private $ctgAdx = null;
    /**
     * @var Ttabpstadx
     */
    private $clrAhrAdx = null;
    /**
     * @var bool
     */
    private $xGstEmpAdx;
    /**
     * @var string
     */
    private $modReaAdx;
    /**
     * @var string
     */
    private $typSugAdx;
    /**
     * @var int
     */
    private $seiReaAdx;

    public function __construct()
    {
        $this->xGstEmpAdx = 1;
        $this->seiReaAdx = 2;
        $this->pdsUnt = 'KG';
    }

    /**
     * Get the value of cod
     *
     * @return  string
     */
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * Set the value of cod
     *
     * @param  string  $cod
     *
     * @return  self
     */
    public function setCod(string $cod)
    {
        $this->cod = $cod;

        return $this;
    }

    /**
     * Get the value of refCtr
     *
     * @return  string
     */
    public function getRefCtr()
    {
        return $this->refCtr;
    }

    /**
     * Set the value of refCtr
     *
     * @param  string  $refCtr
     *
     * @return  self
     */
    public function setRefCtr(string $refCtr)
    {
        $this->refCtr = $refCtr;

        return $this;
    }

    /**
     * Get the value of libCrtFr
     *
     * @return  string
     */
    public function getLibCrtFr()
    {
        return $this->libCrtFr;
    }

    /**
     * Set the value of libCrtFr
     *
     * @param  string  $libCrtFr
     *
     * @return  self
     */
    public function setLibCrtFr(string $libCrtFr)
    {
        $this->libCrtFr = $libCrtFr;

        return $this;
    }

    /**
     * Get the value of codEan
     *
     * @return  string
     */
    public function getCodEan()
    {
        return $this->codEan;
    }

    /**
     * Set the value of codEan
     *
     * @param  string  $codEan
     *
     * @return  self
     */
    public function setCodEan(string $codEan)
    {
        $this->codEan = $codEan;

        return $this;
    }

    /**
     * Get the value of lib01Adx
     *
     * @return  string
     */
    public function getLib01Adx()
    {
        return $this->lib01Adx;
    }

    /**
     * Set the value of lib01Adx
     *
     * @param  string  $lib01Adx
     *
     * @return  self
     */
    public function setLib01Adx(string $lib01Adx)
    {
        $this->lib01Adx = $lib01Adx;

        return $this;
    }

    /**
     * Get the value of lib02Adx
     *
     * @return  string
     */
    public function getLib02Adx()
    {
        return $this->lib02Adx;
    }

    /**
     * Set the value of lib02Adx
     *
     * @param  string  $lib02Adx
     *
     * @return  self
     */
    public function setLib02Adx(string $lib02Adx)
    {
        $this->lib02Adx = $lib02Adx;

        return $this;
    }



    /**
     * Get the value of modGstAdx
     *
     * @return  string
     */
    public function getModGstAdx()
    {
        return $this->modGstAdx;
    }

    /**
     * Set the value of modGstAdx
     *
     * @param  string  $modGstAdx
     *
     * @return  self
     */
    public function setModGstAdx(string $modGstAdx)
    {
        $this->modGstAdx = $modGstAdx;

        return $this;
    }



    /**
     * Get the value of codEan01
     *
     * @return  string
     */
    public function getCodEan01()
    {
        return $this->codEan01;
    }

    /**
     * Set the value of codEan01
     *
     * @param  string  $codEan01
     *
     * @return  self
     */
    public function setCodEan01(string $codEan01)
    {
        $this->codEan01 = $codEan01;

        return $this;
    }

    /**
     * Get the value of codEan02
     *
     * @return  string
     */
    public function getCodEan02()
    {
        return $this->codEan02;
    }

    /**
     * Set the value of codEan02
     *
     * @param  string  $codEan02
     *
     * @return  self
     */
    public function setCodEan02(string $codEan02)
    {
        $this->codEan02 = $codEan02;

        return $this;
    }

    /**
     * Get the value of codEan03
     *
     * @return  string
     */
    public function getCodEan03()
    {
        return $this->codEan03;
    }

    /**
     * Set the value of codEan03
     *
     * @param  string  $codEan03
     *
     * @return  self
     */
    public function setCodEan03(string $codEan03)
    {
        $this->codEan03 = $codEan03;

        return $this;
    }

    /**
     * Get the value of codEan04
     *
     * @return  string
     */
    public function getCodEan04()
    {
        return $this->codEan04;
    }

    /**
     * Set the value of codEan04
     *
     * @param  string  $codEan04
     *
     * @return  self
     */
    public function setCodEan04(string $codEan04)
    {
        $this->codEan04 = $codEan04;

        return $this;
    }


    /**
     * Get the value of clrMrqIce
     *
     * @return  Tmrqice
     */
    public function getClrMrqIce()
    {
        return $this->clrMrqIce;
    }

    /**
     * Set the value of clrMmrqIce
     *
     * @param  Tmrqice  $tmrqIce
     *
     * @return  self
     */
    public function setClrMrqIce(Tmrqice $clrMrqIce)
    {
        $this->clrMrqIce = $clrMrqIce;

        return $this;
    }

    /**
     * Get the value of codArtAncAdx
     *
     * @return  string
     */
    public function getCodArtAncAdx()
    {
        return $this->codArtAncAdx;
    }

    /**
     * Set the value of codArtAncAdx
     *
     * @param  string  $codArtAncAdx
     *
     * @return  self
     */
    public function setCodArtAncAdx(string $codArtAncAdx)
    {
        $this->codArtAncAdx = $codArtAncAdx;

        return $this;
    }


    /**
     * Get the value of prtFou02
     *
     * @return  integer
     */
    public function getPrtFou02()
    {
        return $this->prtFou02;
    }

    /**
     * Set the value of prtFou02
     *
     * @param  integer  $prtFou02
     *
     * @return  self
     */
    public function setPrtFou02($prtFou02)
    {
        $this->prtFou02 = $prtFou02;

        return $this;
    }

    /**
     * Get the value of prtFou03
     *
     * @return  integer
     */
    public function getPrtFou03()
    {
        return $this->prtFou03;
    }

    /**
     * Set the value of prtFou03
     *
     * @param  integer  $prtFou03
     *
     * @return  self
     */
    public function setPrtFou03($prtFou03)
    {
        $this->prtFou03 = $prtFou03;

        return $this;
    }

    /**
     * Get the value of prtFou04
     *
     * @return  integer
     */
    public function getPrtFou04()
    {
        return $this->prtFou04;
    }

    /**
     * Set the value of prtFou04
     *
     * @param  integer  $prtFou04
     *
     * @return  self
     */
    public function setPrtFou04($prtFou04)
    {
        $this->prtFou04 = $prtFou04;

        return $this;
    }


    /**
     * Get the value of tfamniv2Adx
     *
     * @return  Tfamartadx
     */
    public function getTfamniv2Adx()
    {
        return $this->tfamniv2Adx;
    }

    /**
     * Set the value of tfamniv2Adx
     *
     * @param  Tfamartadx  $tfamniv2Adx
     *
     * @return  self
     */
    public function setTfamniv2Adx(Tfamartadx $tfamniv2Adx)
    {
        $this->tfamniv2Adx = $tfamniv2Adx;

        return $this;
    }

    /**
     * Get the value of tfamniv3Adx
     *
     * @return  Tfamartadx
     */
    public function getTfamniv3Adx()
    {
        return $this->tfamniv3Adx;
    }

    /**
     * Set the value of tfamniv3Adx
     *
     * @param  Tfamartadx  $tfamniv3Adx
     *
     * @return  self
     */
    public function setTfamniv3Adx(Tfamartadx $tfamniv3Adx)
    {
        $this->tfamniv3Adx = $tfamniv3Adx;

        return $this;
    }

    /**
     * Get the value of tfamartadx01
     *
     * @return  Tfamartadx
     */
    public function getTfamartadx01()
    {
        return $this->tfamartadx01;
    }

    /**
     * Set the value of tfamartadx01
     *
     * @param  Tfamartadx  $tfamartadx01
     *
     * @return  self
     */
    public function setTfamartadx01(Tfamartadx $tfamartadx01)
    {
        $this->tfamartadx01 = $tfamartadx01;

        return $this;
    }

    /**
     * Get the value of tfamartadx02
     *
     * @return  Tfamartadx
     */
    public function getTfamartadx02()
    {
        return $this->tfamartadx02;
    }

    /**
     * Set the value of tfamartadx02
     *
     * @param  Tfamartadx  $tfamartadx02
     *
     * @return  self
     */
    public function setTfamartadx02($tfamartadx02)
    {
        $this->tfamartadx02 = $tfamartadx02;

        return $this;
    }


    /**
     * Get the value of ttaxadx
     *
     * @return  Ttaxadx
     */
    public function getTtaxadx()
    {
        return $this->ttaxadx;
    }

    /**
     * Set the value of ttaxadx
     *
     * @param  Ttaxadx  $ttaxadx
     *
     * @return  self
     */
    public function setTtaxadx(Ttaxadx $ttaxadx)
    {
        $this->ttaxadx = $ttaxadx;

        return $this;
    }

    /**
     * Get the value of tsitStk01Adx
     *
     * @return  Tsite
     */
    public function getTsitStk01Adx()
    {
        return $this->tsitStk01Adx;
    }

    /**
     * Set the value of tsitStk01Adx
     *
     * @param  Tsite  $tsitStk01Adx
     *
     * @return  self
     */
    public function setTsitStk01Adx(Tsite $tsitStk01Adx)
    {
        $this->tsitStk01Adx = $tsitStk01Adx;

        return $this;
    }

    /**
     * Get the value of tsitStk02Adx
     *
     * @return  Tsite
     */
    public function getTsitStk02Adx()
    {
        return $this->tsitStk02Adx;
    }

    /**
     * Set the value of tsitStk02Adx
     *
     * @param  Tsite  $tsitStk02Adx
     *
     * @return  self
     */
    public function setTsitStk02Adx(Tsite $tsitStk02Adx)
    {
        $this->tsitStk02Adx = $tsitStk02Adx;

        return $this;
    }

    /**
     * Get the value of tsitPrpAdx
     *
     * @return  Tsite
     */
    public function getTsitPrpAdx()
    {
        return $this->tsitPrpAdx;
    }

    /**
     * Set the value of tsitPrpAdx
     *
     * @param  Tsite  $tsitPrpAdx
     *
     * @return  self
     */
    public function setTsitPrpAdx(Tsite $tsitPrpAdx)
    {
        $this->tsitPrpAdx = $tsitPrpAdx;

        return $this;
    }


    /**
     * Get the value of tcodCtaadx
     *
     * @return  Tcodctaadx
     */
    public function getTcodCtaadx()
    {
        return $this->tcodCtaadx;
    }

    /**
     * Set the value of tcodCtaadx
     *
     * @param  Tcodctaadx  $tcodCtaadx
     *
     * @return  self
     */
    public function setTcodCtaadx(Tcodctaadx $tcodCtaadx)
    {
        $this->tcodCtaadx = $tcodCtaadx;

        return $this;
    }

    /**
     * Get the value of tfamartadx03
     *
     * @return  Tfamartadx
     */
    public function getTfamartadx03()
    {
        return $this->tfamartadx03;
    }

    /**
     * Set the value of tfamartadx03
     *
     * @param  Tfamartadx  $tfamartadx03
     *
     * @return  self
     */
    public function setTfamartadx03(Tfamartadx $tfamartadx03)
    {
        $this->tfamartadx03 = $tfamartadx03;

        return $this;
    }

    /**
     * Get the value of tfou01
     *
     * @return  Tfournisseur
     */
    public function getTfou01()
    {
        return $this->tfou01;
    }

    /**
     * Set the value of tfou01
     *
     * @param  Tfournisseur  $tfou01
     *
     * @return  self
     */
    public function setTfou01(Tfournisseur $tfou01)
    {
        dump($tfou01);
        $this->tfou01 = $tfou01;

        return $this;
    }

    /**
     * Get the value of tfou02
     *
     * @return  Tfournisseur
     */
    public function getTfou02()
    {
        return $this->tfou02;
    }

    /**
     * Set the value of tfou02
     *
     * @param  Tfournisseur  $tfou02
     *
     * @return  self
     */
    public function setTfou02(?Tfournisseur $tfou02)
    {

        $this->tfou02 = $tfou02;

        return $this;
    }

    /**
     * Get the value of prtFou01
     *
     * @return  integer
     */
    public function getPrtFou01()
    {
        return $this->prtFou01;
    }

    /**
     * Set the value of prtFou01
     *
     * @param  integer  $prtFou01
     *
     * @return  self
     */
    public function setPrtFou01($prtFou01)
    {
        $this->prtFou01 = $prtFou01;

        return $this;
    }

    /**
     * Get the value of tfou03
     *
     * @return  Tfournisseur
     */
    public function getTfou03()
    {
        return $this->tfou03;
    }

    /**
     * Set the value of tfou03
     *
     * @param  Tfournisseur  $tfou03
     *
     * @return  self
     */
    public function setTfou03(?Tfournisseur $tfou03)
    {
        $this->tfou03 = $tfou03;

        return $this;
    }

    /**
     * Get the value of tfou04
     *
     * @return  Tfournisseur
     */
    public function getTfou04()
    {
        return $this->tfou04;
    }

    /**
     * Set the value of tfou04
     *
     * @param  Tfournisseur  $tfou04
     *
     * @return  self
     */
    public function setTfou04(?Tfournisseur $tfou04)
    {
        $this->tfou04 = $tfou04;

        return $this;
    }

    /**
     * Get the value of pds
     *
     * @return  float
     */
    public function getPds()
    {
        return $this->pds;
    }

    /**
     * Set the value of pds
     *
     * @param  float  $pds
     *
     * @return  self
     */
    public function setPds(float $pds)
    {
        $this->pds = $pds;

        return $this;
    }

    /**
     * Get the value of pdsUnt
     *
     * @return  string
     */
    public function getPdsUnt()
    {
        return $this->pdsUnt;
    }

    /**
     * Set the value of pdsUnt
     *
     * @param  string  $pdsUnt
     *
     * @return  self
     */
    public function setPdsUnt(string $pdsUnt)
    {
        $this->pdsUnt = $pdsUnt;

        return $this;
    }

    /**
     * Get the value of prxBasAdx
     *
     * @return  float
     */
    public function getPrxBasAdx()
    {
        return $this->prxBasAdx;
    }

    /**
     * Set the value of prxBasAdx
     *
     * @param  float  $prxBasAdx
     *
     * @return  self
     */
    public function setPrxBasAdx(float $prxBasAdx)
    {
        $this->prxBasAdx = $prxBasAdx;

        return $this;
    }


    /**
     * Get the value of mrgMinAdx
     *
     * @return  float
     */
    public function getMrgMinAdx()
    {
        return $this->mrgMinAdx;
    }

    /**
     * Set the value of mrgMinAdx
     *
     * @param  float  $mrgMinAdx
     *
     * @return  self
     */
    public function setMrgMinAdx(float $mrgMinAdx)
    {
        $this->mrgMinAdx = $mrgMinAdx;

        return $this;
    }

    /**
     * Get the value of ctgAdx
     *
     * @return  string
     */
    public function getCtgAdx()
    {
        return $this->ctgAdx;
    }

    /**
     * Set the value of ctgAdx
     *
     * @param  string  $ctgAdx
     *
     * @return  self
     */
    public function setCtgAdx(string $ctgAdx)
    {
        $this->ctgAdx = $ctgAdx;

        return $this;
    }

    /**
     * Get the value of clrAhrAdx
     *
     * @return  Ttabpstadx
     */
    public function getClrAhrAdx()
    {
        return $this->clrAhrAdx;
    }

    /**
     * Set the value of clrAhrAdx
     *
     * @param  Ttabpstadx  $clrAhrAdx
     *
     * @return  self
     */
    public function setClrAhrAdx(Ttabpstadx $clrAhrAdx)
    {
        $this->clrAhrAdx = $clrAhrAdx;

        return $this;
    }

    /**
     * Get the value of xGstEmpAdx
     *
     * @return  bool
     */
    public function getXGstEmpAdx()
    {
        return $this->xGstEmpAdx;
    }

    /**
     * Set the value of xGstEmpAdx
     *
     * @param  bool  $xGstEmpAdx
     *
     * @return  self
     */
    public function setXGstEmpAdx(bool $xGstEmpAdx)
    {
        $this->xGstEmpAdx = $xGstEmpAdx;

        return $this;
    }

    /**
     * Get appartenace
     *
     * @return  Tsociete
     */
    public function getClrApcAdx()
    {
        return $this->clrApcAdx;
    }

    /**
     * Set appartenace
     *
     * @param  Tsociete  $clrApcAdx  appartenace
     *
     * @return  self
     */
    public function setClrApcAdx(Tsociete $clrApcAdx)
    {
        $this->clrApcAdx = $clrApcAdx;

        return $this;
    }

    /**
     * Get the value of lib03Adx
     *
     * @return  string
     */
    public function getLib03Adx()
    {
        return $this->lib03Adx;
    }

    /**
     * Set the value of lib03Adx
     *
     * @param  string  $lib03Adx
     *
     * @return  self
     */
    public function setLib03Adx(?string $lib03Adx)
    {
        $this->lib03Adx = $lib03Adx;

        return $this;
    }

    /**
     * Get the value of cleRchAdx
     *
     * @return  string
     */
    public function getCleRchAdx()
    {
        return $this->cleRchAdx;
    }

    /**
     * Set the value of cleRchAdx
     *
     * @param  string  $cleRchAdx
     *
     * @return  self
     */
    public function setCleRchAdx(?string $cleRchAdx)
    {
        $this->cleRchAdx = $cleRchAdx;

        return $this;
    }

    /**
     * Get the value of nrmAdx
     *
     * @return  string
     */
    public function getNrmAdx()
    {
        return $this->nrmAdx;
    }



    /**
     * Set the value of nrmAdx
     *
     * @param  string  $nrmAdx
     *
     * @return  self
     */
    public function setNrmAdx(?string $nrmAdx)
    {
        $this->nrmAdx = $nrmAdx;

        return $this;
    }

    /**
     * Get the value of codArt01
     *
     * @return  string
     */
    public function getCodArt01()
    {
        return $this->codArt01;
    }

    /**
     * Set the value of codArt01
     *
     * @param  string  $codArt01
     *
     * @return  self
     */
    public function setCodArt01(?string $codArt01)
    {
        $this->codArt01 = $codArt01;

        return $this;
    }

    /**
     * Get the value of codArt02
     *
     * @return  string
     */
    public function getCodArt02()
    {
        return $this->codArt02;
    }

    /**
     * Set the value of codArt02
     *
     * @param  string  $codArt02
     *
     * @return  self
     */
    public function setCodArt02(?string $codArt02)
    {
        $this->codArt02 = $codArt02;

        return $this;
    }

    /**
     * Get the value of codArt03
     *
     * @return  string
     */
    public function getCodArt03()
    {
        return $this->codArt03;
    }

    /**
     * Set the value of codArt03
     *
     * @param  string  $codArt03
     *
     * @return  self
     */
    public function setCodArt03(?string $codArt03)
    {
        $this->codArt03 = $codArt03;

        return $this;
    }

    /**
     * Get the value of codArt04
     *
     * @return  string
     */
    public function getCodArt04()
    {
        return $this->codArt04;
    }

    /**
     * Set the value of codArt04
     *
     * @param  string  $codArt04
     *
     * @return  self
     */
    public function setCodArt04(?string $codArt04)
    {
        $this->codArt04 = $codArt04;

        return $this;
    }

    /**
     * Get the value of xCntmrq01
     *
     * @return  boolean
     */
    public function getXCntmrq01()
    {
        return $this->xCntmrq01;
    }

    /**
     * Set the value of xCntmrq01
     *
     * @param  bool  $xCntmrq01
     *
     * @return  self
     */
    public function setXCntmrq01(?bool $xCntmrq01)
    {
        $this->xCntmrq01 = $xCntmrq01;

        return $this;
    }

    /**
     * Get the value of xCntmrq02
     *
     * @return  bool
     */
    public function getXCntmrq02()
    {
        return $this->xCntmrq02;
    }

    /**
     * Set the value of xCntmrq02
     *
     * @param  bool  $xCntmrq02
     *
     * @return  self
     */
    public function setXCntmrq02(?bool $xCntmrq02)
    {
        $this->xCntmrq02 = $xCntmrq02;

        return $this;
    }

    /**
     * Get the value of xCntmrq03
     *
     * @return  bool
     */
    public function getXCntmrq03()
    {
        return $this->xCntmrq03;
    }

    /**
     * Set the value of xCntmrq03
     *
     * @param  bool  $xCntmrq03
     *
     * @return  self
     */
    public function setXCntmrq03(?bool $xCntmrq03)
    {
        $this->xCntmrq03 = $xCntmrq03;

        return $this;
    }

    /**
     * Get the value of xCntmrq04
     *
     * @return  bool
     */
    public function getXCntmrq04()
    {
        return $this->xCntmrq04;
    }

    /**
     * Set the value of xCntmrq04
     *
     * @param  bool  $xCntmrq04
     *
     * @return  self
     */
    public function setXCntmrq04(?bool $xCntmrq04)
    {
        $this->xCntmrq04 = $xCntmrq04;

        return $this;
    }

    /**
     * Get the value of modReaAdx
     *
     * @return  string
     */
    public function getModReaAdx()
    {
        return $this->modReaAdx;
    }

    /**
     * Set the value of modReaAdx
     *
     * @param  string  $modReaAdx
     *
     * @return  self
     */
    public function setModReaAdx(?string $modReaAdx)
    {
        $this->modReaAdx = $modReaAdx;

        return $this;
    }

    /**
     * Get the value of typSugAdx
     *
     * @return  string
     */
    public function getTypSugAdx()
    {
        return $this->typSugAdx;
    }

    /**
     * Set the value of typSugAdx
     *
     * @param  string  $typSugAdx
     *
     * @return  self
     */
    public function setTypSugAdx(?string $typSugAdx)
    {
        $this->typSugAdx = $typSugAdx;

        return $this;
    }

    /**
     * Get the value of seiReaAdx
     *
     * @return  integer
     */
    public function getSeiReaAdx()
    {
        return $this->seiReaAdx;
    }

    /**
     * Set the value of seiReaAdx
     *
     * @param  int  $seiReaAdx
     *
     * @return  self
     */
    public function setSeiReaAdx(?int $seiReaAdx)
    {
        $this->seiReaAdx = $seiReaAdx;

        return $this;
    }
}
