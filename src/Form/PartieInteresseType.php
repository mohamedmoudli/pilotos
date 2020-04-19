<?php

namespace App\Form;

use App\Entity\Partieinteresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartieInteresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomPI')
            ->add('Poids')
            ->add('Pouvoir')
            ->add('Influence')
            ->add('interet')
            ->add('CategoriesPI')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partieinteresse::class,
        ]);
    }
}
