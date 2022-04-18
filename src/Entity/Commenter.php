<?php

namespace App\Entity;

use App\Repository\CommenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommenterRepository::class)
 */
class Commenter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Message;

    /**
     * @ORM\Column(type="integer")
     */
    private $NB_like;

    /**
     * @ORM\ManyToOne(targetEntity=Episode::class, inversedBy="commenters")
     */
    private $episode;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commenters")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=LikeCommenter::class, mappedBy="commenter")
     */
    private $likeCommenters;

    /**
     * @ORM\OneToMany(targetEntity=Repondre::class, mappedBy="commenter")
     */
    private $repondres;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $deleted_at;

    public function __construct()
    {
        $this->likeCommenters = new ArrayCollection();
        $this->repondres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }

    public function getNBLike(): ?int
    {
        return $this->NB_like;
    }

    public function setNBLike(int $NB_like): self
    {
        $this->NB_like = $NB_like;

        return $this;
    }

    public function getEpisode(): ?Episode
    {
        return $this->episode;
    }

    public function setEpisode(?Episode $episode): self
    {
        $this->episode = $episode;

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

    /**
     * @return Collection<int, LikeCommenter>
     */
    public function getLikeCommenters(): Collection
    {
        return $this->likeCommenters;
    }

    public function addLikeCommenter(LikeCommenter $likeCommenter): self
    {
        if (!$this->likeCommenters->contains($likeCommenter)) {
            $this->likeCommenters[] = $likeCommenter;
            $likeCommenter->setCommenter($this);
        }

        return $this;
    }

    public function removeLikeCommenter(LikeCommenter $likeCommenter): self
    {
        if ($this->likeCommenters->removeElement($likeCommenter)) {
            // set the owning side to null (unless already changed)
            if ($likeCommenter->getCommenter() === $this) {
                $likeCommenter->setCommenter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Repondre>
     */
    public function getRepondres(): Collection
    {
        return $this->repondres;
    }

    public function addRepondre(Repondre $repondre): self
    {
        if (!$this->repondres->contains($repondre)) {
            $this->repondres[] = $repondre;
            $repondre->setCommenter($this);
        }

        return $this;
    }

    public function removeRepondre(Repondre $repondre): self
    {
        if ($this->repondres->removeElement($repondre)) {
            // set the owning side to null (unless already changed)
            if ($repondre->getCommenter() === $this) {
                $repondre->setCommenter(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): self
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }
}
