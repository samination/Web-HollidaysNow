<?php

namespace VoyageOrganiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ReservervoyageorganiseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('idAgence', HiddenType::class, array('data'=>'idAgence'))
            ->add('nbrplace', IntegerType::class, [
                'attr' => [
                    'min'  => 1,
                    'max'  => 9999999]])
            ->add('prix', HiddenType::class, array('data'=>'prix'))

        ->add('save', SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VoyageOrganiseBundle\Entity\Reservervoyageorganise'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'voyageorganisebundle_reservervoyageorganise';
    }


}
