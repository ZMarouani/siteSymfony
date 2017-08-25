<?php

namespace st\dataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('stDataBundle:Default:index.html.twig');
    }
}
