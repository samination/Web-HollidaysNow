<?php

namespace RestaurationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use RestaurationBundle\Entity\Restaurants;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RestaurationBundle\Form\rechercheRestaurantsForm;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;

class RestaurantsController extends Controller
{
    public function afficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $restaurant=$em->getRepository("RestaurationBundle:Restaurants")->findAll();
        if($this->isGranted("ROLE_AGENT")){
             $restaurant=$em->getRepository("RestaurationBundle:Restaurants")->findBy(array(
             	"Id_agence"=>$this->getUser()->getId()
             ));
        }
        return $this->render('@Restauration/Restaurants/afficher.html.twig', array("restaurants"=>$restaurant));

    }
    public function afficherAdminAction()
    {
        $em=$this->getDoctrine()->getManager();
        $restaurant=$em->getRepository("RestaurationBundle:Restaurants")->findAll();
        return $this->render('@Restauration/Restaurants/afficherAdmin.html.twig', array("restaurants"=>$restaurant));

    }



    public function ajouterAction(Request $request)
    {
        $restaurant=new Restaurants();
        if($request->isMethod('POST')){

            $restaurant->setNomResto($request->get('NomResto'));
            $restaurant->setAdresseResto($request->get('AdresseResto'));
            $restaurant->setSpecialiteResto($request->get('SpecialiteResto'));
            $restaurant->setTypeResto($request->get('TypeResto'));
            $restaurant->setNbPlacesTotResto($request->get('NbPlacesTotResto'));
            $restaurant->setIdAgence($this->getUser()->getId());
            $em=$this->getDoctrine()->getManager();
            $em->persist($restaurant);
            $em->flush();
            $ab=$restaurant->getIdAgence(); //ici changer par user id mté3 fosuser    $this->getUser()->getId()
            $em=$this->getDoctrine()->getManager();
            $restaurants=$em->getRepository("RestaurationBundle:Restaurants")->findBy(['Id_agence'=>$ab]);



           /* $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject('islam.xls');

            $phpExcelObject->getProperties()->setCreator("liuggio")
                ->setLastModifiedBy("Giulio De Donato")
                ->setTitle("Office 2005 XLSX Test Document")
                ->setSubject("Office 2005 XLSX Test Document")
                ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
                ->setKeywords("office 2005 openxml php")
                ->setCategory("Test result file");
           // $phpExcelObject->setActiveSheetIndex(0)
             //  ;
            $phpExcelObject->setActiveSheetIndex(0)
                ->getColumnDimension('A')
                ->setWidth(30);
            $phpExcelObject->setActiveSheetIndex(0)
                ->getColumnDimension('B')
                ->setWidth(30);
            $phpExcelObject->setActiveSheetIndex(0)
                ->getColumnDimension('C')
                ->setWidth(25);
            $phpExcelObject->setActiveSheetIndex(0)
                ->getColumnDimension('D')
                ->setWidth(30);
            $phpExcelObject->setActiveSheetIndex(0)
                ->getColumnDimension('E')
                ->setWidth(20);
            $row=2;
              foreach ($restaurants as $item)
              {
                  $phpExcelObject->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'Nom du Restaurant')
                      ->setCellValue('B1', 'Adresse ')
                      ->setCellValue('C1', 'Specialite')
                      ->setCellValue('D1', 'Type du Restaurant')
                      ->setCellValue('E1', 'Nombre de Places')
                      ->setCellValue('A'.$row, $item->getNomResto())
                      ->setCellValue('B'.$row, $item->getAdresseResto())
                      ->setCellValue('C'.$row, $item->getSpecialiteResto())
                      ->setCellValue('D'.$row, $item->getTypeResto())
                      ->setCellValue('E'.$row, $item->getNbPlacesTotResto());

                  $row ++;
              }

            $phpExcelObject->getActiveSheet()->setTitle('Simple');
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $phpExcelObject->setActiveSheetIndex(0);

            // create the writer
            $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
            // create the response
            $response = $this->get('phpexcel')->createStreamedResponse($writer);
            // adding headers
            $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                'stream-file.xls'
            );
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Pragma', 'public');
            $response->headers->set('Cache-Control', 'maxage=1');
            $response->headers->set('Content-Disposition', $dispositionHeader);*/

            return $this->redirectToRoute('afficher');

        }

        return $this->render('@Restauration/Restaurants/ajouter.html.twig', array());
    }

    public function supprimerAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $restaurant=$em->getRepository("RestaurationBundle:Restaurants")->find($id);
        $em->remove($restaurant);
        $em->flush();
        if($this->isGranted("ROLE_ADMIN")){
	        return $this->redirectToRoute('afficher_admin');
        }else{
	        return $this->redirectToRoute('afficher');
        }
    }

    public function modifierAction(Request $request, $id)
    {

        //first step:
        //get the modele with $id with manager permission
        $em=$this->getDoctrine()->getManager();
        $restaurant= $em->getRepository(Restaurants::class)->find($id);
        //third step:
        // check is the from is sent
        if ($request->isMethod('POST')) {
            //update our object given the sent data in the request
            $restaurant->setNomResto($request->get('NomResto'));
            $restaurant->setAdresseResto($request->get('AdresseResto'));
            $restaurant->setSpecialiteResto($request->get('SpecialiteResto'));
            $restaurant->setTypeResto($request->get('TypeResto'));
            $restaurant->setNbPlacesTotResto($request->get('NbPlacesTotResto'));
            $restaurant->setIdAgence($request->get('IdAgence'));
            //fresh the data base
            $em->flush();
            //Rederiger vers read
            return $this->redirectToRoute('afficher');
        }
        //second step:
        // send the view to the user
        return $this->render('@Restauration/Restaurants/modifier.html.twig', array(
            'restaurants' =>$restaurant));
        }



        //Recherche d'un restaurant par nom
        public function rechercherAction(Request $request)
        {
            $restaurant=new Restaurants();
            $em=$this->getDoctrine()->getManager();
            $Form=$this->createForm(rechercheRestaurantsForm::class,$restaurant);
            $Form->handleRequest($request);
            if($Form->isValid())
            {
                $restaurant=$em->getRepository(Restaurants::class)->findBy(array('nomResto'=>$restaurant->getNomResto()));
            }
            else
                {
                    $restaurant=$em->getRepository(Restaurants::class)->findAll();
                }
            return $this->render("@Restauration/Restaurants/recherche.html.twig",array('Form'=>$Form->createView(),'restaurants'=>$restaurant));
        }


    public function chercherAction(Request $request)
    {

    	$em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('RestaurationBundle:Restaurants')->findAll();
//findBy(array('user' =>$this->getUser()
        $all = $em->getRepository('RestaurationBundle:Restaurants')->findAll();
	//    $response = $this->renderView('@Restauration/Restaurants/recherche.html.twig',array('restaurants'=>$all));

        if( $request->get('text')!=null){

	            $text =$request->get('text');
	            $annonce =$em->getRepository('RestaurationBundle:Restaurants')->rechercheTypet($text);
                $response = $this->renderView('@Restauration/Restaurants/recherche.html.twig',array('restaurants'=>$annonce));
                return  new Response($response) ;

        }else{
	        $response = $this->renderView('@Restauration/Restaurants/recherche.html.twig',array('restaurants'=>$all));
	        return  new Response($response) ;        }


    }
/*
    //----------------------------------------------------------
//---------------------------Excel--------------------------
//----------------------------------------------------------

    public function ExcelExportAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $query=$em->getRepository('RestaurationBundle:Restaurants')
            ->createQueryBuilder('u')
            ->select('u.nom_, u.adresse_resto, u.nb_places_tot_resto, u.specialite_resto')
            ->getQuery();

        $result=$query->getResult();

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()
            ->setCreator("xxx")
            ->setLastModifiedBy("xxxx")
            ->setTitle("Excel Example")
            ->setSubject("Example")
            ->setDescription("Example List");

        $phpExcelObject->setActiveSheetIndex(0);
        /*$phpExcelObject->getActiveSheet()->setTile('Export Example');

        $phpExcelObject->setACtiveSheetIndex(0)
            ->setCellValue('B2','id_resto')
            ->setCellValue('C2','nb_places_tot_resto')
            ->setCellValue('D2','nom_resto')
            ->setCellValue('E2','adresse_resto');


        $phpExcelObject->setActiveSheetIndex(0)
            ->getColumnDimension('B')
            ->setWidth(30);
        $phpExcelObject->setActiveSheetIndex(0)
            ->getColumnDimension('C')
            ->setWidth(25);
        $phpExcelObject->setActiveSheetIndex(0)
            ->getColumnDimension('D')
            ->setWidth(15);
        $phpExcelObject->setActiveSheetIndex(0)
            ->getColumnDimension('E')
            ->setWidth(20);

        $row=3;
        foreach ($result as $item)
        {
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('B'.$row, $item['nom_resto'])
                ->setCellValue('C'.$row, $item['adresse_resto'])
                ->setCellValue('D'.$row, $item['type_resto'])
                ->setCellValue('E'.$row, $item['specialite_resto']);
            $row ++;
        }

        $writer = $this->get('phpexcel')->createWriter($phpObject, 'Excel5');

        $response = $this->get('phpexcel')->createStreamedREsponse($writer);

        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'userList.xls'
        );

        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-control','maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        $writer->save('/path/to/save/islam.xls');
        return $response;

    }

    */




}