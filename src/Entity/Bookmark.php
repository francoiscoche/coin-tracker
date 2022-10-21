<?php

namespace App\Entity;

use App\Repository\BookmarkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookmarkRepository::class)]
class Bookmark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idCoin = null;

    #[ORM\ManyToOne(inversedBy: 'bookmarks')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCoin(): ?string
    {
        return $this->idCoin;
    }

    public function setIdCoin(string $idCoin): self
    {
        $this->idCoin = $idCoin;

        return $this;
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
}
