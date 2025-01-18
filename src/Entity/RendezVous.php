<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRV = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?Secretaire $secretaire = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?Patient $patient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRV(): ?\DateTimeInterface
    {
        return $this->dateRV;
    }

    public function setDateRV(\DateTimeInterface $dateRV): static
    {
        $this->dateRV = $dateRV;

        return $this;
    }

    public function getSecretaire(): ?secretaire
    {
        return $this->secretaire;
    }

    public function setSecretaire(?secretaire $secretaire): static
    {
        $this->secretaire = $secretaire;

        return $this;
    }

    public function getPatient(): ?patient
    {
        return $this->patient;
    }

    public function setPatient(?patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }
}
