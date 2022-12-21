<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbVoyageurMin = null;

    #[ORM\Column]
    private ?int $nbVoyageurMax = null;

    #[ORM\Column]
    private ?int $nbChambre = null;

    #[ORM\Column]
    private ?int $nbLit = null;

    #[ORM\Column]
    private ?int $nbSalleDeBain = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbVoyageurMin(): ?int
    {
        return $this->nbVoyageurMin;
    }

    public function setNbVoyageurMin(int $nbVoyageurMin): self
    {
        $this->nbVoyageurMin = $nbVoyageurMin;

        return $this;
    }

    public function getNbVoyageurMax(): ?int
    {
        return $this->nbVoyageurMax;
    }

    public function setNbVoyageurMax(int $nbVoyageurMax): self
    {
        $this->nbVoyageurMax = $nbVoyageurMax;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nbChambre;
    }

    public function setNbChambre(int $nbChambre): self
    {
        $this->nbChambre = $nbChambre;

        return $this;
    }

    public function getNbLit(): ?int
    {
        return $this->nbLit;
    }

    public function setNbLit(int $nbLit): self
    {
        $this->nbLit = $nbLit;

        return $this;
    }

    public function getNbSalleDeBain(): ?int
    {
        return $this->nbSalleDeBain;
    }

    public function setNbSalleDeBain(int $nbSalleDeBain): self
    {
        $this->nbSalleDeBain = $nbSalleDeBain;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
