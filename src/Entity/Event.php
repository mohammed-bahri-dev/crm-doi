<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
     * @ORM\ManyToOne(targetEntity=TypeOfEvent::class, inversedBy="events")
     */
    private $typeOfEvent;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="events")
     */
    private $organizer;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="event")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=ParticipationEvent::class, mappedBy="event")
     */
    private $participationEvents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $thematic;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    public function __construct()
    {
        $this->startDate = new \DateTime('now');
        $this->endDate = new \DateTime('now');
        $this->questions = new ArrayCollection();
        $this->participationEvents = new ArrayCollection();
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

    public function getTypeOfEvent(): ?TypeOfEvent
    {
        return $this->typeOfEvent;
    }

    public function setTypeOfEvent(?TypeOfEvent $typeOfEvent): self
    {
        $this->typeOfEvent = $typeOfEvent;

        return $this;
    }

    public function getOrganizer(): ?User
    {
        return $this->organizer;
    }

    public function setOrganizer(?User $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setEvent($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getEvent() === $this) {
                $question->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ParticipationEvent[]
     */
    public function getParticipationEvents(): Collection
    {
        return $this->participationEvents;
    }

    public function addParticipationEvent(ParticipationEvent $participationEvent): self
    {
        if (!$this->participationEvents->contains($participationEvent)) {
            $this->participationEvents[] = $participationEvent;
            $participationEvent->setEvent($this);
        }

        return $this;
    }

    public function removeParticipationEvent(ParticipationEvent $participationEvent): self
    {
        if ($this->participationEvents->contains($participationEvent)) {
            $this->participationEvents->removeElement($participationEvent);
            // set the owning side to null (unless already changed)
            if ($participationEvent->getEvent() === $this) {
                $participationEvent->setEvent(null);
            }
        }

        return $this;
    }

    public function getThematic(): ?string
    {
        return $this->thematic;
    }

    public function setThematic(string $thematic): self
    {
        $this->thematic = $thematic;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

}
