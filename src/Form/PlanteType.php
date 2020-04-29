<?php

namespace App\Form;

use App\Entity\Plante;
use App\Entity\Bioagresseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('descriptif', TextAreaType::class,[

            ])
            ->add('image',FileType::class,[
                'label' => 'Photo de la plante',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/svg',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ]
            ])
            ->add('sensible', EntityType::class, [
                'class' => Bioagresseur::class,
                'choice_label' => 'nom',
                'multiple'=> true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plante::class,
        ]);
    }
}
