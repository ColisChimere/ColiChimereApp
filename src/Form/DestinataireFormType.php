<?php

namespace App\Form;

use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Adresse;
use App\Entity\User;
use App\Form\AdresseType;
use App\Form\RegistrationFormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DestinataireFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Register', RegistrationFormType::class)
            ->add('adr', AdresseType::class)
            ->add('vill', VilleType::class)
            ->add('Terminer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
