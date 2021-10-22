<?php

namespace App\Event;

use App\Entity\Tuser;
use Symfony\Contracts\EventDispatcher\Event;

class UsrInitPwdEvent extends Event
{
    private $tuser;
    private $url;

    public function __construct(Tuser $tuser, string $url)
    {
        $this->tuser = $tuser;
        $this->url = $url;
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of tuser
     *
     * @return  self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
