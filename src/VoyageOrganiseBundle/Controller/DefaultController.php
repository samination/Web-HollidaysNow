<?php

namespace VoyageOrganiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VoyageOrganiseBundle:Default:index.html.twig');
    }
}
