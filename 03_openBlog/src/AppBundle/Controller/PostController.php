<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
        /**
     * @Route("/{slug}", name="post_view")
     */
    public function viewAction(Request $request, $slug)
    {
        echo 'post_view';
    }

    /**
     * @Route("/post/new", name="post_new")
     */
    public function newAction(Request $request)
    {
        echo 'post_new';
    }

    /**
     * @Route("/post/edit/{slug}", name="post_edit")
     */
    public function editAction(Request $request, $slug)
    {
       echo 'post_edit';
    }
}
