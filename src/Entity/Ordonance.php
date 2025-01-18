<?php

namespace App\Entity;

use App\Repository\OrdonanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdonanceRepository::class)]
class Ordonance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOrdo = null;

    #[ORM\Column(length: 255)]
    private ?string $medicament = null;

    #[ORM\ManyToOne(inversedBy: 'ordonances')]
    private ?medecin $medecin = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?consultation $consultation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOrdo(): ?\DateTimeInterface
    {
        return $this->dateOrdo;
    }

    public function setDateOrdo(\DateTimeInterface $dateOrdo): static
    {
        $this->dateOrdo = $dateOrdo;

        return $this;
    }

    public function getMedicament(): ?string
    {
        return $this->medicament;
    }

    public function setMedicament(string $medicament): static
    {
        $this->medicament = $medicament;

        return $this;
    }

    public function getMedecin(): ?medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getConsultation(): ?consultation
    {
        return $this->consultation;
    }

    public function setConsultation(?consultation $consultation): static
    {
        $this->consultation = $consultation;

        return $this;
    }
}
