<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('longueur')
            ->add('largeur')
            ->add('hauteur')
            ->add('masse')
            ->add('user', ChoiceType::class, [
                'choices' => $options['users'],
                'choice_label' => function($user) {
                    return $user->getPseudo();
                },
                'choice_value' => function(?User $user) {
                    return $user ? $user->getId() : '';
                }
            ])
            ->add('Valider', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label'=>'Valider'
            ])
        ;

    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
            'users' => [],
            'choices' => [],
        ]);
    }
}