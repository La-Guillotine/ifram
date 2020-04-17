<?php

namespace App\Form;

use App\Entity\Ravageur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RavageurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('type')
            ->add('periodesrisques')
            ->add('symptomes')
            ->add('stadesensible')
            ->add('stadeactif')
            ->add('nbgenerations')
            ->add('plantes_sensibles')
            ->add('organes')
            ->add('traitements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ravageur::class,
        ]);
    }
}
