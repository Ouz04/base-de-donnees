<?php

namespace App\SpecClass;

class ItgRtr
{
    private int $OK = 0;
    private Int $KO = 0;
    private int $OKKO = 0;
    private int $id = 0;


    /**
     * Get the value of OK
     */
    public function getOK()
    {
        return $this->OK;
    }

    /**
     * Set the value of OK
     *
     * @return  self
     */
    public function setOK($OK)
    {
        $this->OK = $OK;

        return $this;
    }
    /**
     * ajoute 1
     */
    public function addOK()
    {
        $this->OK++;
        $this->OKKO++;

        return $this;
    }
    /**
     * Get the value of KO
     */
    public function getKO()
    {
        return $this->KO;
    }

    /**
     * Set the value of KO
     *
     * @return  self
     */
    public function setKO($KO)
    {
        $this->KO = $KO;

        return $this;
    }
    /**
     * ajoute 1
     */
    public function addKO()
    {
        $this->KO++;
        $this->OKKO++;

        return $this;
    }
    /**
     * Get the value of OKKO
     */
    public function getOKKO()
    {
        return $this->OKKO;
    }

    /**
     * Set the value of OKKO
     *
     * @return  self
     */
    public function setOKKO($OKKO)
    {
        $this->OKKO = $OKKO;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
