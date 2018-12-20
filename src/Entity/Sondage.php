<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SondageRepository")
 */
class Sondage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", inversedBy="sondages")
     */
    private $event;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", inversedBy="sondages")
     */
    private $participant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormBuilder", inversedBy="sondages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $response;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $satisfaction;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnvoi;

    public function __construct()
    {
        $this->event = new ArrayCollection();
        $this->participant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->event->contains($event)) {
            $this->event->removeElement($event);
        }

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participant->contains($participant)) {
            $this->participant[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participant->contains($participant)) {
            $this->participant->removeElement($participant);
        }

        return $this;
    }

    public function getFormulaire(): ?FormBuilder
    {
        return $this->formulaire;
    }

    public function setFormulaire(?FormBuilder $formulaire): self
    {
        $this->formulaire = $formulaire;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(?string $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function getSatisfaction(): ?int
    {
        return $this->satisfaction;
    }

    public function setSatisfaction(?int $satisfaction): self
    {
        $this->satisfaction = $satisfaction;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(?\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }
}
