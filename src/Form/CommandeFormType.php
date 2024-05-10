<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Livraision;
use App\Entity\Relai;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('masse')
            ->add('largeCol')
            ->add('longCol')
            ->add('hauteurCol')
            ->add('userCible', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
