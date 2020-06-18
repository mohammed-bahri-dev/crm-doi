<?php

// src/Form/UserType.php
namespace App\Form;

use App\Entity\User;
use App\Entity\CaEntity;
use App\Entity\PreferredContact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, ['label' => false])
            ->add('username', TextType::class, ['label' => false])
            ->add('poste', TextType::class, ['label' => false])
            ->add('firstname', TextType::class, ['label' => false])
            ->add('lastname', TextType::class, ['label' => false])
            ->add('phone', TextType::class, ['label' => false])
            ->add('mobile', TextType::class, ['label' => false])
            ->add('address', TextType::class, ['label' => false])
            ->add('preferredContact', EntityType::class,
            ['class' => PreferredContact::class, 'choice_label' => 'mode', 'label' => false]
            )
            ->add('caentity', EntityType::class,
            ['class' => CaEntity::class, 'choice_label' => 'name', 'label' => false]
            )
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password', 'label' => false,
                'attr' => [
                    'placeholder' => 'Entrer un mot de passe',
                ]
            ),
                'second_options' => array('label' => 'Repeat Password', 'label' => false,
                'attr' => [
                    'placeholder' => 'Confirmer le mot de passe',
                ]
            ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
