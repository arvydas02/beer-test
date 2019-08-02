<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerRepository")
 */
class Beer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $breweryId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="integer")
     */
    private $styleId;

    /**
     * @ORM\Column(type="float")
     */
    private $abv;

    /**
     * @ORM\Column(type="float")
     */
    private $ibu;

    /**
     * @ORM\Column(type="float")
     */
    private $srm;

    /**
     * @ORM\Column(type="integer")
     */
    private $upc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filepath;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $addUser;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastModified;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreweryId(): ?int
    {
        return $this->breweryId;
    }

    public function setBreweryId(int $breweryId): self
    {
        $this->breweryId = $breweryId;

        return $this;
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

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getStyleId(): ?int
    {
        return $this->styleId;
    }

    public function setStyleId(int $styleId): self
    {
        $this->styleId = $styleId;

        return $this;
    }

    public function getAbv(): ?float
    {
        return $this->abv;
    }

    public function setAbv(float $abv): self
    {
        $this->abv = $abv;

        return $this;
    }

    public function getIbu(): ?float
    {
        return $this->ibu;
    }

    public function setIbu(float $ibu): self
    {
        $this->ibu = $ibu;

        return $this;
    }

    public function getSrm(): ?float
    {
        return $this->srm;
    }

    public function setSrm(float $srm): self
    {
        $this->srm = $srm;

        return $this;
    }

    public function getUpc(): ?int
    {
        return $this->upc;
    }

    public function setUpc(int $upc): self
    {
        $this->upc = $upc;

        return $this;
    }

    public function getFilepath(): ?string
    {
        return $this->filepath;
    }

    public function setFilepath(string $filepath): self
    {
        $this->filepath = $filepath;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddUser(): ?int
    {
        return $this->addUser;
    }

    public function setAddUser(int $addUser): self
    {
        $this->addUser = $addUser;

        return $this;
    }

    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->lastModified;
    }

    public function setLastModified(\DateTimeInterface $lastModified): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }
}
