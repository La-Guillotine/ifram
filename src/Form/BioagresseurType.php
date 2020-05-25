<?php

namespace App\Form;

use App\Entity\Bioagresseur;
use App\Entity\Maladie;
use App\Entity\Ravageur;
use App\Entity\Plante;
use App\Entity\Organe;
use App\Entity\Traitement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('periodesrisques',null,[
                'label' => 'Périodes de risques'
            ])
            ->add('symptomes',null,[
                'label' => 'Symptômes'
            ])
            ->add('stadesensible',null,[
                'label' => 'Stade sensible'
            ])
            ->add('plantes_sensibles', EntityType::class, [
                'class' => Plante::class,
                'label' => 'Plante(s) sensible(s)',
                'choice_label' => 'nom',
                'multiple'=> true
            ])
            ->add('organes', EntityType::class, [
                'class' => Organe::class,
                'label' => 'Organe(s) affecté(s)',
                'choice_label' => 'nom',
                'multiple'=> true
            ])
            ->add('traitements', EntityType::class, [
                'class' => Traitement::class,
                'label' => 'Traitement(s)',
                'choice_label' => 'nom',
                'multiple'=> true,
                'required'=> false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bioagresseur::class,
        ]);
    }
}