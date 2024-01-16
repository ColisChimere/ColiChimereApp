<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rue')
            ->add('numRue')
            ->add('communSIREN', ChoiceType::class, array(
                'label' => 'Ville',
                'choices' => ['non renseigné' => 0],
                'attr' => [
                        'id' => 'ville-combobox'
                    ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
