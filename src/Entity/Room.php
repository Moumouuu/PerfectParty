<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $map = null;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Extra::class)]
    private Collection $extras;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->extras = new ArrayCollection();
    }

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(?string $map): self
    {
        $this->map = $map;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRoom($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRoom() === $this) {
                $reservation->setRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Extra>
     */
    public function getExtras(): Collection
    {
        return $this->extras;
    }

    public function addExtra(Extra $extra): self
    {
        if (!$this->extras->contains($extra)) {
            $this->extras->add($extra);
            $extra->setRoom($this);
        }

        return $this;
    }

    public function removeExtra(Extra $extra): self
    {
        if ($this->extras->removeElement($extra)) {
            // set the owning side to null (unless already changed)
            if ($extra->getRoom() === $this) {
                $extra->setRoom(null);
            }
        }

        return $this;
    }

    public function __toString():string{
        return $this->title;
    }

    public function getTotalPrice():int{
        $price = $this->getPrice();
        foreach ($this->extras as $extra){
            $price += $extra->getPrice();
        }
        return $price;
    }
}
