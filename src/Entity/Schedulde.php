<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScheduldeRepository")
 */
class Schedulde
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Valid    
     * @ORM\OneToMany(targetEntity="App\Entity\ScheduldeField", mappedBy="schedulde", cascade={"persist","remove"})
     */
    private $fields;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ScheduldeField[]
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(ScheduldeField $field): self
    {
        if (!$this->fields->contains($field)) {
            $this->fields[] = $field;
            $field->setSchedulde($this);
        }

        return $this;
    }

    public function removeField(ScheduldeField $field): self
    {
        if ($this->fields->contains($field)) {
            $this->fields->removeElement($field);
            // set the owning side to null (unless already changed)
            if ($field->getSchedulde() === $this) {
                $field->setSchedulde(null);
            }
        }

        return $this;
    }
}
