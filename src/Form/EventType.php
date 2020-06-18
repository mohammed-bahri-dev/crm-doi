<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\User;
use App\Entity\TypeOfEvent;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => false])
            ->add('startDate', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('endDate', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('location', TextType::class, ['label' => false])
            ->add('thematic', TextType::class, ['label' => false])
            ->add('typeOfEvent', EntityType::class,
            ['class' => TypeOfEvent::class, 'choice_label' => 'name', 'label' => false]
            )
            ->add('organizer', EntityType::class,
            ['class' => User::class, 'choice_label' => 'username', 'label' => false]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
