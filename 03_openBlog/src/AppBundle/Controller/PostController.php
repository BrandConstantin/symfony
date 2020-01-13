<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/post/list/{page}", name="list")
     */
    public function listAction(Request $request, $page)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        $posts = $postRepository->findAll();
        return new Response('List '.$posts);
    }

    /**
     * @Route("/post/new", name="post_new")
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $post->setTitle('Symfony 3');
        $post->setSlug('symfony-3');
        $post->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Created post id '.$post->getSlug());
    }

    /**
     * @Route("/post/{id}", name="post_view")
     */
    public function viewAction(Request $request, $id)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        $post = $postRepository->find($id);
        return new Response('Post with slug '.$post->getSlug());
    }

    /**
     * @Route("/post/edit/{id}", name="post_edit")
     */
    public function editAction(Request $request, $id)
    {
       $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

       $post = $postRepository->find($id);
       return new Response('Post for edit with slug '.$post->getSlug());
    }

    /**
     * @Route("/post/search/{title}", name="search")
     */
    public function searchAction(Request $request, $title)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts = $postRepository->findAllByTitle($title);
        print_r($posts);
    }
}
