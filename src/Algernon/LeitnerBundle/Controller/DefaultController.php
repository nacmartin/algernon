<?php

namespace Algernon\LeitnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlgernonLeitnerBundle:Default:index.html.twig');
    }
}
