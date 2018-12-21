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
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="sondages")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="sondages")
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    public function __construct()
    {
        //$this->event = new ArrayCollection();
        //$this->participant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }
}
