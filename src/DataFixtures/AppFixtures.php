<?php

namespace App\DataFixtures;

use App\Entity\Consultation;
use App\Entity\Medecin;
use App\Entity\Ordonance;
use App\Entity\Patient;
use App\Entity\Secretaire;
use App\Entity\RendezVous;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Initialisation de Faker pour générer des données aléatoires
        $faker = Factory::create('fr_FR'); // Utilisation de la locale française

        // Tableaux pour stocker les entités persistées
        $patients = [];
        $medecins = [];
        $secretaires = [];
        $consultations = [];

        // Création de 10 Patients
        for ($i = 0; $i < 10; $i++) {
            $patient = new Patient();
            $patient->setNomPatient($faker->lastName);
            $patient->setPrenomPatient($faker->firstName);
            $patient->setSexe($faker->randomElement(['Homme', 'Femme']));
            $patient->setAdresse($faker->address);
            $patient->setNumTel($faker->phoneNumber);
            $patient->setDateNaissance($faker->dateTimeBetween('-50 years', '-20 years'));
            $patient->setAssurance($faker->company);

            $manager->persist($patient);
            $patients[] = $patient; // Ajout du patient au tableau
        }

        // Création de 10 Médecins
        for ($i = 0; $i < 10; $i++) {
            $medecin = new Medecin();
            $medecin->setNomMed($faker->lastName);
            $medecin->setPrenomMed($faker->firstName);
            $medecin->setSpecialite($faker->randomElement(['Cardiologue', 'Dentiste', 'Gynecologue', 'Pediatre', 'Generaliste']));
            $medecin->setAdresse($faker->address);
            $medecin->setNumTel($faker->phoneNumber);

            $manager->persist($medecin);
            $medecins[] = $medecin; // Ajout du médecin au tableau
        }

        // Création de 10 Secrétaires
        for ($i = 0; $i < 10; $i++) {
            $secretaire = new Secretaire();
            $secretaire->setNomSec($faker->lastName);
            $secretaire->setPrenomSec($faker->firstName);
            $secretaire->setAdresse($faker->address);
            $secretaire->setNumTel($faker->phoneNumber);

            $manager->persist($secretaire);
            $secretaires[] = $secretaire; // Ajout du secrétaire au tableau
        }

        // Persistez toutes les entités parentes avant de créer les relations
        $manager->flush();

        // Création de 10 RendezVous
        for ($i = 0; $i < 10; $i++) {
            $rdv = new RendezVous();
            $rdv->setDateRV($faker->dateTimeBetween('now', '+1 year'));
            $rdv->setPatient($faker->randomElement($patients)); // Associer un patient aléatoire
            $rdv->setSecretaire($faker->randomElement($secretaires)); // Associer un secrétaire aléatoire

            $manager->persist($rdv);
        }

        // Création de 10 Consultations
        for ($i = 0; $i < 10; $i++) {
            $consultation = new Consultation();
            $consultation->setDateCons($faker->dateTimeBetween('now', '+1 year'));
            $consultation->setPatient($faker->randomElement($patients)); // Associer un patient aléatoire
            $consultation->setMedecin($faker->randomElement($medecins)); // Associer un médecin aléatoire
            $consultation->setPoid($faker->randomFloat(2, 40, 120)); // Poids aléatoire
            $consultation->setTaille($faker->randomFloat(2, 1.2, 2.2)); // Taille aléatoire
            $consultation->setPrix($faker->randomFloat(2, 20, 100)); // Prix aléatoire
            $consultation->setEtatPatient($faker->sentence); // État du patient aléatoire
            $consultation->setHta($faker->sentence); // HTA aléatoire
            $consultation->setMalade($faker->sentence); // Maladie aléatoire

            $manager->persist($consultation);
            $consultations[] = $consultation; // Ajout de la consultation au tableau
        }

        // Création de 10 Ordonances
        for ($i = 0; $i < 10; $i++) {
            $ordonnance = new Ordonance();
            $ordonnance->setDateOrdo($faker->dateTimeBetween('now', '+1 year'));
            $ordonnance->setConsultation($consultations[$i]); // Associer une consultation unique
            $ordonnance->setMedecin($faker->randomElement($medecins));
            $ordonnance->setMedicament($faker->sentence); // Médicament aléatoire

            $manager->persist($ordonnance);
        }

        // Persistez toutes les entités en base de données
        $manager->flush();
    }
}