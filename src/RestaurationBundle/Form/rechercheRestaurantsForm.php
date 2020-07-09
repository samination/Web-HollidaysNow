<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 28/11/2018
 * Time: 15:57
 */

namespace RestaurationBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class rechercheRestaurantsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_resto')
            ->add('rechercher', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {

    }
    public function getName()
    {
        return "Restaurations_Bundlerecherche_restaurants_form";
    }


}