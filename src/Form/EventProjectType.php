<?php

namespace App\Form;

use App\Entity\EventProject;
use App\Entity\TypeOfEventProject;
use App\Entity\ProjectStatus;
use App\Entity\User;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('typeOfEventProject', EntityType::class,
            ['class' => TypeOfEventProject::class, 'choice_label' => 'action', 'label' => false]
            )
            ->add('projectStatus', EntityType::class,
            ['class' => ProjectStatus::class, 'choice_label' => 'status', 'label' => false]
            )
            ->add('person', EntityType::class,
            ['class' => User::class, 'choice_label' => 'username', 'label' => false]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EventProject::class,
        ]);
    }
}
