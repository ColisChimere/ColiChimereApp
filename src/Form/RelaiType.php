<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Relai;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelaiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomRelai')
            ->add('adresse', Adresse2Type::class)
            // ->add('adresse', EntityType::class, [
            //     'class' => Adresse::class,
            //     'choice_label' => 'id',
            // ])
            ->add('Cree', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Relai::class,
        ]);
    }
}
