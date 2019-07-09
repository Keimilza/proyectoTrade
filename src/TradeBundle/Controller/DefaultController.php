<?php

namespace TradeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('@Trade/Default/index.html.twig');
    }

    
    
}