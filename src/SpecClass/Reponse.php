<?php

namespace App\SpecClass;

class Reponse
{
    private string $var01;


    /**
     * Get the value of var01
     */
    public function getVar01()
    {
        return $this->var01;
    }

    /**
     * Set the value of var01
     *
     * @return  self
     */
    public function setVar01($var01)
    {
        $this->var01 = $var01;

        return $this;
    }
}
