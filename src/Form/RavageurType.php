<?php

namespace App\Form;

use App\Entity\Ravageur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RavageurType extends BioagresseurType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        parent::buildForm($builder, $options);
        $builder
            ->add('stadeactif',null,[
                'label' => 'Stade actif'
            ])
            ->add('nbgenerations',null,[
                'label' => 'Nombre de générations'
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ravageur::class,
        ]);
    }
}