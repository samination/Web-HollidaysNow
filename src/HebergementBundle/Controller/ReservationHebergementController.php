<?php

namespace HebergementBundle\Controller;

use HebergementBundle\Entity\ReservationHebergement;
use HebergementBundle\Entity\Hebergement;
use HebergementBundle\Form\HebergementType;
use HebergementBundle\Form\ReservationHebergementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseRedirect;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\Session;
use Skies\SkiesQRcodeBundle\Generator\Generator;



class ReservationHebergementController extends Controller
{
/*
/**
* @Route("/{id}")
*
* @ParamConverter("hebergement", class="HebergementBundle:Hebergement")

*
*/
 /*   /**
     * @param Request $request
     * @param Hebergement $hebergement
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function AjouterReservationHebergAction($id, Request $request)
    {
        $reservation = new ReservationHebergement();
        $idu = $this->getUser()->getId();

        $form = $this->createForm('HebergementBundle\Form\ReservationHebergementType', $reservation);
        $form->handleRequest($request);
        $reservation->setIdutilisateur($idu);
        $em=$this->getDoctrine()->getManager();
        $hebergement=$em->getRepository('HebergementBundle:Hebergement')->find($id);


       // $reservation->setIdagence($hebergement->getIdagence());
        if($hebergement->getNombreChambre()< $reservation->getNbrplace()){
            $em = $this->getDoctrine()->getManager();

            $reservation->setIdhebergement($hebergement);


            //  $reservation->setTypechambre('chambresingle');
            $choix = $form->get('typechambre')->getData();



            $this->get('session')
                ->getFlashBag()
                ->add('notice', 'Pas assez de places disponible !');

        }


        if ($form->isSubmitted() && $form->isValid()) {

        if($hebergement->getNombreChambre()>= $reservation->getNbrplace()){
                $em = $this->getDoctrine()->getManager();
                $reservation->setIdhebergement($hebergement);
            $reservation->setIdagence($hebergement->getIdagence());
              //  $reservation->setTypechambre('chambresingle');
                $choix = $form->get('typechambre')->getData();
                if ($choix == 'Chambresingle'){
                $reservation->setPrix($hebergement->getPrixSingle()*$reservation->getNbrplace());}
                elseif ($choix == 'Chambredouble'){
                    $reservation->setPrix($hebergement->getPrixDouble()*$reservation->getNbrplace());}
                $hebergement->setNombreChambre($hebergement->getNombreChambre()-$reservation->getNbrplace());
                $em->persist($reservation);
                $em->flush();
                $this->GenerateQRCODE($reservation);
                $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')->setUsername('arijmediouni@gmail.com')->setPassword('azertyazerty123');

                $mailer = \Swift_Mailer::newInstance($transport);

                $message = \Swift_Message::newInstance('Holidays now ')
                    ->setFrom(array("arijmediouni@gmail.com" => "Holidays now"))
                    ->setTo(array("arij.mediouni@esprit.tn" => "arij.mediouni@esprit.tn"))
                    ->setBody("Here is your QR Code for your reservation!!!", 'text')
                    ->attach(\Swift_Attachment::fromPath('C:\wamp64\www\Holidaysnow01\web\arij.png'));

                $mailer->send($message);
                $em2 = $this->getDoctrine()->getManager();
                $em2->merge($reservation);

                $em2->flush();
                // return $this->redirectToRoute('reservationhebergement_show', array('id' => $reservation->getIdreservationh()));
                //     return $this->redirectToRoute('reservation_show', array('id' => $reservation->getId()));
            $this->get('session')
                ->getFlashBag()
                ->add('info', 'Reservation Effectué!');
            return $this->redirectToRoute('reservhebergement_affiche');
        }



            }

        return $this->render('@Hebergement/hebergement/reservHebergement.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }



    public function affResAction()
    {
        /*$user = $this->getUser() ;
        if (!$user){
            return $this->redirectToRoute('fos_user_security_login') ;
        }
        $user = $this->getUser();*/




        $res= $this->getDoctrine()->getRepository('HebergementBundle:ReservationHebergement')->findAll();
        return $this->render("@Hebergement/hebergement/mesreservations.html.twig",array('reservationhergement'=>$res));
    }
    public function AnnulerResAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $reservation = $em->getRepository('HebergementBundle:ReservationHebergement')->find($id);
        $hebergement = $em->getRepository('HebergementBundle:Hebergement')->find($reservation->getIdhebergement());
        $hebergement->setNombreChambre($hebergement->getNombreChambre()+$reservation->getNbrplace()) ;

        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('reservhebergement_affiche');
    }
    public function GenerateQRCODE(ReservationHebergement $reservation)
    {


        $options = array(
            'code'   => $reservation->__toString(),
            'type'   => 'qrcode',
            'format' => 'png',
            'width'  => 10,
            'height' => 10,
            'color'  => array(127, 127, 127),
        );

        $barcode =
            $this->get('skies_barcode.generator')->generate($options);

        $savePath = 'C:wamp64/www/Holidaysnow01/web/';
        $fileName = 'arij.png';

        file_put_contents($savePath.$fileName, base64_decode($barcode));


    }
}
