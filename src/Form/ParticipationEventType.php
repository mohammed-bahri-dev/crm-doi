<?php

namespace App\Form;

use App\Entity\ParticipationEvent;
use App\Entity\Event;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ParticipationEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('event', EntityType::class,
            ['class' => Event::class, 'choice_label' => 'name', 'label' => false]
            )
            ->add('participant', EntityType::class,
            ['class' => User::class, 'choice_label' => 'username', 'label' => false]
            )  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ParticipationEvent::class,
        ]);
    }
}
