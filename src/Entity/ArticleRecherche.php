<?php

namespace App\Entity;


class ArticleRecherche
{
    /**
     * @var string|null
     */
    private $artCod;
    /**
     * @var string|null
     */
    private $artMrq;
    /**
     * @var string|null
     */
    private $artCtg;

    /**
     * @return string|null
     */
    public function getArtCod(): ?string
    {
        return $this->artCod;
    }
    /**
     * @param string|null $artCod
     * @ return ArticleRecherche
     */
    public function setArtCod(?string $artCod): ArticleRecherche
    {
        $this->artCode = $artCod;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getArtMrq(): ?string
    {
        return $this->artMrq;
    }
    /**
     * @param string|null $artMrq
     * @ return ArticleRecherche
     */
    public function setArtMrq(?string $artMrq): ArticleRecherche
    {
        $this->artMrq = $artMrq;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getArtCtg(): ?string
    {
        return $this->artCtg;
    }
    /**
     * @param string|null $artCtg
     * @ return ArticleRecherche
     */
    public function setArtCtg(?string $artCtg): ArticleRecherche
    {
        $this->artCtg = $artCtg;
        return $this;
    }
}
