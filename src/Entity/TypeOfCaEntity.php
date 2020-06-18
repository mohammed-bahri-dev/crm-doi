<?php

namespace App\Entity;

use App\Repository\TypeOfCaEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeOfCaEntityRepository::class)
 */
class TypeOfCaEntity
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
     * @ORM\OneToMany(targetEntity=CaEntity::class, mappedBy="typeOfCaEntity")
     */
    private $caEntities;

    public function __construct()
    {
        $this->caEntities = new ArrayCollection();
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

    /**
     * @return Collection|CaEntity[]
     */
    public function getCaEntities(): Collection
    {
        return $this->caEntities;
    }

    public function addCaEntity(CaEntity $caEntity): self
    {
        if (!$this->caEntities->contains($caEntity)) {
            $this->caEntities[] = $caEntity;
            $caEntity->setTypeOfCaEntity($this);
        }

        return $this;
    }

    public function removeCaEntity(CaEntity $caEntity): self
    {
        if ($this->caEntities->contains($caEntity)) {
            $this->caEntities->removeElement($caEntity);
            // set the owning side to null (unless already changed)
            if ($caEntity->getTypeOfCaEntity() === $this) {
                $caEntity->setTypeOfCaEntity(null);
            }
        }

        return $this;
    }
}
