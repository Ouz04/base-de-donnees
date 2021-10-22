<?php

namespace App\Data;

class ArtfouPrxDataObsolete
{
    /**
     * @var string
     */
    private $codArt;
    /**
     * @var string
     */
    private  $codFou;
    /**
     * @var string
     */
    private  $codCot;
    /**
     * @var integer
     */    
    private $qteCndArtfou;
    /**
     * @var integer
     */    
    private $qteStkArtfou;
    /**
     * @var float
     */
    private $prxAchArtfou;

    /**
     * Get the value of codArt
     *
     * @return  string
     */ 
    public function getCodArt()
    {
        return $this->codArt;
    }

    /**
     * Set the value of codArt
     *
     * @param  string  $codArt
     *
     * @return  self
     */ 
    public function setCodArt(string $codArt)
    {
        $this->codArt = $codArt;

        return $this;
    }

    /**
     * Get the value of codFou
     *
     * @return  string
     */ 
    public function getCodFou()
    {
        return $this->codFou;
    }

    /**
     * Set the value of codFou
     *
     * @param  string  $codFou
     *
     * @return  self
     */ 
    public function setCodFou(string $codFou)
    {
        $this->codFou = $codFou;

        return $this;
    }

    /**
     * Get the value of codCot
     *
     * @return  string
     */ 
    public function getCodCot()
    {
        return $this->codCot;
    }

    /**
     * Set the value of codCot
     *
     * @param  string  $codCot
     *
     * @return  self
     */ 
    public function setCodCot(string $codCot)
    {
        $this->codCot = $codCot;

        return $this;
    }

    /**
     * Get the value of qteCndArtfou
     */ 
    public function getQteCndArtfou()
    {
        return $this->qteCndArtfou;
    }

    /**
     * Set the value of qteCndArtfou
     *
     * @return  self
     */ 
    public function setQteCndArtfou($qteCndArtfou)
    {
        $this->qteCndArtfou = $qteCndArtfou;

        return $this;
    }

    /**
     * Get the value of prxAchArtfou
     *
     * @return  float
     */ 
    public function getPrxAchArtfou()
    {
        return $this->prxAchArtfou;
    }

    /**
     * Set the value of prxAchArtfou
     *
     * @param  float  $prxAchArtfou
     *
     * @return  self
     */ 
    public function setPrxAchArtfou(float $prxAchArtfou)
    {
        $this->prxAchArtfou = $prxAchArtfou;

        return $this;
    }

    /**
     * Get the value of qteStkArtfou
     */ 
    public function getQteStkArtfou()
    {
        return $this->qteStkArtfou;
    }

    /**
     * Set the value of qteStkArtfou
     *
     * @return  self
     */ 
    public function setQteStkArtfou($qteStkArtfou)
    {
        $this->qteStkArtfou = $qteStkArtfou;

        return $this;
    }
}
