<?php

namespace App\Entity;

use App\Repository\ProjectStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectStatusRepository::class)
 */
class ProjectStatus
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
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=EventProject::class, mappedBy="projectStatus")
     */
    private $eventProjects;

    public function __construct()
    {
        $this->eventProjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|EventProject[]
     */
    public function getEventProjects(): Collection
    {
        return $this->eventProjects;
    }

    public function addEventProject(EventProject $eventProject): self
    {
        if (!$this->eventProjects->contains($eventProject)) {
            $this->eventProjects[] = $eventProject;
            $eventProject->setProjectStatus($this);
        }

        return $this;
    }

    public function removeEventProject(EventProject $eventProject): self
    {
        if ($this->eventProjects->contains($eventProject)) {
            $this->eventProjects->removeElement($eventProject);
            // set the owning side to null (unless already changed)
            if ($eventProject->getProjectStatus() === $this) {
                $eventProject->setProjectStatus(null);
            }
        }

        return $this;
    }
}
