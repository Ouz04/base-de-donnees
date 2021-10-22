<?php

namespace App\Event;

use App\Entity\Tuser;
use Symfony\Contracts\EventDispatcher\Event;

class UsrCreatEvent extends Event
{
    private $tuser;
    private $pwd;

    public function __construct(Tuser $tuser, string $pwd)
    {
        $this->tuser = $tuser;
        $this->pwd = $pwd;

    }

    /**
     * Get the value of tuser
     */
    public function getTuser()
    {
        return $this->tuser;
    }

    /**
     * Set the value of tuser
     *
     * @return  self
     */
    public function setTuser($tuser)
    {
        $this->tuser = $tuser;

        return $this;
    }
    /**
     * Get the value of tuser
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of tuser
     *
     * @return  self
     */
    public function setPwd($pwd)
    {
        $this->tpwd = $pwd;

        return $this;
    }
}
