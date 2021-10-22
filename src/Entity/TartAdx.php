<?php

namespace App\Entity;

use App\Repository\TartAdxRepository;
use Doctrine\ORM\Mapping as ORM;
use Dtc\GridBundle\Annotation as Grid;

/**
 * @Grid\Grid(actions={@Grid\ShowAction(), @Grid\DeleteAction(), @Grid\Action(label="Custom",buttonClass="btn-info",onclick="alert('custom-action')")})
 * @ORM\Entity(repositoryClass=TartAdxRepository::class)
 */
class TartAdx
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $cod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lib01Adx;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lib02Adx;

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

    public function getLib01Adx(): ?string
    {
        return $this->lib01Adx;
    }

    public function setLib01Adx(string $lib01Adx): self
    {
        $this->lib01Adx = $lib01Adx;

        return $this;
    }

    public function getLib02Adx(): ?string
    {
        return $this->lib02Adx;
    }

    public function setLib02Adx(?string $lib02Adx): self
    {
        $this->lib02Adx = $lib02Adx;

        return $this;
    }
}
