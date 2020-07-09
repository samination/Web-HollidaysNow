<?php

namespace DaysBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use DaysBundle\Entity\Vols;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Tests\Fragment\Bar;

class HolidaysController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        $pieChart = new PieChart();

        $em= $this->getDoctrine();
        $classes = $em->getRepository(Vols::class)->findAll();
        $totalEtudiant=0;
        foreach($classes as $Vols) {
            $totalEtudiant=$totalEtudiant+$Vols->getPrix();
        }
        $data= array();
        $stat=['classe', 'getPrix'];
        $nb=0;
        array_push($data,$stat);
        foreach($classes as $Vols) {
            $stat=array();
            array_push($stat,$Vols->getVilleDepart(),(($Vols->getPrix()) *100)/$totalEtudiant);
            $nb=($Vols->getPrix() *100)/$totalEtudiant;
            $stat=[$Vols->getVilleDepart(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('pourcentages des pays');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Days\Holidays\index.html.twig', array('piechart' => $pieChart));
    }

}
