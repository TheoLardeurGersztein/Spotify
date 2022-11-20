<?php

namespace App\Entity;

use App\Repository\SharedPlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SharedPlaylistRepository::class)]
class SharedPlaylist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $published = null;

    #[ORM\ManyToOne(inversedBy: 'sharedPlaylists')]
    private ?Membre $creator = null;

    #[ORM\ManyToMany(targetEntity: Music::class, inversedBy: 'sharedPlaylists')]
    private Collection $musics;

    public function __construct()
    {
        $this->musics = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString() 
    {
        return $this->description;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getCreator(): ?Membre
    {
        return $this->creator;
    }

    public function setCreator(?Membre $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, Music>
     */
    public function getMusics(): Collection
    {
        return $this->musics;
    }

    public function addMusic(Music $music): self
    {
        if (!$this->musics->contains($music)) {
            $this->musics->add($music);
        }

        return $this;
    }

    public function removeMusic(Music $music): self
    {
        $this->musics->removeElement($music);

        return $this;
    }
}
