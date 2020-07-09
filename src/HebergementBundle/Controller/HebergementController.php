<?php

namespace HebergementBundle\Controller;


use HebergementBundle\Entity\Hebergement;

use HebergementBundle\Form\HebergementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseRedirect  ;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class HebergementController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function AjouterHebergAction(Request $request)
    {






        $hebergement = new hebergement();
        $id = $this->getUser()->getId();
        $form = $this->createFormBuilder($hebergement)




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

            ->add('save', SubmitType::class, array('attr' => array('class' => 'butt')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $hebergement->setIdagence($id);
            /**
             * @var UploadedFile $file
             */
            $file = $hebergement->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $hebergement->setImage($fileName);

            $em = $this->getDoctrine()->getManager();

            $em->persist($hebergement);
            $em->flush();
            $this->get('session')
                ->getFlashBag()
                ->add('info', 'Ajout effectué Avec succes !');}










        return $this->render("@Hebergement/hebergement/ajout.html.twig", array('form' => $form->createView()));

    }

    public function afficherHebergementAction(){
        $hebergement= $this->getDoctrine()->getRepository(Hebergement::class)->findAll();
        return $this->render("@Hebergement/Hebergement/afficheHebergement.html.twig",array('hebergement'=>$hebergement));

    }
    public function afficherHebergementuserAction(){
        $hebergement= $this->getDoctrine()->getRepository(Hebergement::class)->findAll();
        return $this->render("@Hebergement/Hebergement/afficheHebergementuser.html.twig",array('hebergement'=>$hebergement));

    }

    public function supprimerHebergementAction($id){
        $em = $this->getDoctrine()->getManager();
        $hebergement=$em->getRepository("HebergementBundle:Hebergement")->find($id);
        $em->remove($hebergement);
        $em->flush();
        return $this->redirectToRoute('hebergement_affiche');
    }
    public function modifierHebergementAction(Request $request,$id)
    {

        $hebergement= $this->getDoctrine()->getRepository(Hebergement::class)
            ->find($id);
        $form= $this->createForm(HebergementType::class,$hebergement);
        $form->handleRequest($request);
        if ($form->isSubmitted()){

            $em= $this->getDoctrine()->getManager();
            $em->flush();
            $this->get('session')
                ->getFlashBag()
                ->add('info', 'Modification Avec Succes !');
            return $this->redirectToRoute('hebergement_affiche');


        }
        return $this->render("@Hebergement/Hebergement/modifHebergement.html.twig",
            array("form"=>$form->createView()));
    }
}