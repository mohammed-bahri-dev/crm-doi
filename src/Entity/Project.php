<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
     * @ORM\ManyToOne(targetEntity=Technology::class, inversedBy="projects")
     */
    private $technology;

    /**
     * @ORM\ManyToOne(targetEntity=TypeOfProject::class, inversedBy="projects")
     */
    private $typeOfProject;

    /**
     * @ORM\Column(type="text")
     */
    private $useCase;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $impact;

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

    public function getTechnology(): ?Technology
    {
        return $this->technology;
    }

    public function setTechnology(?Technology $technology): self
    {
        $this->technology = $technology;

        return $this;
    }

    public function getTypeOfProject(): ?TypeOfProject
    {
        return $this->typeOfProject;
    }

    public function setTypeOfProject(?TypeOfProject $typeOfProject): self
    {
        $this->typeOfProject = $typeOfProject;

        return $this;
    }

    public function getUseCase(): ?string
    {
        return $this->useCase;
    }

    public function setUseCase(string $useCase): self
    {
        $this->useCase = $useCase;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getImpact(): ?string
    {
        return $this->impact;
    }

    public function setImpact(string $impact): self
    {
        $this->impact = $impact;

        return $this;
    }
}
