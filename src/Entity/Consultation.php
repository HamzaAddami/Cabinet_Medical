<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCons = null;

    #[ORM\Column(length: 255)]
    private ?string $poid = null;

    #[ORM\Column(length: 255)]
    private ?string $taille = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $etatPatient = null;

    #[ORM\Column(length: 255)]
    private ?string $hta = null;

    #[ORM\Column(length: 255)]
    private ?string $malade = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?medecin $medecin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCons(): ?\DateTimeInterface
    {
        return $this->dateCons;
    }

    public function setDateCons(\DateTimeInterface $dateCons): static
    {
        $this->dateCons = $dateCons;

        return $this;
    }

    public function getPoid(): ?string
    {
        return $this->poid;
    }

    public function setPoid(string $poid): static
    {
        $this->poid = $poid;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtatPatient(): ?string
    {
        return $this->etatPatient;
    }

    public function setEtatPatient(string $etatPatient): static
    {
        $this->etatPatient = $etatPatient;

        return $this;
    }

    public function getHta(): ?string
    {
        return $this->hta;
    }

    public function setHta(string $hta): static
    {
        $this->hta = $hta;

        return $this;
    }

    public function getMalade(): ?string
    {
        return $this->malade;
    }

    public function setMalade(string $malade): static
    {
        $this->malade = $malade;

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
}
