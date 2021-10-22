<?php

namespace App\Entity;

use App\Repository\TuserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=TuserRepository::class)
 */
class Tuser implements UserInterface
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
    private $email;
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datIns;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datUpd;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrIns;

    /**
     * @ORM\ManyToOne(targetEntity=Tuser::class)
     */
    private $usrUpd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Tcommercial::class, mappedBy="clrUsr")
     */
    private $tcommercials;

    /**
     * @ORM\OneToMany(targetEntity=Tcmlusr::class, mappedBy="clrUsr")
     */
    private $tcmlusrs;

    /**
     * @ORM\OneToMany(targetEntity=Tusrcml::class, mappedBy="clrUsr")
     */
    private $tusrcmls;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $acvTkn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plainPassword;

    /**
     * @ORM\ManyToOne(targetEntity=Tservice::class, inversedBy="tusers")
     */
    private $clrSrv;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $resetToken;

    

   


    public function __construct()
    {
        $this->tcommercials = new ArrayCollection();
        $this->tcmlusrs = new ArrayCollection();
        $this->tusrcmls = new ArrayCollection();
        $this->tsocgpts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getDatUpd(): ?\DateTimeInterface
    {
        return $this->datUpd;
    }

    public function setDatUpd(?\DateTimeInterface $datUpd): self
    {
        $this->datUpd = $datUpd;

        return $this;
    }

    public function getUsrIns(): ?self
    {
        return $this->usrIns;
    }

    public function setUsrIns(?self $usrIns): self
    {
        $this->usrIns = $usrIns;

        return $this;
    }

    public function getUsrUpd(): ?self
    {
        return $this->usrUpd;
    }

    public function setUsrUpd(?self $usrUpd): self
    {
        $this->usrUpd = $usrUpd;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Tcommercial[]
     */
    public function getTcommercials(): Collection
    {
        return $this->tcommercials;
    }


    /**
     * @return Collection|Tcmlusr[]
     */
    public function getTcmlusrs(): Collection
    {
        return $this->tcmlusrs;
    }

    public function addTcmlusr(Tcmlusr $tcmlusr): self
    {
        if (!$this->tcmlusrs->contains($tcmlusr)) {
            $this->tcmlusrs[] = $tcmlusr;
            $tcmlusr->setClrUsr($this);
        }

        return $this;
    }

    public function removeTcmlusr(Tcmlusr $tcmlusr): self
    {
        if ($this->tcmlusrs->removeElement($tcmlusr)) {
            // set the owning side to null (unless already changed)
            if ($tcmlusr->getClrUsr() === $this) {
                $tcmlusr->setClrUsr(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tusrcml[]
     */
    public function getTusrcmls(): Collection
    {
        return $this->tusrcmls;
    }

    public function addTusrcml(Tusrcml $tusrcml): self
    {
        if (!$this->tusrcmls->contains($tusrcml)) {
            $this->tusrcmls[] = $tusrcml;
            $tusrcml->setClrUsr($this);
        }

        return $this;
    }

    public function removeTusrcml(Tusrcml $tusrcml): self
    {
        if ($this->tusrcmls->removeElement($tusrcml)) {
            // set the owning side to null (unless already changed)
            if ($tusrcml->getClrUsr() === $this) {
                $tusrcml->setClrUsr(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getEmail();
    }

    public function getAcvTkn(): ?string
    {
        return $this->acvTkn;
    }

    public function setAcvTkn(?string $acvTkn): self
    {
        $this->acvTkn = $acvTkn;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getClrSrv(): ?Tservice
    {
        return $this->clrSrv;
    }

    public function setClrSrv(?Tservice $clrSrv): self
    {
        $this->clrSrv = $clrSrv;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): self
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    
}
