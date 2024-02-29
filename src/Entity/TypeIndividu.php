<?php

namespace App\Entity;

use App\Repository\TypeIndividuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeIndividuRepository::class)]
class TypeIndividu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

    #[ORM\Column(length: 20)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: Individu::class, mappedBy: 'typeindividu')]
    private Collection $individus;

    public function __construct()
    {
        $this->individus = new ArrayCollection();
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Individu>
     */
    public function getIndividus(): Collection
    {
        return $this->individus;
    }

    public function addIndividu(Individu $individu): static
    {
        if (!$this->individus->contains($individu)) {
            $this->individus->add($individu);
            $individu->setTypeindividu($this);
        }

        return $this;
    }

    public function removeIndividu(Individu $individu): static
    {
        if ($this->individus->removeElement($individu)) {
            // set the owning side to null (unless already changed)
            if ($individu->getTypeindividu() === $this) {
                $individu->setTypeindividu(null);
            }
        }

        return $this;
    }
}
