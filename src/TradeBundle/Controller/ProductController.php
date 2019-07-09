<?php

namespace TradeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/product")
     */
    public function indexAction()
    {
        return $this->render('@Trade/Product/index.html.twig', array(
            // ...
        ));
    }

}
