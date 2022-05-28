<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
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
    private $nom_de_role;

  

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

    /**
     * @ORM\ManyToMany(targetEntity=Episode::class, mappedBy="Role")
     */
    private $episodes;

    /**
     * @ORM\ManyToMany(targetEntity=Acteur::class, inversedBy="roles")
     */
    private $acteur;

    public function __construct()
    {
        $this->acteur = new ArrayCollection();
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDeRole(): ?string
    {
        return $this->nom_de_role;
    }

    public function setNomDeRole(string $nom_de_role): self
    {
        $this->nom_de_role = $nom_de_role;

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

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): self
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes[] = $episode;
            $episode->addRole($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): self
    {
        if ($this->episodes->removeElement($episode)) {
            $episode->removeRole($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Acteur>
     */
    public function getActeur(): Collection
    {
        return $this->acteur;
    }

    public function addActeur(Acteur $acteur): self
    {
        if (!$this->acteur->contains($acteur)) {
            $this->acteur[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Acteur $acteur): self
    {
        $this->acteur->removeElement($acteur);

        return $this;
    }
}
