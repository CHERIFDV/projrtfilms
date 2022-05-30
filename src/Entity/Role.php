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
     * @ORM\ManyToOne(targetEntity=Acteur::class, inversedBy="roles")
     */
    private $Acteurs;

    /**
     * @ORM\ManyToOne(targetEntity=Episode::class, inversedBy="roles")
     */
    private $Episode;

    

   

    

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

  

    public function getActeurs(): ?Acteur
    {
        return $this->Acteurs;
    }

    public function setActeurs(?Acteur $Acteurs): self
    {
        $this->Acteurs = $Acteurs;

        return $this;
    }

    public function getEpisode(): ?Episode
    {
        return $this->Episode;
    }

    public function setEpisode(?Episode $Episode): self
    {
        $this->Episode = $Episode;

        return $this;
    }

    

}
