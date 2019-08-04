<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GeoCodeRepository")
 * @ORM\Table(indexes={@ORM\Index(name="brewery_idx", columns={"brewery_id"})})
 */
class GeoCode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="geo_code__id", type="integer", options={"unsigned"=true})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $breweryId;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=8)
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=8)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $accuracy;

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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getAccuracy(): ?string
    {
        return $this->accuracy;
    }

    public function setAccuracy(string $accuracy): self
    {
        $this->accuracy = $accuracy;

        return $this;
    }
}
