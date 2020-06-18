<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\ManyToOne(targetEntity=CaEntity::class, inversedBy="users")
     */
    private $caEntity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="organizer")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity=Technology::class, mappedBy="expert")
     */
    private $technologies;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="person")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=ParticipationEvent::class, mappedBy="participant")
     */
    private $participationEvents;

    /**
     * @ORM\OneToMany(targetEntity=EventProject::class, mappedBy="person")
     */
    private $eventProjects;

    /**
     * @ORM\ManyToOne(targetEntity=PreferredContact::class, inversedBy="users")
     */
    private $preferredContact;

    /**
     * @ORM\OneToMany(targetEntity=CaEntity::class, mappedBy="privilegedContact")
     */
    private $caEntities;

    /**
     * @ORM\OneToMany(targetEntity=CaEntity::class, mappedBy="iBusinessContact")
     */
    private $caEntitiesIBusiness;

    /**
     * @ORM\OneToMany(targetEntity=CaEntity::class, mappedBy="innovationContact")
     */
    private $caEntitiesInnovation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poste;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->events = new ArrayCollection();
        $this->technologies = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->participationEvents = new ArrayCollection();
        $this->eventProjects = new ArrayCollection();
        $this->caEntities = new ArrayCollection();
        $this->caEntitiesIBusiness = new ArrayCollection();
        $this->caEntitiesInnovation = new ArrayCollection();
    }

    // other properties and methods

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function eraseCredentials()
    {
    }

    public function getCaEntity(): ?CaEntity
    {
        return $this->caEntity;
    }

    public function setCaEntity(?CaEntity $caEntity): self
    {
        $this->caEntity = $caEntity;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setOrganizer($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getOrganizer() === $this) {
                $event->setOrganizer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Technology[]
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technology $technology): self
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies[] = $technology;
            $technology->setExpert($this);
        }

        return $this;
    }

    public function removeTechnology(Technology $technology): self
    {
        if ($this->technologies->contains($technology)) {
            $this->technologies->removeElement($technology);
            // set the owning side to null (unless already changed)
            if ($technology->getExpert() === $this) {
                $technology->setExpert(null);
            }
        }

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
            $question->setPerson($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getPerson() === $this) {
                $question->setPerson(null);
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
            $participationEvent->setParticipant($this);
        }

        return $this;
    }

    public function removeParticipationEvent(ParticipationEvent $participationEvent): self
    {
        if ($this->participationEvents->contains($participationEvent)) {
            $this->participationEvents->removeElement($participationEvent);
            // set the owning side to null (unless already changed)
            if ($participationEvent->getParticipant() === $this) {
                $participationEvent->setParticipant(null);
            }
        }

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
            $eventProject->setPerson($this);
        }

        return $this;
    }

    public function removeEventProject(EventProject $eventProject): self
    {
        if ($this->eventProjects->contains($eventProject)) {
            $this->eventProjects->removeElement($eventProject);
            // set the owning side to null (unless already changed)
            if ($eventProject->getPerson() === $this) {
                $eventProject->setPerson(null);
            }
        }

        return $this;
    }

    public function getPreferredContact(): ?PreferredContact
    {
        return $this->preferredContact;
    }

    public function setPreferredContact(?PreferredContact $preferredContact): self
    {
        $this->preferredContact = $preferredContact;

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
            $caEntity->setPrivilegedContact($this);
        }

        return $this;
    }

    public function removeCaEntity(CaEntity $caEntity): self
    {
        if ($this->caEntities->contains($caEntity)) {
            $this->caEntities->removeElement($caEntity);
            // set the owning side to null (unless already changed)
            if ($caEntity->getPrivilegedContact() === $this) {
                $caEntity->setPrivilegedContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CaEntity[]
     */
    public function getCaEntitiesIBusiness(): Collection
    {
        return $this->caEntitiesIBusiness;
    }

    public function addCaEntitiesIBusiness(CaEntity $caEntitiesIBusiness): self
    {
        if (!$this->caEntitiesIBusiness->contains($caEntitiesIBusiness)) {
            $this->caEntitiesIBusiness[] = $caEntitiesIBusiness;
            $caEntitiesIBusiness->setIBusinessContact($this);
        }

        return $this;
    }

    public function removeCaEntitiesIBusiness(CaEntity $caEntitiesIBusiness): self
    {
        if ($this->caEntitiesIBusiness->contains($caEntitiesIBusiness)) {
            $this->caEntitiesIBusiness->removeElement($caEntitiesIBusiness);
            // set the owning side to null (unless already changed)
            if ($caEntitiesIBusiness->getIBusinessContact() === $this) {
                $caEntitiesIBusiness->setIBusinessContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CaEntity[]
     */
    public function getCaEntitiesInnovation(): Collection
    {
        return $this->caEntitiesInnovation;
    }

    public function addCaEntitiesInnovation(CaEntity $caEntitiesInnovation): self
    {
        if (!$this->caEntitiesInnovation->contains($caEntitiesInnovation)) {
            $this->caEntitiesInnovation[] = $caEntitiesInnovation;
            $caEntitiesInnovation->setInnovationContact($this);
        }

        return $this;
    }

    public function removeCaEntitiesInnovation(CaEntity $caEntitiesInnovation): self
    {
        if ($this->caEntitiesInnovation->contains($caEntitiesInnovation)) {
            $this->caEntitiesInnovation->removeElement($caEntitiesInnovation);
            // set the owning side to null (unless already changed)
            if ($caEntitiesInnovation->getInnovationContact() === $this) {
                $caEntitiesInnovation->setInnovationContact(null);
            }
        }

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }
}
