<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $numero = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEvaluation = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trimestre $trimestre = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    private ?Individu $individu = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matiere $matiere = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?College $college = null;

    #[ORM\OneToMany(targetEntity: LigneEvaluation::class, mappedBy: 'evaluation')]
    private Collection $ligneEvaluations;

    public function __construct()
    {
        $this->ligneEvaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDateEvaluation(): ?\DateTimeInterface
    {
        return $this->dateEvaluation;
    }

    public function setDateEvaluation(\DateTimeInterface $dateEvaluation): static
    {
        $this->dateEvaluation = $dateEvaluation;

        return $this;
    }

    public function getTrimestre(): ?Trimestre
    {
        return $this->trimestre;
    }

    public function setTrimestre(?Trimestre $trimestre): static
    {
        $this->trimestre = $trimestre;

        return $this;
    }

    public function getIndividu(): ?Individu
    {
        return $this->individu;
    }

    public function setIndividu(?Individu $individu): static
    {
        $this->individu = $individu;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getCollege(): ?College
    {
        return $this->college;
    }

    public function setCollege(?College $college): static
    {
        $this->college = $college;

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
            $ligneEvaluation->setEvaluation($this);
        }

        return $this;
    }

    public function removeLigneEvaluation(LigneEvaluation $ligneEvaluation): static
    {
        if ($this->ligneEvaluations->removeElement($ligneEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($ligneEvaluation->getEvaluation() === $this) {
                $ligneEvaluation->setEvaluation(null);
            }
        }

        return $this;
    }
}
