<?php

namespace App\Entity;

use App\Repository\TconstructeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TconstructeurRepository::class)
 */
class Tconstructeur
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
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrUpd;

    /**
     * @ORM\OneToMany(targetEntity=Tarticle::class, mappedBy="codCtr")
     */
    private $tarticles;

    public function __construct()
    {
        $this->tarticles = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getUsrIns(): ?Tuser
    {
        return $this->usrIns;
    }

    public function setUsrIns(?Tuser $usrIns): self
    {
        $this->usrIns = $usrIns;

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

    public function getUsrUpd(): ?Tuser
    {
        return $this->usrUpd;
    }

    public function setUsrUpd(?Tuser $usrUpd): self
    {
        $this->usrUpd = $usrUpd;

        return $this;
    }

    /**
     * @return Collection|Tarticle[]
     */
    public function getTarticles(): Collection
    {
        return $this->tarticles;
    }

    public function addTarticle(Tarticle $tarticle): self
    {
        if (!$this->tarticles->contains($tarticle)) {
            $this->tarticles[] = $tarticle;
            $tarticle->setClrCtr($this);
        }

        return $this;
    }

    public function removeTarticle(Tarticle $tarticle): self
    {
        if ($this->tarticles->removeElement($tarticle)) {
            // set the owning side to null (unless already changed)
            if ($tarticle->getClrCtr() === $this) {
                $tarticle->setClrCtr(null);
            }
        }

        return $this;
    }
}
