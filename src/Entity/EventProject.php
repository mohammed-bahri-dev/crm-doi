<?php

namespace App\Entity;

use App\Repository\EventProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventProjectRepository::class)
 */
class EventProject
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProjectStatus::class, inversedBy="eventProjects")
     */
    private $projectStatus;

    /**
     * @ORM\ManyToOne(targetEntity=TypeOfEventProject::class, inversedBy="eventProjects")
     */
    private $typeOfEventProject;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="eventProjects")
     */
    private $person;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectStatus(): ?ProjectStatus
    {
        return $this->projectStatus;
    }

    public function setProjectStatus(?ProjectStatus $projectStatus): self
    {
        $this->projectStatus = $projectStatus;

        return $this;
    }

    public function getTypeOfEventProject(): ?TypeOfEventProject
    {
        return $this->typeOfEventProject;
    }

    public function setTypeOfEventProject(?TypeOfEventProject $typeOfEventProject): self
    {
        $this->typeOfEventProject = $typeOfEventProject;

        return $this;
    }

    public function getPerson(): ?User
    {
        return $this->person;
    }

    public function setPerson(?User $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
