<?php

namespace App\Entity;

use App\Repository\TitgficpstRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TitgficpstRepository::class)
 */
class Titgficpst
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $enr;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbCol;

    /**
     * @ORM\ManyToOne(targetEntity=Ttypstt::class)
     */
    private $clrTypstt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmt;

    /**
     * @ORM\ManyToOne(targetEntity=Titgficett::class, inversedBy="titgficpsts")
     */
    private $clrItgfic;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tbc;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $idc;

    /**
     * @ORM\ManyToOne(targetEntity=Tdictab::class)
     */
    private $clrTab;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnr(): ?string
    {
        return $this->enr;
    }

    public function setEnr(?string $enr): self
    {
        $this->enr = $enr;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getNbCol(): ?int
    {
        return $this->nbCol;
    }

    public function setNbCol(int $nbCol): self
    {
        $this->nbCol = $nbCol;

        return $this;
    }

    public function getClrTypstt(): ?Ttypstt
    {
        return $this->clrTypstt;
    }

    public function setClrTypstt(?Ttypstt $clrTypstt): self
    {
        $this->clrTypstt = $clrTypstt;

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

    public function getClrItgfic(): ?Titgficett
    {
        return $this->clrItgfic;
    }

    public function setClrItgfic(?Titgficett $clrItgfic): self
    {
        $this->clrItgfic = $clrItgfic;

        return $this;
    }

    public function getTbc(): ?string
    {
        return $this->tbc;
    }

    public function setTbc(?string $tbc): self
    {
        $this->tbc = $tbc;

        return $this;
    }

    public function getIdc(): ?string
    {
        return $this->idc;
    }

    public function setIdc(?string $idc): self
    {
        $this->idc = $idc;

        return $this;
    }

    public function getClrTab(): ?Tdictab
    {
        return $this->clrTab;
    }

    public function setClrTab(?Tdictab $clrTab): self
    {
        $this->clrTab = $clrTab;

        return $this;
    }
}
