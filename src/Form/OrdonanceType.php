<?php

namespace App\Form;

use App\Entity\consultation;
use App\Entity\medecin;
use App\Entity\Ordonance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdonanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateOrdo', null, [
                'widget' => 'single_text',
            ])
            ->add('medicament')
            ->add('medecin', EntityType::class, [
                'class' => medecin::class,
                'choice_label' => 'id',
            ])
            ->add('consultation', EntityType::class, [
                'class' => consultation::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ordonance::class,
        ]);
    }
}
