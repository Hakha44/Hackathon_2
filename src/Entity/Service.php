<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\OneToMany(targetEntity="App\Entity\Subservice", mappedBy="service")
     */
    private $subservices;

    public function __construct()
    {
        $this->subservices = new ArrayCollection();
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
     * @return Collection|Subservice[]
     */
    public function getSubservices(): Collection
    {
        return $this->subservices;
    }

    public function addSubservice(Subservice $subservice): self
    {
        if (!$this->subservices->contains($subservice)) {
            $this->subservices[] = $subservice;
            $subservice->setService($this);
        }

        return $this;
    }

    public function removeSubservice(Subservice $subservice): self
    {
        if ($this->subservices->contains($subservice)) {
            $this->subservices->removeElement($subservice);
            // set the owning side to null (unless already changed)
            if ($subservice->getService() === $this) {
                $subservice->setService(null);
            }
        }

        return $this;
    }
}
