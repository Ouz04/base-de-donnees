<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class TgritarCollection
{
    protected $id;
    protected $tgritarpsts;
 

    public function __construct()
    {
        $this->tgritarpsts = new ArrayCollection();
      
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setid(int $id): void
    {
        $this->id = $id;
    }

    public function getTgritarpsts(): Collection
    {
        return $this->tgritarpsts;
    }
    function setTgritarpsts($tgritarpsts) {

        $this->tgritarpsts = $tgritarpsts;
        
        return $this;
        
    }
    

    public function removeTgritarpst(Tgritarpst $tgritarpst): self
    {
        if ($this->tgritarpsts->removeElement($tgritarpst)) {
            // set the owning side to null (unless already changed)
            if ($tgritarpst->getClrArt() === $this) {
                $tgritarpst->setClrArt(null);
            }
        }

        return $this;
    }
    
    
}
