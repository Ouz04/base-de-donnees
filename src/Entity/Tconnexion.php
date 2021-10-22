<?php

namespace App\Entity;

use App\Repository\TconnexionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TconnexionRepository::class)
 */
class Tconnexion
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
    private $ip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $envPc;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datDeb;
    /**
     * @ORM\Column(type="datetime")
     */
    private $datFin;    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getEnvPc(): ?string
    {
        return $this->envPc;
    }

    public function setEnvPc(?string $envPc): self
    {
        $this->envPc = $envPc;

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

    /**
     * Get the value of datfin
     */
    public function getDatFin()
    {
        return $this->datFin;
    }

    /**
     * Set the value of datfin
     *
     * @return  self
     */
    public function setDatFin($datFin)
    {
        $this->datFin = $datFin;

        return $this;
    }
}
