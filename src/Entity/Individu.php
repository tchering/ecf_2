<?php

namespace App\Entity;

use App\Repository\IndividuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndividuRepository::class)]
class Individu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $numeroMatricule = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $telephone = null;

    #[ORM\ManyToOne(inversedBy: 'individus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeIndividu $typeindividu = null;

    #[ORM\ManyToOne(inversedBy: 'individus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $classe = null;

    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'individu')]
    private Collection $evaluations;

    #[ORM\OneToMany(targetEntity: LigneEvaluation::class, mappedBy: 'individu')]
    private Collection $ligneEvaluations;

    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
        $this->ligneEvaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroMatricule(): ?string
    {
        return $this->numeroMatricule;
    }

    public function setNumeroMatricule(string $numeroMatricule): static
    {
        $this->numeroMatricule = $numeroMatricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTypeindividu(): ?TypeIndividu
    {
        return $this->typeindividu;
    }

    public function setTypeindividu(?TypeIndividu $typeindividu): static
    {
        $this->typeindividu = $typeindividu;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): static
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setIndividu($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): static
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getIndividu() === $this) {
                $evaluation->setIndividu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LigneEvaluation>
     */
    public function getLigneEvaluations(): Collection
    {
        return $this->ligneEvaluations;
    }

    public function addLigneEvaluation(LigneEvaluation $ligneEvaluation): static
    {
        if (!$this->ligneEvaluations->contains($ligneEvaluation)) {
            $this->ligneEvaluations->add($ligneEvaluation);
            $ligneEvaluation->setIndividu($this);
        }

        return $this;
    }

    public function removeLigneEvaluation(LigneEvaluation $ligneEvaluation): static
    {
        if ($this->ligneEvaluations->removeElement($ligneEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($ligneEvaluation->getIndividu() === $this) {
                $ligneEvaluation->setIndividu(null);
            }
        }

        return $this;
    }
}
