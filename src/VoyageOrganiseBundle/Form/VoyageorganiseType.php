<?php

namespace VoyageOrganiseBundle\Form;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class VoyageorganiseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixVoyage', IntegerType::class, [
                'attr' => [
                    'min'  => 1,
                    'max'  => 99999999,]])
            ->add('dateDepart',DateType::class,array(
        'widget'=>'single_text',
                'format'        => 'dd.MM.yyyy'
    ))
            ->add('dateRetour',DateType::class,array(
                'widget'=>'single_text',
                'format'        => 'dd.MM.yyyy'
            ))
            ->add('origine', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('paysDestination', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('villeDestination', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('nbPlaces', IntegerType::class, [
                'attr' => [
                    'min'  => 1,
                    'max'  => 9999,]])
            ->add('hotel', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))

            ->add('nomAgence', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('image')
        ->add('save', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VoyageOrganiseBundle\Entity\Voyageorganise'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'voyageorganisebundle_voyageorganise';
    }


}
