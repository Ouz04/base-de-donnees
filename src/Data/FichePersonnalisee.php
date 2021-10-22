<?php
namespace App\Data;



class FichePersonnalisee
{
    /**
     * @var boolean
     */
    public $carac;
    /**
     * @var boolean
     */
    public $tarif;
    /**
     * @var boolean
     */
    public $adonix;
    /**
     * @var boolean
     */
    public $site;
    /**
     * @var boolean
     */
    public $desc;
    /**
     * @var boolean
     */
    public $enre;
    
    public function __toString()
    {
        return $this->carac.''.$this->tarif.''.$this->adonix.''.$this->site.''.$this->desc.''.$this->enre;
    }
    
    
    

}