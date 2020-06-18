<?php

namespace App\Entity;

use App\Repository\CaEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaEntityRepository::class)
 */
class CaEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="caEntity")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=PartnerStatus::class, inversedBy="caEntities")
     */
    private $partnerStatus;

    /**
     * @ORM\ManyToOne(targetEntity=TypeOfCaEntity::class, inversedBy="caEntities")
     */
    private $typeOfCaEntity;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="caEntities")
     */
    private $privilegedContact;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="caEntitiesIBusiness")
     */
    private $iBusinessContact;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="caEntitiesInnovation")
     */
    private $innovationContact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interestLevel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $innovationProfile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $department;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCaEntity($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCaEntity() === $this) {
                $user->setCaEntity(null);
            }
        }

        return $this;
    }

    public function getPartnerStatus(): ?PartnerStatus
    {
        return $this->partnerStatus;
    }

    public function setPartnerStatus(?PartnerStatus $partnerStatus): self
    {
        $this->partnerStatus = $partnerStatus;

        return $this;
    }

    public function getTypeOfCaEntity(): ?TypeOfCaEntity
    {
        return $this->typeOfCaEntity;
    }

    public function setTypeOfCaEntity(?TypeOfCaEntity $typeOfCaEntity): self
    {
        $this->typeOfCaEntity = $typeOfCaEntity;

        return $this;
    }

    public function getPrivilegedContact(): ?User
    {
        return $this->privilegedContact;
    }

    public function setPrivilegedContact(?User $privilegedContact): self
    {
        $this->privilegedContact = $privilegedContact;

        return $this;
    }

    public function getIBusinessContact(): ?User
    {
        return $this->iBusinessContact;
    }

    public function setIBusinessContact(?User $iBusinessContact): self
    {
        $this->iBusinessContact = $iBusinessContact;

        return $this;
    }

    public function getInnovationContact(): ?User
    {
        return $this->innovationContact;
    }

    public function setInnovationContact(?User $innovationContact): self
    {
        $this->innovationContact = $innovationContact;

        return $this;
    }

    public function getInterestLevel(): ?string
    {
        return $this->interestLevel;
    }

    public function setInterestLevel(string $interestLevel): self
    {
        $this->interestLevel = $interestLevel;

        return $this;
    }

    public function getInnovationProfile(): ?string
    {
        return $this->innovationProfile;
    }

    public function setInnovationProfile(string $innovationProfile): self
    {
        $this->innovationProfile = $innovationProfile;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }
}
