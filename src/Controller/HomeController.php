<?php
/**
 * Created by PhpStorm.
 * User: linux
 * Date: 23/01/19
 * Time: 17:53
 */

namespace App\Controller;


use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController{ #con esto puedo usar los servicios del controler como el sistema de renderizado de twig

    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage(){
       return $this->render('/home/home.html.twig');
    }

}