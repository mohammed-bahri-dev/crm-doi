<?php

namespace App\Entity;

use App\Repository\TypeOfEventProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeOfEventProjectRepository::class)
 */
class TypeOfEventProject
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
    private $action;

    /**
     * @ORM\OneToMany(targetEntity=EventProject::class, mappedBy="TypeOfEventProject")
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

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

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
            $eventProject->setTypeOfEventProject($this);
        }

        return $this;
    }

    public function removeEventProject(EventProject $eventProject): self
    {
        if ($this->eventProjects->contains($eventProject)) {
            $this->eventProjects->removeElement($eventProject);
            // set the owning side to null (unless already changed)
            if ($eventProject->getTypeOfEventProject() === $this) {
                $eventProject->setTypeOfEventProject(null);
            }
        }

        return $this;
    }
}
