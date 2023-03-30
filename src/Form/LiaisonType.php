<?php

namespace App\Form;

use App\Entity\Liaison;
use App\Entity\Port;
use App\Entity\Secteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class LiaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duree')
            ->add('port_depart', EntityType::class, [
                'class'=> Port::class,
                'choice_label' => 'nom',
            ])
            ->add('port_arrive', EntityType::class, [
                'class'=> Port::class,
                'choice_label' => 'nom',
            ])
            ->add('secteur', EntityType::class, [
                'class'=> Secteur::class,
                'choice_label' => 'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Liaison::class,
        ]);
    }
}
