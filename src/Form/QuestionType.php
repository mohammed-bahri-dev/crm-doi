<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Technology;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => '...?',
                ],
            ])
            ->add('date', DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('person', EntityType::class,
            ['class' => User::class, 'choice_label' => 'username', 'label' => false]
            )
            ->add('technology', EntityType::class,
            ['class' => Technology::class, 'choice_label' => 'name', 'label' => false]
            )
            ->add('event', EntityType::class,
            ['class' => Event::class, 'choice_label' => 'name', 'label' => false]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
