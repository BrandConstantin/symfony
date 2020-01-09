<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/list/{page}", name="list")
     */
    public function listAction(Request $request, $page)
    {
        echo 'list';
    }

    /**
     * @Route("/category/{page}", name="category")
     */
    public function categoryAction(Request $request, $page)
    {
        echo 'category';
    }

    /**
     * @Route("/{slug}", name="post_view")
     */
    public function postViewAction(Request $request, $slug)
    {
        echo 'post_view';
    }

    /**
     * @Route("/post/new", name="post_new")
     */
    public function postNewAction(Request $request)
    {
        echo 'post_new';
    }

    /**
     * @Route("/post/edit/{slug}", name="post_edit")
     */
    public function postEditAction(Request $request, $slug)
    {
       echo 'post_edit';
    }
}
