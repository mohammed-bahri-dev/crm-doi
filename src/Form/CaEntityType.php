<?php

namespace App\Form;

use App\Entity\CaEntity;
use App\Entity\User;
use App\Entity\TypeOfCaEntity;
use App\Entity\PartnerStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CaEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => false])
            ->add('Address', TextType::class, ['label' => false])
            ->add('department', TextType::class, ['label' => false])
            ->add('privilegedContact', EntityType::class,
            ['class' => User::class, 'choice_label' => 'username', 'label' => false]
            )
            ->add('innovationContact', EntityType::class,
            ['class' => User::class, 'choice_label' => 'username', 'label' => false]
            )
            ->add('iBusinessContact', EntityType::class,
            ['class' => User::class, 'choice_label' => 'username', 'label' => false]
            )
            ->add('typeOfCaEntity', EntityType::class,
            ['class' => TypeOfCaEntity::class, 'choice_label' => 'name', 'label' => false]
            )
            ->add('partnerStatus', EntityType::class,
            ['class' => PartnerStatus::class, 'choice_label' => 'name', 'label' => false]
            )
            ->add('interestLevel', IntegerType::class, ['label' => false])
            ->add('innovationProfile', TextType::class, ['label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CaEntity::class,
        ]);
    }
}
