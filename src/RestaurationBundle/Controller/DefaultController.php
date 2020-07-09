<?php

namespace RestaurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RestaurationBundle:Default:index.html.twig');
    }
}
