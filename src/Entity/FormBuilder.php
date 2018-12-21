<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormBuilderRepository")
 */
class FormBuilder
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
     * @ORM\Column(type="string", length=255)
     */
    private $headerForm;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $paragraph;

    /**
     * @ORM\Column(type="text")
     */
    private $formbuilderhtml;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sondage", mappedBy="formulaire")
     */
    private $sondages;

    public function __construct()
    {
        $this->sondages = new ArrayCollection();
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

    public function getHeaderForm(): ?string
    {
        return $this->headerForm;
    }

    public function setHeaderForm(string $headerForm): self
    {
        $this->headerForm = $headerForm;

        return $this;
    }

    public function getParagraph(): ?string
    {
        return $this->paragraph;
    }

    public function setParagraph(?string $paragraph): self
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    public function getFormbuilderhtml(): ?string
    {
        return $this->formbuilderhtml;
    }

    public function setFormbuilderhtml(string $formbuilderhtml): self
    {
        $this->formbuilderhtml = $formbuilderhtml;

        return $this;
    }

    /**
     * @return Collection|Sondage[]
     */
    public function getSondages(): Collection
    {
        return $this->sondages;
    }

    public function addSondage(Sondage $sondage): self
    {
        if (!$this->sondages->contains($sondage)) {
            $this->sondages[] = $sondage;
            $sondage->setFormulaire($this);
        }

        return $this;
    }

    public function removeSondage(Sondage $sondage): self
    {
        if ($this->sondages->contains($sondage)) {
            $this->sondages->removeElement($sondage);
            // set the owning side to null (unless already changed)
            if ($sondage->getFormulaire() === $this) {
                $sondage->setFormulaire(null);
            }
        }

        return $this;
    }
}
