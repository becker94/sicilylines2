<?php

namespace App\Form;

use App\Entity\LiaisonPeriodeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\periode;
use App\Entity\liaison;
use App\Entity\type;

class LiaisonPeriodeTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tarif')
           
            
           
            ->add('periode', EntityType::class, [
                'class'=> Periode::class,
                'choice_label' => 'nom',
            ])
            
            ->add('liaison', EntityType::class, [
                'class'=> Liaison::class,
                'choice_label' => 'id',
            ])

            ->add('type', EntityType::class, [
                'class'=> Type::class,
                'choice_label' => 'nom',
            ])

        ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LiaisonPeriodeType::class,
        ]);
    }
}
