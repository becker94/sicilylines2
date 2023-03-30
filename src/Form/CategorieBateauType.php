<?php

namespace App\Form;

use App\Entity\CategorieBateau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\categorie;
use App\Entity\bateau;
class CategorieBateauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbMAx')
            ->add('categorie', EntityType::class, [
                'class'=> Categorie::class,
                'choice_label' => 'libelle',
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
            'data_class' => CategorieBateau::class,
        ]);
    }
}
