<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idCoin = null;

    #[ORM\Column(length: 255)]
    private ?string $symbol = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $currentPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $marketCap = null;

    #[ORM\Column(nullable: true)]
    private ?int $marketCapRank = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalVolume = null;

    #[ORM\Column(nullable: true)]
    private ?int $ath = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastUpdated = null;

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

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCurrentPrice(): ?string
    {
        return $this->currentPrice;
    }

    public function setCurrentPrice(?string $currentPrice): self
    {
        $this->currentPrice = $currentPrice;

        return $this;
    }

    public function getMarketCap(): ?int
    {
        return $this->marketCap;
    }

    public function setMarketCap(?int $marketCap): self
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    public function getMarketCapRank(): ?int
    {
        return $this->marketCapRank;
    }

    public function setMarketCapRank(?int $marketCapRank): self
    {
        $this->marketCapRank = $marketCapRank;

        return $this;
    }

    public function getTotalVolume(): ?int
    {
        return $this->totalVolume;
    }

    public function setTotalVolume(?int $totalVolume): self
    {
        $this->totalVolume = $totalVolume;

        return $this;
    }

    public function getAth(): ?int
    {
        return $this->ath;
    }

    public function setAth(?int $ath): self
    {
        $this->ath = $ath;

        return $this;
    }

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(?\DateTimeInterface $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }
}
