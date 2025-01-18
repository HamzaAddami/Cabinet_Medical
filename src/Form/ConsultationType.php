<?php

namespace App\Form;

use App\Entity\Consultation;
use App\Entity\medecin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateCons', null, [
                'widget' => 'single_text',
            ])
            ->add('poid')
            ->add('taille')
            ->add('prix')
            ->add('etatPatient')
            ->add('hta')
            ->add('malade')
            ->add('medecin', EntityType::class, [
                'class' => medecin::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
