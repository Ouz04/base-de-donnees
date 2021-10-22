<?php

namespace App\Entity;

use App\Repository\ArticleRecherchebRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRecherchebRepository::class)
 */
class ArticleRechercheb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $artCod;

    /**
     * @ORM\ManyToOne(targetEntity=Tcategorie::class)
     */
    private $clrCtg;

    /**
     * @ORM\ManyToOne(targetEntity=Tconstructeur::class)
     */
    private $clrCtr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtCod(): ?string
    {
        return $this->artCod;
    }

    public function setArtCod(?string $artCod): self
    {
        $this->artCod = $artCod;

        return $this;
    }

    public function getClrCtg(): ?Tcategorie
    {
        return $this->clrCtg;
    }

    public function setClrCtg(?Tcategorie $clrCtg): self
    {
        $this->clrCtg = $clrCtg;

        return $this;
    }

    public function getClrCtr(): ?Tconstructeur
    {
        return $this->clrCtr;
    }

    public function setClrCtr(?Tconstructeur $clrCtr): self
    {
        $this->clrCtr = $clrCtr;

        return $this;
    }
}
