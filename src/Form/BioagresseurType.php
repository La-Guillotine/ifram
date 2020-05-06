<?php

namespace App\Form;

use App\Entity\Bioagresseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BioagresseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('type')
            ->add('periodesrisques')
            ->add('symptomes')
            ->add('stadesensible')
            ->add('plantes_sensibles')
            ->add('organes')
            ->add('traitements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bioagresseur::class,
        ]);
    }
}
