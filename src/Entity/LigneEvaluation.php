<?php

namespace App\Entity;

use App\Repository\LigneEvaluationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneEvaluationRepository::class)]
class LigneEvaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $appreciation = null;

    #[ORM\ManyToOne(inversedBy: 'ligneEvaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evaluation $evaluation = null;

    #[ORM\ManyToOne(inversedBy: 'ligneEvaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Individu $individu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getAppreciation(): ?string
    {
        return $this->appreciation;
    }

    public function setAppreciation(?string $appreciation): static
    {
        $this->appreciation = $appreciation;

        return $this;
    }

    public function getEvaluation(): ?Evaluation
    {
        return $this->evaluation;
    }

    public function setEvaluation(?Evaluation $evaluation): static
    {
        $this->evaluation = $evaluation;

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
}
