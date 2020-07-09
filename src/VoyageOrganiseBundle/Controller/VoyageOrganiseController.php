<?php

namespace VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use VoyageOrganiseBundle\Entity\Voyageorganise;
use VoyageOrganiseBundle\Form\VoyageorganiseType;
use Symfony\Component\HttpFoundation\ResponseRedirect  ;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use VoyageOrganiseBundle\VoyageOrganiseBundle;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class VoyageOrganiseController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function AjouterVoyageorgAction(Request $request)
    {


        $voyage = new Voyageorganise();
        $id = $this->getUser()->getId();
        $form = $this->createFormBuilder($voyage)



            ->add('prix_voyage', IntegerType::class, [
                'attr' => [
                    'min'  => 1,
                    'max'  => 99999999,]])
            ->add('dateDepart',DateType::class,array(
                'widget'=>'single_text',
                             ))
            ->add('dateRetour',DateType::class,array(
                'widget'=>'single_text'
            ))
            ->add('origine', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('pays_destination', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('ville_destination', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('nb_places', IntegerType::class, [
                'attr' => [
                    'min'  => 1,
                    'max'  => 99999999,]])
            ->add('hotel', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))

            ->add('nom_agence', TextType::class, array(
                'attr' => ['pattern' => '[a-zA-Z]*']))


            ->add('image', FileType::class, array('data_class' => null,'label' => 'insérer une image','attr'=>array('style'=>'color:violet','class'=>'text-muted m-b-15 f-s-12 form-control input-focus')))

            ->add('save', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $voyage->setIdagence($id);
            /**
             * @var UploadedFile $file
             */
            $file = $voyage->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $voyage->setImage($fileName);






            $em = $this->getDoctrine()->getManager();

            $em->persist($voyage);
            $em->flush();
            $this->get('session')
                ->getFlashBag()
                ->add('info', 'Ajout effectué Avec succes !');
            return $this->redirectToRoute('voyageorganise_affiche');}



        return $this->render("@VoyageOrganise/VoyageOrganise/ajoutvoyageorg.html.twig", array('form' => $form->createView()));

    }

    public function afficherVoyageorgAction(){

        $voyage= $this->getDoctrine()->getRepository(Voyageorganise::class)->findAll();
        return $this->render("@VoyageOrganise/VoyageOrganise/afficheVoyageorg.html.twig",array('voyageorganise'=>$voyage));

    }
    public function afficherVoyageorguserAction(){

        $voyage= $this->getDoctrine()->getRepository(Voyageorganise::class)->findAll();
        return $this->render("@VoyageOrganise/VoyageOrganise/afficheVoyageorguser.html.twig",array('voyageorganise'=>$voyage));

    }
    public function supprimerVoyageorgAction($id){
        $em = $this->getDoctrine()->getManager();
        $hebergement=$em->getRepository("VoyageOrganiseBundle:Voyageorganise")->find($id);
        $em->remove($hebergement);
        $em->flush();
        $em->flush();
        $this->get('session')
            ->getFlashBag()
            ->add('info', 'Suppression Effectué !');
        return $this->redirectToRoute('voyageorganise_affiche');
        return $this->redirectToRoute('voyageorganise_affiche');
    }
    public function modifierVoyageorgAction(Request $request,$id)
    {
        $ida= $this->getUser()->getId();
        $voyage= $this->getDoctrine()->getRepository(Voyageorganise::class)
            ->find($id);
        $form= $this->createForm(VoyageorganiseType::class,$voyage);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $voyage->setIdagence($ida);
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            $this->get('session')
                ->getFlashBag()
                ->add('info', 'Modification Effectué !');
            return $this->redirectToRoute('voyageorganise_affiche');
        }
        return $this->render("@VoyageOrganise/VoyageOrganise/modifVoyageorg.html.twig",
            array("form"=>$form->createView()));
    }

    public function RecherchePaysAction(Request $request)
    {

        $voyage = new Voyageorganise();

       /* $form = $this->createFormBuilder($voyage)
         builder ->add('paysDestination', 'entity', array('class' => 'VoyageOrganiseBundle\Voyageorganise',
        'property' => 'paysDestination',
        'multiple' => false,
        'empty_value' => 'erreuuur'));
        //$dest=$request->get('paysDestination');*/

        if ($request->isMethod('POST')) {
            $dest=$request->get('paysDestination');
            $voyage->setPaysDestination($dest);


                $voyage = $this->getDoctrine()->getRepository('VoyageOrganiseBundle:Voyageorganise')
                    ->findByp($dest);


            return $this->render('@VoyageOrganise/VoyageOrganise/afficheVoyageorguser.html.twig', array(
                'voyageorganise' => $voyage,

            ));




        }
        $voyage = $this->getDoctrine()->getRepository('VoyageOrganiseBundle:Voyageorganise')->findBy(array('voyageorganise'=>$_POST['paysDestination']));
        return $this->render('@VoyageOrganise/VoyageOrganise/afficheVoyageorg.html.twig', array(
            'voyageorganise' => $voyage,

        ));

    }
}
