<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\Column]
    private ?int $totalPrice = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Room $room = null;

    #[ORM\Column]
    private ?int $nbPeople = null;

    #[ORM\ManyToMany(targetEntity: Extra::class, inversedBy: 'reservations')]
    private Collection $extras;


    public function __construct()
    {
        $this->extras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getNbPeople(): ?int
    {
        return $this->nbPeople;
    }

    public function setNbPeople(int $nbPeople): self
    {
        $this->nbPeople = $nbPeople;

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
        }

        return $this;
    }

    public function removeExtra(Extra $extra): self
    {
        $this->extras->removeElement($extra);

        return $this;
    }

    /** Allow to calculate the total price of the reservation with the extras selected
     * @return int : The total cost of the reservation with the extras
     */
    public function setTotalPriceWithExtras():int{
        $totalPrice = $this->getRoom()->getPrice();
        foreach ($this->getExtras() as $extra){
            $totalPrice += $extra->getPrice();
        }
        return $totalPrice;
    }

    /**
     * @param int $p : the number of people the client want
     * @return bool : True if the number choising is between min and max of the room
     */
    public function verifyNbPeople(int $p):bool{
        if($p< $this->getRoom()->getNbVoyageurMax() && $p>$this->getRoom()->getNbVoyageurMin()){
            return true;
        }
        return false;
    }

    public function verifyDate():bool{
        //verify if the start date if between the end date
        if($this->getDateStart()< $this->getDateEnd()){
            return true;
        }
        return false;
    }


}
