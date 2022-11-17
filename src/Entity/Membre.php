<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'membre', targetEntity: Playlist::class)]
    private Collection $playlists;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: SharedPlaylist::class)]
    private Collection $sharedPlaylists;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
        $this->sharedPlaylists = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString() 
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): self
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->setMembre($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getMembre() === $this) {
                $playlist->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SharedPlaylist>
     */
    public function getSharedPlaylists(): Collection
    {
        return $this->sharedPlaylists;
    }

    public function addSharedPlaylist(SharedPlaylist $sharedPlaylist): self
    {
        if (!$this->sharedPlaylists->contains($sharedPlaylist)) {
            $this->sharedPlaylists->add($sharedPlaylist);
            $sharedPlaylist->setCreator($this);
        }

        return $this;
    }

    public function removeSharedPlaylist(SharedPlaylist $sharedPlaylist): self
    {
        if ($this->sharedPlaylists->removeElement($sharedPlaylist)) {
            // set the owning side to null (unless already changed)
            if ($sharedPlaylist->getCreator() === $this) {
                $sharedPlaylist->setCreator(null);
            }
        }

        return $this;
    }
}
