<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RelationRepository")
 */
class Relation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="relations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="relations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContactType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ContactType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameContact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }

    public function getContactType(): ?ContactType
    {
        return $this->ContactType;
    }

    public function setContactType(?ContactType $ContactType): self
    {
        $this->ContactType = $ContactType;

        return $this;
    }

    public function getNameContact(): ?string
    {
        return $this->nameContact;
    }

    public function setNameContact(?string $nameContact): self
    {
        $this->nameContact = $nameContact;

        return $this;
    }
}
