<?php

namespace GestionActiviteBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use CMEN\GoogleChartsBundle\GoogleCharts\options\LineChart\LineChartOptions;
use GestionActiviteBundle\Entity\Activite1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Tests\Fragment\Bar;
class statestiqueController extends Controller
{

    /**
     * @Route("/statestique")
     */
    public function indexAction()
    {
        $pieChart = new pieChart();

        $em= $this->getDoctrine();
        $classes = $em->getRepository(Activite1::class)->findAll();
        $totalEtudiant=0;
        foreach($classes as $Activite1) {
            $totalEtudiant=$totalEtudiant+$Activite1->getPrix();
        }
        $data= array();
        $stat=['classe', 'getPrix'];
        $nb=0;
        array_push($data,$stat);
        foreach($classes as $Activite1) {
            $stat=array();
            array_push($stat,$Activite1->getRegion(),(($Activite1->getPrix()) *100)/$totalEtudiant);
            $nb=($Activite1->getPrix() *100)/$totalEtudiant;
            $stat=[$Activite1->getRegion(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('la moyenne des prix des activités dans chaque pays ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@GestionActivite/activites/statestique.html.twig', array('piechart' => $pieChart));
    }
    public function index2Action()
    {
        $lineChart = new lineChart();

        $em= $this->getDoctrine();
        $classes = $em->getRepository(Activite1::class)->findAll();
        $totalEtudiant=0;
        foreach($classes as $Activite1) {
            $totalEtudiant=$totalEtudiant+$Activite1->getPrix();
        }
        $data= array();
        $stat=['classe', 'getPrix'];
        $nb=0;
        array_push($data,$stat);
        foreach($classes as $Activite1) {
            $stat=array();
            array_push($stat,$Activite1->getRegion(),(($Activite1->getPrix()) *100)/$totalEtudiant);
            $nb=($Activite1->getPrix() *100)/$totalEtudiant;
            $stat=[$Activite1->getRegion(),$nb];
            array_push($data,$stat);
        }
        $lineChart->getData()->setArrayToDataTable(
            $data
        );
        $lineChart->getOptions()->setTitle('la moyenne des prix des activités dans chaque pays ');
        $lineChart->getOptions()->setHeight(500);
        $lineChart->getOptions()->setWidth(900);
        $lineChart->getOptions()->getTitleTextStyle()->setBold(true);
        $lineChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $lineChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $lineChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $lineChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@GestionActivite/activites/statestique.html.twig', array('piechart' => $lineChart));
    }
}
