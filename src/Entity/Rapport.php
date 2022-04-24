<?php

namespace App\Entity;

use App\Repository\RapportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RapportRepository::class)
 */
class Rapport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Episode::class, cascade={"persist", "remove"})
     */
    private $ID_episode;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $ID_user;

    /**
     * @ORM\OneToMany(targetEntity=LikeRepondre::class, mappedBy="repondre")
     */
    private $likeRepondres;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Gedmo\Mapping\Annotation\Timestampable(on="create")
     * @Doctrine\ORM\Mapping\Column(type="datetime")
     */
    private $created_at; 

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Gedmo\Mapping\Annotation\Timestampable(on="update")
     * @Doctrine\ORM\Mapping\Column(type="datetime")
     */
    private $updated_at;


    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $deleted_at;

    public function __construct()
    {
        $this->likeRepondres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDEpisode(): ?Episode
    {
        return $this->ID_episode;
    }

    public function setIDEpisode(?Episode $ID_episode): self
    {
        $this->ID_episode = $ID_episode;

        return $this;
    }

    public function getIDUser(): ?User
    {
        return $this->ID_user;
    }

    public function setIDUser(?User $ID_user): self
    {
        $this->ID_user = $ID_user;

        return $this;
    }

    /**
     * @return Collection<int, LikeRepondre>
     */
    public function getLikeRepondres(): Collection
    {
        return $this->likeRepondres;
    }

    public function addLikeRepondre(LikeRepondre $likeRepondre): self
    {
        if (!$this->likeRepondres->contains($likeRepondre)) {
            $this->likeRepondres[] = $likeRepondre;
            $likeRepondre->setRepondre($this);
        }

        return $this;
    }

    public function removeLikeRepondre(LikeRepondre $likeRepondre): self
    {
        if ($this->likeRepondres->removeElement($likeRepondre)) {
            // set the owning side to null (unless already changed)
            if ($likeRepondre->getRepondre() === $this) {
                $likeRepondre->setRepondre(null);
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
