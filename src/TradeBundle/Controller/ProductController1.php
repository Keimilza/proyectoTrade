<?php

namespace TradeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use TradeBundle\Entity\Product;

/**
 * @Route("/producto")
*/
class ProductController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
         return $this->render('@Trade/Product/nuevo-prod.html.twig');
    }

     /**
     * @Route("/add", name="add_prod")
     */
    public function addAction(){
       
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TradeBundle:Product');

        //Datos
        $descripcion = $_POST['description']; 
        $codigo = $_POST['code'];
        $cantidad = $_POST['load'];
        $precio =  $_POST['price'];
        $imagen = $_POST['image'];
        //Creamos la entidad
        $prod = new Product();
        $prod->setDescription($descripcion);
        $prod->setCode($codigo);
        $prod->setLoad($cantidad);
        $prod->setCreateAt(new \DateTime('now'));
                
        //Persistimos la entidad
      
        $em->persist($prod);
        $em->flush();
        return $this->redirect('/trade/product/getAll');
    }


    /**
     * @Route("/getAll")
     */
    public function getAllAction(){
        
        //Recuperar el Manager
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TradeBundle:Product');
        $prods = $repository->findAll();
               
        return $this->render('@Trade/Product/listProduct.html.twig',['prods'=>$prods]);
    }

    /**
     * @Route("/updateProduct/{id}")
     */
    public function updateProduct($id)
    {
        $em= $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Product::class);
        $prod = $repository->find($id);
       
        if (!$prod){
            return new Response("No existe el Producto");
        }
        return $this->render('@Trade/Product/editar-prod.html.twig',['prod'=>$prod]);
    }

    /**
     * @Route("/editarProduct")
     */
    public function editarProduct()
    {
        $em= $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Product::class);
        
        $id = $_POST['id']; 
        $descripcion = $_POST['description']; 
        $codigo = $_POST['code'];
        $cantidad = $_POST['load'];
        $precio =  $_POST['price'];
        $imagen = $_POST['image'];

        $prod = $repository->find($id);
       //Creamos la entidad
        $prod = new Product();
        $prod->setDescription($descripcion);
        $prod->setCode($codigo);
        $prod->setLoad($cantidad);
        $prod->setPrice($precio);
        $prod->setLoad($imagen);
        $prod->setUpdateAt(new \DateTime('now'));

        $em->persist($prod); 
        $em->flush(); 
        return $this->redirect('/trade/product/getAll');
    }

    /**
     * @Route("/deleteProduct/{id}")
     */
    public function deleteProduct($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TradeBundle:Product');
        $prod = $repository->find($id);
         if (!$prod){
             return new Response("No existe el Producto");
         }
         $em->remove($prod);
         $em->flush();
       
        return $this->redirect('/trade/getAll');

    }
}
