<?php

namespace TradeBundle\Controller;

use TradeBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Car controller.
 *
 * @Route("/car")
 */
class CarController extends Controller
{
    /**
     * Lists all car entities.
     *
     * @Route("/", name="car_index")
     * @Method("GET")
     */
    public function indexAction()
    {   $total = 0;
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('TradeBundle:Car')->findAll();
        
        foreach ($cars as $car){
          $total =$total + $car->getTotal();
        }
        return $this->render('@Trade/car/index.html.twig', array(
            'cars' => $cars,
            'totales' => $total,
        ));
    }

    /**
     * Creates a new car entity.
     *
     * @Route("/new", name="car_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm('TradeBundle\Form\CarType', $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_show', array('id' => $car->getId()));
        }

        return $this->render('car/new.html.twig', array(
            'car' => $car,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a car entity.
     *
     * @Route("/show/{id}", name="car_show")
     * @Method("GET")
     */
    public function showAction(Car $car)
    {
        $deleteForm = $this->createDeleteForm($car);

        return $this->render('car/show.html.twig', array(
            'car' => $car,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing car entity.
     *
     * @Route("/{id}/edit", name="car_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Car $car)
    {
        $deleteForm = $this->createDeleteForm($car);
        $editForm = $this->createForm('TradeBundle\Form\CarType', $car);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_edit', array('id' => $car->getId()));
        }

        return $this->render('car/edit.html.twig', array(
            'car' => $car,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a car entity.
     *
     * @Route("/delete/{id}", name="car_delete")
     * 
     */
    public function deleteAction($id)
    {  
       $em= $this->getDoctrine()->getManager();
       $repository = $em->getRepository(Car::class);
       $car = $repository->find($id);

       $em->remove($car);
       $em->flush();         

        return $this->redirectToRoute('car_index');
    }

    /**
     * Creates a form to delete a car entity.
     *
     * @param Car $car The car entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('car_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

     /**
     * @Route("/add", name="add_car")
     */
    public function addAction(){
       
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TradeBundle:Car');

        //Datos
        $descripcion = $_POST['description']; 
        $cantidad = $_POST['cant'];
        $precio =  $_POST['price'];
        $imagen = $_POST['image'];
        $stock = $_POST['stock'];
        $total = $cantidad * $precio;
        //Creamos la entidad
        $car = new Car();
        $car->setDescription($descripcion);
        $car->setPrice($precio);
        $car->setCant($cantidad);
        $car->setTotal($total);
        $car->setImage($imagen);
        $car->setStock($stock);
                
        //Persistimos la entidad
      
        $em->persist($car);
        $em->flush();
        return $this->redirectToRoute('car_index');
    }
     /**
     * @Route("/delete_all", name="delete_all")
     */
    public function deleteAll()
    {   $em= $this->getDoctrine()->getManager();
        $resp = $em->createQuery('DELETE FROM TradeBundle:Car')            
                     ->getResult();
        return $this->redirectToRoute('car_index');  

        }

}
