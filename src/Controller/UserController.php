<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/register",name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        //creamos usuario
        $user = new User();
        //ponemos rol, puede tener más de uno
        $user->setRoles(['ROLE_USER']);
        //para ponerlo en activo
        $user->setIsActive(true);
        //creamos formulario que hay que renderizar
        $form = $this->createForm(UserType::class,$user);

        //para manejar el formulario
                        //sin esto no podria guardar el objeto en la BBDD
        $form->handleRequest($request);
        $error=$form->getErrors();
        //si el formulario se ha enciado y es válido
        if($form->isSubmitted() && $form->isValid()){
            //encriptamos el plainPassword
            $password=$passwordEncoder->encodePassword($user,$user->getPlainPassword());
            $user->setPassword($password);
            //para el handle-manejo de las entidades
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            //el flash puede ser un mensaje de error, succes....
            $this->addFlash(
                'success', 'User created'
            );
            //ahora retornamos el control a otra parte de la app
            return $this->redirectToRoute('app_homepage');
        }
        //render del formulario
        return $this->render('user/regform.html.twig',[
            'error'=>$error,
            'form'=>$form->createView()
        ]);
    }
    //app_login lo hemos puesto en el firewall
    /**
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @Route("/login",name="app_login")
     */
    public function login(Request $request, AuthenticationUtils $authUtils){
        //guardadmos el ultimo error de autentificacion
        $error=$authUtils->getLastAuthenticationError();
        //apellido final
        $lastUsername=$authUtils->getLastUsername();
        return $this->render('user/login.html.twig',[
           'error'=>$error,
            'last_username'=>$lastUsername
        ]);
    }
    /**
     * @Route("/logout",name="app_logout")
     */
    public function logout(){
        $this->redirectToRoute("/");
    }
}
