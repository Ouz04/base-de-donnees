<?php

namespace App\Entity;

use App\Repository\TitgficettRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TitgficettRepository::class)
 */
class Titgficett
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomFicLcl;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEnr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $cmt;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $usrIns;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datIns;

    /**
     * @ORM\ManyToOne(targetEntity=Ttypitgfic::class)
     */
    private $clrTif;

    /**
     * @ORM\OneToMany(targetEntity=Titgficpst::class, mappedBy="clrItgfic")
     */
    private $titgficpsts;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomFicItn;

    public function __construct()
    {
        $this->titgficpsts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFicLcl(): ?string
    {
        return $this->nomFicLcl;
    }

    public function setNomFicLcl(string $nomFicLcl): self
    {
        $this->nomFicLcl = $nomFicLcl;

        return $this;
    }

    public function getNbEnr(): ?int
    {
        return $this->nbEnr;
    }

    public function setNbEnr(int $nbEnr): self
    {
        $this->nbEnr = $nbEnr;

        return $this;
    }

    public function getCmt(): ?string
    {
        return $this->cmt;
    }

    public function setCmt(?string $cmt): self
    {
        $this->cmt = $cmt;

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

    public function getClrTif(): ?Ttypitgfic
    {
        return $this->clrTif;
    }

    public function setClrTif(?Ttypitgfic $clrTif): self
    {
        $this->clrTif = $clrTif;

        return $this;
    }

    /**
     * @return Collection|Titgficpst[]
     */
    public function getTitgficpsts(): Collection
    {
        return $this->titgficpsts;
    }

    public function addTitgficpst(Titgficpst $titgficpst): self
    {
        if (!$this->titgficpsts->contains($titgficpst)) {
            $this->titgficpsts[] = $titgficpst;
            $titgficpst->setClrItgfic($this);
        }

        return $this;
    }

    public function removeTitgficpst(Titgficpst $titgficpst): self
    {
        if ($this->titgficpsts->removeElement($titgficpst)) {
            // set the owning side to null (unless already changed)
            if ($titgficpst->getClrItgfic() === $this) {
                $titgficpst->setClrItgfic(null);
            }
        }

        return $this;
    }

    public function getNomFicItn(): ?string
    {
        return $this->nomFicItn;
    }

    public function setNomFicItn(string $nomFicItn): self
    {
        $this->nomFicItn = $nomFicItn;

        return $this;
    }
}
