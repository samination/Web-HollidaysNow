<?php

namespace RestaurationBundle\Form;
//namespace RestaurationBundle\Controller;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbPlacesTotResto')->add('nomResto')->add('adresseResto')->add('typeResto')->add('specialiteResto')->add('Id_agence');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RestaurationBundle\Entity\Restaurants'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'restaurationbundle_restaurants';
    }


}
