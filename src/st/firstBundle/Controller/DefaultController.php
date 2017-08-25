<?php

namespace st\firstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('stFirstBundle:Default:index.html.twig');
    }
}
