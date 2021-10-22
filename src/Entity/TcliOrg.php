<?php

namespace App\Entity;

use App\Repository\TcliOrgRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TcliOrgRepository::class)
 */
class TcliOrg
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tclient::class, inversedBy="tcliOrgs")
     */
    private $clrCli;

    /**
     * @ORM\ManyToOne(targetEntity=Torganisation::class, inversedBy="tcliOrgs")
     */
    private $clrOrg;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * 
     */
    private $usrIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * 
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datIns;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datUpd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClrCli(): ?Tclient
    {
        return $this->clrCli;
    }

    public function setClrCli(?Tclient $clrCli): self
    {
        $this->clrCli = $clrCli;

        return $this;
    }

    public function getClrOrg(): ?Torganisation
    {
        return $this->clrOrg;
    }

    public function setClrOrg(?Torganisation $clrOrg): self
    {
        $this->clrOrg = $clrOrg;

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

    public function setDatUpd(\DateTimeInterface $datUpd): self
    {
        $this->datUpd = $datUpd;

        return $this;
    }
}
