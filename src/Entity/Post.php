<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $body = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'saved')]
    private Collection $saved_by_users;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'liked')]
    private Collection $liked_by_users;

    public function __construct()
    {
        $this->saved_by_users = new ArrayCollection();
        $this->liked_by_users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSavedByUsers(): Collection
    {
        return $this->saved_by_users;
    }

    public function addSavedByUser(User $savedByUser): static
    {
        if (!$this->saved_by_users->contains($savedByUser)) {
            $this->saved_by_users->add($savedByUser);
            $savedByUser->addSaved($this);
        }

        return $this;
    }

    public function removeSavedByUser(User $savedByUser): static
    {
        if ($this->saved_by_users->removeElement($savedByUser)) {
            $savedByUser->removeSaved($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getLikedByUsers(): Collection
    {
        return $this->liked_by_users;
    }

    public function addLikedByUser(User $likedByUser): static
    {
        if (!$this->liked_by_users->contains($likedByUser)) {
            $this->liked_by_users->add($likedByUser);
            $likedByUser->addLiked($this);
        }

        return $this;
    }

    public function removeLikedByUser(User $likedByUser): static
    {
        if ($this->liked_by_users->removeElement($likedByUser)) {
            $likedByUser->removeLiked($this);
        }

        return $this;
    }
}
