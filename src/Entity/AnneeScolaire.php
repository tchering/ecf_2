<?php

namespace App\Entity;

use App\Repository\AnneeScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeScolaireRepository::class)]
class AnneeScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $code = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(targetEntity: Trimestre::class, mappedBy: 'anneescolaire')]
    private Collection $trimestres;

    public function __construct()
    {
        $this->trimestres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Trimestre>
     */
    public function getTrimestres(): Collection
    {
        return $this->trimestres;
    }

    public function addTrimestre(Trimestre $trimestre): static
    {
        if (!$this->trimestres->contains($trimestre)) {
            $this->trimestres->add($trimestre);
            $trimestre->setAnneescolaire($this);
        }

        return $this;
    }

    public function removeTrimestre(Trimestre $trimestre): static
    {
        if ($this->trimestres->removeElement($trimestre)) {
            // set the owning side to null (unless already changed)
            if ($trimestre->getAnneescolaire() === $this) {
                $trimestre->setAnneescolaire(null);
            }
        }

        return $this;
    }
}
