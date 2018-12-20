<?php

namespace App\Entity;

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
}
