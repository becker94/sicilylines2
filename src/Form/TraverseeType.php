<?php

namespace App\Form;

use App\Entity\Traversee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Bateau;
use App\Entity\Liaison;

class TraverseeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('heure')
            ->add('liaison', EntityType::class, [
                'class'=> Liaison::class,
                'choice_label' => 'id',
            ])
            ->add('bateau', EntityType::class, [
                'class'=> Bateau::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Traversee::class,
        ]);
    }
}