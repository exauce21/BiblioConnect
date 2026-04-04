<?php

namespace App\Entity;

use App\Repository\FavoriRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriRepository::class)]
class Favori
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    private ?Livre $livre = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    private ?User $user_favoris = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): static
    {
        $this->livre = $livre;

        return $this;
    }

    public function getUserFavoris(): ?User
    {
        return $this->user_favoris;
    }

    public function setUserFavoris(?User $user_favoris): static
    {
        $this->user_favoris = $user_favoris;

        return $this;
    }
}
