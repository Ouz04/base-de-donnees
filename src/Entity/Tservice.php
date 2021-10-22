<?php

namespace App\Entity;

use App\Repository\TserviceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TserviceRepository::class)
 */
class Tservice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cod;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $dsg;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\OneToMany(targetEntity=Tuser::class, mappedBy="clrSrv")
     */
    private $tusers;

    public function __construct()
    {
        $this->tusers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCod(): ?string
    {
        return $this->cod;
    }

    public function setCod(string $cod): self
    {
        $this->cod = $cod;

        return $this;
    }

    public function getDsg(): ?string
    {
        return $this->dsg;
    }

    public function setDsg(string $dsg): self
    {
        $this->dsg = $dsg;

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

    public function getUsrUpd(): ?Tuser
    {
        return $this->usrUpd;
    }

    public function setUsrUpd(?Tuser $usrUpd): self
    {
        $this->usrUpd = $usrUpd;

        return $this;
    }

    public function getDatUpd(): ?\DateTimeInterface
    {
        return $this->datUpd;
    }

    public function setDatUpd(?\DateTimeInterface $datUpd): self
    {
        $this->datUpd = $datUpd;

        return $this;
    }

    /**
     * @return Collection|Tuser[]
     */
    public function getTusers(): Collection
    {
        return $this->tusers;
    }

    public function addTuser(Tuser $tuser): self
    {
        if (!$this->tusers->contains($tuser)) {
            $this->tusers[] = $tuser;
            $tuser->setClrSrv($this);
        }

        return $this;
    }

    public function removeTuser(Tuser $tuser): self
    {
        if ($this->tusers->removeElement($tuser)) {
            // set the owning side to null (unless already changed)
            if ($tuser->getClrSrv() === $this) {
                $tuser->setClrSrv(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->dsg;
    }
}
