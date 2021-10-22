<?php

namespace App\Entity;

use App\Repository\TimageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimageRepository::class)
 */
class Timage
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Tarticle::class, inversedBy="timages")
     */
    private $articles;

    public function getId(): ?int
    
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getArticles(): ?Tarticle
    {
        return $this->articles;
    }

    public function setArticles(?Tarticle $articles): self
    {
        $this->articles = $articles;

        return $this;
    }
}
