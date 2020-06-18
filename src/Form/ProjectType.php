<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Technology;
use App\Entity\TypeOfProject;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => false])
            ->add('code', TextType::class, ['label' => false])
            ->add('impact', TextType::class, ['label' => false])
            ->add('technology', EntityType::class,
            ['class' => Technology::class, 'choice_label' => 'name', 'label' => false]
            )
            ->add('typeOfProject', EntityType::class,
            ['class' => TypeOfProject::class, 'choice_label' => 'type', 'label' => false]
            )
            ->add('useCase', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Description du projet',
                ],
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
