<?php

namespace App\Entity;

use App\Repository\TtyporigtaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TtyporigtaRepository::class)
 */
class Ttyporigta
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
     * @ORM\Column(type="string", length=50)
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
     * @ORM\OneToMany(targetEntity=Tgritarett::class, mappedBy="typOriGta")
     */
    private $tgritaretts;

    public function __construct()
    {
        $this->tgritaretts = new ArrayCollection();
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
     * @return Collection|Tgritarett[]
     */
    public function getTgritaretts(): Collection
    {
        return $this->tgritaretts;
    }

    public function addTgritarett(Tgritarett $tgritarett): self
    {
        if (!$this->tgritaretts->contains($tgritarett)) {
            $this->tgritaretts[] = $tgritarett;
            $tgritarett->setClrTog($this);
        }

        return $this;
    }

    public function removeTgritarett(Tgritarett $tgritarett): self
    {
        if ($this->tgritaretts->removeElement($tgritarett)) {
            // set the owning side to null (unless already changed)
            if ($tgritarett->getClrTog() === $this) {
                $tgritarett->setClrTog(null);
            }
        }

        return $this;
    }
}
