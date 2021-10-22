<?php

namespace App\Entity;

use App\Repository\TsitwebRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TsitwebRepository::class)
 */
class Tsitweb
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
     * @ORM\OneToMany(targetEntity=Tarttrfsitweb::class, mappedBy="clrSitweb")
     */
    private $tarttrfsitwebs;

    public function __construct()
    {
        $this->tarttrfsitwebs = new ArrayCollection();
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
     * @return Collection|Tarttrfsitweb[]
     */
    public function getTarttrfsitwebs(): Collection
    {
        return $this->tarttrfsitwebs;
    }

    public function addTarttrfsitweb(Tarttrfsitweb $tarttrfsitweb): self
    {
        if (!$this->tarttrfsitwebs->contains($tarttrfsitweb)) {
            $this->tarttrfsitwebs[] = $tarttrfsitweb;
            $tarttrfsitweb->setClrSitweb($this);
        }

        return $this;
    }

    public function removeTarttrfsitweb(Tarttrfsitweb $tarttrfsitweb): self
    {
        if ($this->tarttrfsitwebs->removeElement($tarttrfsitweb)) {
            // set the owning side to null (unless already changed)
            if ($tarttrfsitweb->getClrSitweb() === $this) {
                $tarttrfsitweb->setClrSitweb(null);
            }
        }

        return $this;
    }
}
