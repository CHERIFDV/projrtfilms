<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EpisodeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @ORM\Entity(repositoryClass=EpisodeRepository::class)
 */
class Episode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Titre;

    /**
     * @ORM\Column(type="time")
     */
    private $Duree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Resume;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Realise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="integer")
     */
    private $Nb_view;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $langue;

    /**
     * @ORM\Column(type="integer")
     */
    private $Numero_episode;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_commenter;

    /**
     * @ORM\ManyToOne(targetEntity=Ouevre::class, inversedBy="episodes")
     */
    private $Id_ouevre;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="episodes")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="Episode")
     */
    private $avis;

    /**
     * @ORM\OneToMany(targetEntity=Commenter::class, mappedBy="episode")
     */
    private $commenters;

    /**
     * @ORM\ManyToOne(targetEntity=Pay::class, inversedBy="episodes")
     */
    private $pay;

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
        $this->categories = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->commenters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->Duree;
    }

    public function setDuree(\DateTimeInterface $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->Resume;
    }

    public function setResume(string $Resume): self
    {
        $this->Resume = $Resume;

        return $this;
    }

    public function getRealise(): ?string
    {
        return $this->Realise;
    }

    public function setRealise(string $Realise): self
    {
        $this->Realise = $Realise;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getNbView(): ?int
    {
        return $this->Nb_view;
    }

    public function setNbView(int $Nb_view): self
    {
        $this->Nb_view = $Nb_view;

        return $this;
    }

    

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        
        $this->langue = $langue;

        return $this;
    }


    public function getNumeroEpisode(): ?int
    {
        return $this->Numero_episode;
    }

    public function setNumeroEpisode(int $Numero_episode): self
    {
        $this->Numero_episode = $Numero_episode;

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
    public function __toString() {
        return $this->Titre;
    }

    public function getNbCommenter(): ?int
    {
        return $this->nb_commenter;
    }

    public function setNbCommenter(int $nb_commenter): self
    {
        $this->nb_commenter = $nb_commenter;

        return $this;
    }

    public function getIdOuevre(): ?Ouevre
    {
        return $this->Id_ouevre;
    }

    public function setIdOuevre(?Ouevre $Id_ouevre): self
    {
        $this->Id_ouevre = $Id_ouevre;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        $this->categories->removeElement($category);

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
            $avi->setEpisode($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getEpisode() === $this) {
                $avi->setEpisode(null);
            }
        }

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
            $commenter->setEpisode($this);
        }

        return $this;
    }

    public function removeCommenter(Commenter $commenter): self
    {
        if ($this->commenters->removeElement($commenter)) {
            // set the owning side to null (unless already changed)
            if ($commenter->getEpisode() === $this) {
                $commenter->setEpisode(null);
            }
        }

        return $this;
    }

    public function getPay(): ?Pay
    {
        return $this->pay;
    }

    public function setPay(?Pay $pay): self
    {
        $this->pay = $pay;

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
