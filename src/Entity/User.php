<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="user")
     */
    private $avis;

    /**
     * @ORM\ManyToOne(targetEntity=Abonnement::class, inversedBy="user")
     */
    private $abonnement;

    /**
     * @ORM\OneToMany(targetEntity=Commenter::class, mappedBy="user")
     */
    private $commenters;

    /**
     * @ORM\OneToMany(targetEntity=Favorie::class, mappedBy="user")
     */
    private $favories;

    /**
     * @ORM\OneToMany(targetEntity=LikeCommenter::class, mappedBy="user")
     */
    private $likeCommenters;

    /**
     * @ORM\OneToMany(targetEntity=Repondre::class, mappedBy="user")
     */
    private $repondres;

    /**
     * @ORM\OneToMany(targetEntity=LikeRepondre::class, mappedBy="user")
     */
    private $likeRepondres;

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
        $this->abonnements = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->commenters = new ArrayCollection();
        $this->favories = new ArrayCollection();
        $this->likeCommenters = new ArrayCollection();
        $this->repondres = new ArrayCollection();
        $this->likeRepondres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setUser($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getUser() === $this) {
                $avi->setUser(null);
            }
        }

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    /**
     * @return Collection<int, Commenter>
     */
    public function getCommenters(): Collection
    {
        return $this->commenters;
    }

    public function addCommenter(Commenter $commenter): self
    {
        if (!$this->commenters->contains($commenter)) {
            $this->commenters[] = $commenter;
            $commenter->setUser($this);
        }

        return $this;
    }

    public function removeCommenter(Commenter $commenter): self
    {
        if ($this->commenters->removeElement($commenter)) {
            // set the owning side to null (unless already changed)
            if ($commenter->getUser() === $this) {
                $commenter->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorie>
     */
    public function getFavories(): Collection
    {
        return $this->favories;
    }

    public function addFavory(Favorie $favory): self
    {
        if (!$this->favories->contains($favory)) {
            $this->favories[] = $favory;
            $favory->setUser($this);
        }

        return $this;
    }

    public function removeFavory(Favorie $favory): self
    {
        if ($this->favories->removeElement($favory)) {
            // set the owning side to null (unless already changed)
            if ($favory->getUser() === $this) {
                $favory->setUser(null);
            }
        }

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
            $likeCommenter->setUser($this);
        }

        return $this;
    }

    public function removeLikeCommenter(LikeCommenter $likeCommenter): self
    {
        if ($this->likeCommenters->removeElement($likeCommenter)) {
            // set the owning side to null (unless already changed)
            if ($likeCommenter->getUser() === $this) {
                $likeCommenter->setUser(null);
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
            $repondre->setUser($this);
        }

        return $this;
    }

    public function removeRepondre(Repondre $repondre): self
    {
        if ($this->repondres->removeElement($repondre)) {
            // set the owning side to null (unless already changed)
            if ($repondre->getUser() === $this) {
                $repondre->setUser(null);
            }
        }

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
            $likeRepondre->setUser($this);
        }

        return $this;
    }

    public function removeLikeRepondre(LikeRepondre $likeRepondre): self
    {
        if ($this->likeRepondres->removeElement($likeRepondre)) {
            // set the owning side to null (unless already changed)
            if ($likeRepondre->getUser() === $this) {
                $likeRepondre->setUser(null);
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
