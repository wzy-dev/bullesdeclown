<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScheduldeFieldRepository")
 */
class ScheduldeField
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $day;

    /**
     * @ORM\Column(type="time")
     * @Assert\DateTime
     */
    private $startTime;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @Assert\Time(message="Cette horaire est invalide.")
     */     
    private $endTime;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Schedulde", inversedBy="fields")
     */
    private $schedulde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getSchedulde(): ?Schedulde
    {
        return $this->schedulde;
    }

    public function setSchedulde(?Schedulde $schedulde): self
    {
        $this->schedulde = $schedulde;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }
}
