<?php

namespace App\Data;

use DateTimeInterface;
use App\Entity\Tmrqice;
use App\Entity\Tcategorie;
use App\Entity\Tctgiceniv;
use App\Repository\TcategorieRepository;
use App\Repository\TctgicearbRepository;

class SearchData
{
  /**
   * @var string
   */
  public $codArt = '';
  /**
   * @var string
   */
  public $lib = '';
  /**
   * @var string
   */
  public $tcategorie;
  /**
   * @var string
   */
  public $tmrqice;
  /**
   * @var Tctgiceniv
   */
  public $tctgice;
  /**
   * @var Tctgiceniv
   */
  public $tsctgice;
  /**
   * @var string
   */
  public $tssctgice;
  /**
   * @var string
   */
  public $ttypcpd;
  /**
   * @var string
   */
  public $tfournisseur;
  /**
   * @var string
   */
  public $niv;
  /**
   * @var string
   */
  public $ctgiceDsg;
  /**
   * @var string
   */
  public $mdlCod;
  /**
   * @var string
   */
  public $cotCod;
  /**
   * @var string
   */
  public $cotDsg;
  /**
   * @var string
   */
  public $torganisation;
  /**
   * @var string
   */
  public $tclient;
  /**
   * @var string
   */

  public $orgCod;
  /**
   * @var string
   */
  public $orgNom;
  /**
   * @var string
   */
  /**
   * @var string
   */
  public $cliCod;
  /**
   * @var string
   */
  public $cliNom;
  /**
   * @var string
   */
  public $tcotation;
  /**
   * @var DateTimeInterface
   */
  public $datIns;
  /**
   * @var string
   */
  public $usrInsEmail;
  /**
   * @var string
   */
  public $srvDsg;
  /**
   * @var double
   */
  public $prxAch;
  /**
   * @var string
   */
  public $sigDat;
  /**
   * @var boolean
   */
  public $xAct;
  /**
   * @var string
   */
  public $ttypitgfic;
  /**
   * @var string
   */
  public $refCtr;
  /**
   * @var boolean
   */
  public $xAdx;
  /**
   * @var boolean
   */
  public $xSitWeb01;
  /**
   * @var string
   */
  public $tfamcli;
  /**
   * @var string
   */
  public $famcliCod;
    /**
   * @var int
   */
  public $txMrg;
  // public function getCodArt(): ?string
  // {
  //     return $this->codArt;
  // }

  // public function setCodArt(?string $codArt): self
  // {
  //     $this->codArt = $codArt;

  //     return $this;
  // }
  public function setCliCod(?string $cliCod): self
  {
    $this->cliCod = $cliCod;

    return $this;
  }
}
