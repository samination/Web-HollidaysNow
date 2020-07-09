<?php

namespace GestionActiviteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionActiviteBundle:Default:index1.html.twig');
    }
}
