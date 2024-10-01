<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\enum\UserAccountStatusEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(enumType: UserAccountStatusEnum::class)]
    private ?UserAccountStatusEnum $accountstatus = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Subscriptions $currentSubscription = null;

    /**
     * @var Collection<int, Playlists>
     */
    #[ORM\OneToMany(targetEntity: Playlists::class, mappedBy: 'owner')]
    private Collection $playlists;

    /**
     * @var Collection<int, PlaylistSubscriptions>
     */
    #[ORM\OneToMany(targetEntity: PlaylistSubscriptions::class, mappedBy: 'owner')]
    private Collection $playlistSubscriptions;

    /**
     * @var Collection<int, SubscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'owner')]
    private Collection $subscriptionHistories;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
        $this->playlistSubscriptions = new ArrayCollection();
        $this->subscriptionHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAccountstatus(): ?UserAccountStatusEnum
    {
        return $this->accountstatus;
    }

    public function setAccountstatus(UserAccountStatusEnum $accountstatus): static
    {
        $this->accountstatus = $accountstatus;

        return $this;
    }

    public function getCurrentSubscription(): ?Subscriptions
    {
        return $this->currentSubscription;
    }

    public function setCurrentSubscription(?Subscriptions $currentSubscription): static
    {
        $this->currentSubscription = $currentSubscription;

        return $this;
    }

    /**
     * @return Collection<int, Playlists>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlists $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->setOwner($this);
        }

        return $this;
    }

    public function removePlaylist(Playlists $playlist): static
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getOwner() === $this) {
                $playlist->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSubscriptions>
     */
    public function getPlaylistSubscriptions(): Collection
    {
        return $this->playlistSubscriptions;
    }

    public function addPlaylistSubscription(PlaylistSubscriptions $playlistSubscription): static
    {
        if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
            $this->playlistSubscriptions->add($playlistSubscription);
            $playlistSubscription->setOwner($this);
        }

        return $this;
    }

    public function removePlaylistSubscription(PlaylistSubscriptions $playlistSubscription): static
    {
        if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscription->getOwner() === $this) {
                $playlistSubscription->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SubscriptionHistory>
     */
    public function getSubscriptionHistories(): Collection
    {
        return $this->subscriptionHistories;
    }

    public function addSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if (!$this->subscriptionHistories->contains($subscriptionHistory)) {
            $this->subscriptionHistories->add($subscriptionHistory);
            $subscriptionHistory->setOwner($this);
        }

        return $this;
    }

    public function removeSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if ($this->subscriptionHistories->removeElement($subscriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionHistory->getOwner() === $this) {
                $subscriptionHistory->setOwner(null);
            }
        }

        return $this;
    }
}
