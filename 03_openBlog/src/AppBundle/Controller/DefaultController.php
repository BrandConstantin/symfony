<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
   /* public function indexAction(Request $request)
    {
        //redirección
    //    $url = $this->generateUrl('category_edit', array('slug' => 'symfony_3'));
    //    return $this->redirect($url);

        //reenvio
        // $response = $this->forward('AppBundle:Category:edit', array(
        //     'slug'=>'symfony object 2'
        // ));
        // return $response;

        //renderizar
        // return $this->render(
        //     'base.html.twig',
        //     array( )
        // );

        //respuesta json
        // $response = new Response(json_encode(array('slug' => 'symfony object 4')));
        // $response->headers->set('Content-Type', 'application/json');
        // return $response;

        //error
        // if(!$product){
            throw $this->createNotFoundException('El producto no existe');
        // }
    }*/

    public function indexAction(Request $request)
    {
        return $this->render(
            'default/index.html.twig',
            array(
                'base_dir' => 'Symfony Cours with openwebinars.net'
            )
        );
    }

    /**
     * @Route("/list/{page}", name="list")
     */
    public function listAction(Request $request, $page)
    {
        echo 'list';
    }
}
