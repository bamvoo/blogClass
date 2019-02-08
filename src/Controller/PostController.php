<?php

namespace App\Controller;

use App\Form\PostType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;

class PostController extends AbstractController
{
    /**
     * @Route("/post/new", name="new_post")
     */
    public function newPost(Request $request)
    {
        //creamos objeto para obligar a dar uso
        $post = new Post();
        //el titulo
        $post->setTitle('Título de post original');
        //creamos formulario con tipo de post y el post que acabamos de crear
        $form = $this->createForm(PostType::class, $post);


        //handle the request
        //el reqwuest se pasa como parametro arriba
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //data capture
            $post=$form->getData();

            //flush to DB (KungFu Panda reference)

        }

        //es el que hace que se renderice
        return $this->render('post/post.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
