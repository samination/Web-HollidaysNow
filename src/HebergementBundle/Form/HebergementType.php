<?php

namespace HebergementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HebergementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('nomagence', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('typeHebergement', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('nomHebergement', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))

            ->add('nombreEtoile',RangeType::class, array(
                'attr' => array(
                    'min' => 1,
                    'max' => 5

                )
            ))
            ->add('adresseHebergement' )
            ->add('nombreChambre', IntegerType::class, [
                'attr' => [
                    'min'  => 0,
                    'max'  => 9999,]])

            ->add('prixSingle', IntegerType::class, [
                'attr' => [
                    'min'  => 1,
                    'max'  => 99999999,]])

            ->add('prixDouble', IntegerType::class, [
                'attr' => [
                    'min'  => 1,
                    'max'  => 99999999,]])
            ->add('tauxDemi', IntegerType::class, [
                'attr' => [
                    'min'  => 0,
                    'max'  => 100,]])

            ->add('tauxComplet', IntegerType::class, [
                'attr' => [
                    'min'  => 0,
                    'max'  => 100,]])
            ->add('tel',TextType::class, array(
                'attr' => ['pattern' => '^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$']))
            ->add('description' )

            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet','class'=>'text-muted m-b-15 f-s-12 form-control input-focus')) )

            ->add('save', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HebergementBundle\Entity\Hebergement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hebergementbundle_hebergement';
    }


}
