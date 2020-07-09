<?php

namespace HebergementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationHebergementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


           ->add('idagence', HiddenType::class, array('data'=>'idagence'))
            ->add('nbrplace')
            //->add('prix', HiddenType::class, array('data'=>'prix'))

            ->add('typechambre',ChoiceType::class,array('multiple'=>false,
                'label'=>'typechambre',
                'expanded'=>true,'choices'  => array(
                    'Chambresingle' => 'Chambresingle',
                    'Chambredouble' => 'Chambredouble')))
            ->add('save', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HebergementBundle\Entity\ReservationHebergement'

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hebergementbundle_reservationhebergement';
    }


}
