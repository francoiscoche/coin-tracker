<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use App\Entity\User;
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
    private ?int $marketCapRank = null;

    #[ORM\Column(nullable: true)]
    private ?int $ath = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastUpdated = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $marketCap = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $totalVolume = null;

    #[ORM\OneToMany(mappedBy: 'idCurrency', targetEntity: Bookmark::class)]
    private Collection $bookmarks;

    public function __construct()
    {
        $this->bookmarks = new ArrayCollection();
    }

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

    public function getMarketCapRank(): ?int
    {
        return $this->marketCapRank;
    }

    public function setMarketCapRank(?int $marketCapRank): self
    {
        $this->marketCapRank = $marketCapRank;

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

    public function getMarketCap(): ?string
    {
        return $this->marketCap;
    }

    public function setMarketCap(?string $marketCap): self
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    public function getTotalVolume(): ?string
    {
        return $this->totalVolume;
    }

    public function setTotalVolume(?string $totalVolume): self
    {
        $this->totalVolume = $totalVolume;

        return $this;
    }

    /**
     * @return Collection<int, Bookmark>
     */
    public function getBookmarks(): Collection
    {
        return $this->bookmarks;
    }

    public function addBookmark(Bookmark $bookmark): self
    {
        if (!$this->bookmarks->contains($bookmark)) {
            $this->bookmarks->add($bookmark);
            $bookmark->setIdCurrency($this);
        }

        return $this;
    }

    public function removeBookmark(Bookmark $bookmark): self
    {
        if ($this->bookmarks->removeElement($bookmark)) {
            // set the owning side to null (unless already changed)
            if ($bookmark->getIdCurrency() === $this) {
                $bookmark->setIdCurrency(null);
            }
        }

        return $this;
    }

    /**
     * Let us know is this currency is favorite by user
     *
     * @param User $user
     * @return boolean
     */
    public function isFavoritesByUser(User $user): bool {

        foreach($this->bookmarks as $bookmark) {
            if($bookmark->getUser() === $user) return true;
        }
        return false;
    }
}
