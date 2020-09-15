<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"car:read"}},
 *     denormalizationContext={"groups"={"car:write"}}
 * )
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"car:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"car:write", "car:read"})
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"car:write", "car:read"})
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"car:write", "car:read"})
     */
    private $carburant;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"car:write", "car:read"})
     */
    private $annee;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"car:write", "car:read"})
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"car:write", "car:read"})
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"car:write", "car:read"})
     */
    private $dateAjout;

    /**
     * @ORM\Column(type="text")
     * @Groups({"car:write", "car:read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="car")
     */
    private $garage;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="car")
     * @Groups({"car:write", "car:read"})
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

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

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }
}
