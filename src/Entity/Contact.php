<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank(
     *      message = "Vous devez entrer votre nom"
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Votre nom doit comporter au moins {{ limit }} charactères",
     *      maxMessage = "Votre nom doit comporter au maximum {{ limit }} charactères",
     * )
     */
    private $name;

    /**
     * @Assert\Email(
     *      message = "Vous devez entrer une adresse email correcte"
     * )   
     */
    private $email;

    /**
     * @Assert\NotBlank(
     *      message = "Vous devez entrer un objet"
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Votre objet doit comporter au moins {{ limit }} charactères",
     *      maxMessage = "Votre objet doit comporter au maximum {{ limit }} charactères",
     * )
     */
    private $subject;

    /**
     * @Assert\NotBlank(
     *      message = "Vous devez entrer votre message"
     * )
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Votre message doit comporter au moins {{ limit }} charactères",
     * ) 
     */
    private $body;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
