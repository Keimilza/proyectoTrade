<?php

namespace TradeBundle\Controller;

use TradeBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TradeBundle\Form\UsuarioType;
use TradeBundle\Form\LoginType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 *
 * @Route("/")
 */
class UsuarioController extends Controller
{

    /**
     * Lists all usuario entities.
     *
     * @Route("/", methods={"GET"}, name="usuario_index")
     * 
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository(Usuario::class)->findAll();

        return $this->render('@Trade/Usuario/index.html.twig', array(
            'usuarios' => $usuarios,
        ));
    }

    /**
     * @Route("/show/{id}", name="usuario_show", methods={"GET"})
     * 
     */
    public function showAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Usuario::class);
        $usuario = $repository->find($id);
        return $this->render('@Trade/Usuario/show.html.twig',['usuario' => $usuario]);
           
    }

    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction(Request $request,UserPasswordEncoderInterface $encode)
    {
         // 1) build the form
         $usuario = new Usuario();
         $form = $this->createForm(UsuarioType::class, $usuario);
 
         // 2) handle the submit (will only happen on POST)
         $form->handleRequest($request);
         
         if ($form->isSubmitted() && $form->isValid()) {
 
             // 3) Encode the password (you could also do this via Doctrine listener)
             $password = $encode->encodePassword($usuario, $usuario->getPlainPassword());
             $usuario->setPassword($password);
 
             // 4) save the User!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($usuario);
             $entityManager->flush();
 
             // ... do any other work - like sending them an email, etc
             // maybe set a "flash" success message for the user
 
             return $this->redirectToRoute('usuario_index');
         }
 
         return $this->render('@Trade/Usuario/registro.html.twig', [
                 'form' => $form->createView(),
                 'user' => $usuario,                 
                 ]);
     }
    
    /**
     * @Route("/login", methods={"GET", "POST"}, name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
      
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginType::class,['_username'=>$lastUsername]);

        return $this->render('@Trade/Usuario/login.html.twig', [
            'form'  => $form->createView(),
            'error' => $error
        ]);
    }

    /**
    * @Route("/logout", name="logout")
    */
    public function logoutAction(Request $request)
    {
        // UNREACHABLE CODE
    }
}
