<?php

namespace DaysBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDepart')->add('dateArrive')->add('villeDepart')
            ->add('type',ChoiceType::class, array(
                'choices'  => array(
                    'aller_Retour' => 'aller_retour',
                    'Aller' =>'aller',
                    'Retour' => 'retour',
                ),
            ))
            ->add('villeArrive')->add('prix')->add('description')->add('nbPlaces');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DaysBundle\Entity\Vols'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'daysbundle_vols';
    }


}
