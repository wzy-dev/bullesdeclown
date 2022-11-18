<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElementRepository")
 */
class Element
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Data", cascade={"persist", "remove"})
     */
    private $data;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Rate", cascade={"persist", "remove"})
     */
    private $rate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Schedulde", cascade={"persist", "remove"})
     */
    private $schedulde;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank     
     */
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rank;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank     
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cover", cascade={"persist", "remove"})
     */
    private $cover;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Presentation", cascade={"persist", "remove"})
     */
    private $presentation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DataLeft", cascade={"persist", "remove"})
     */
    private $dataLeft;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DataRight", cascade={"persist", "remove"})
     */
    private $dataRight;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Information", cascade={"persist", "remove"})
     */
    private $information;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ArticleBlock", cascade={"persist", "remove"})
     */
    private $articleBlock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?Data
    {
        return $this->data;
    }

    public function setData(?Data $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getRate(): ?Rate
    {
        return $this->rate;
    }

    public function setRate(?Rate $rate): self
    {
        $this->rate = $rate;

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

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCover(): ?Cover
    {
        return $this->cover;
    }

    public function setCover(?Cover $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getPresentation(): ?Presentation
    {
        return $this->presentation;
    }

    public function setPresentation(?Presentation $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getDataLeft(): ?DataLeft
    {
        return $this->dataLeft;
    }

    public function setDataLeft(?DataLeft $dataLeft): self
    {
        $this->dataLeft = $dataLeft;

        return $this;
    }

    public function getDataRight(): ?DataRight
    {
        return $this->dataRight;
    }

    public function setDataRight(?DataRight $dataRight): self
    {
        $this->dataRight = $dataRight;

        return $this;
    }

    public function getInformation(): ?Information
    {
        return $this->information;
    }

    public function setInformation(?Information $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getArticleBlock(): ?ArticleBlock
    {
        return $this->articleBlock;
    }

    public function setArticleBlock(?ArticleBlock $articleBlock): self
    {
        $this->articleBlock = $articleBlock;

        return $this;
    }
}
