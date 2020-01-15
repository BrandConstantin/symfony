<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PostController extends Controller
{
    /**
     * @Route("/post/list/", name="list")
     */
    public function listAction(Request $request)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        $posts = $postRepository->findAll();
        return new Response('List ');
    }

    /**
     * @Route("/post/new/", name="post_new")
     */
    public function newAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post, array(
            // 'action' => $this->generateUrl('post_new'),
            // 'method' => 'GET'
        ));

        $form->handleRequest($request);

        $formData = $form->getData();  //para trabajar de forma separada del propio formulario con estos datos
        $date = $form['dueDate']->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirect($this->generateUrl('list'));
        }

        return $this->render('post/new.html.twig', array(
            'form' => $form->createView(),
        ));

        $validator = $this->get('validator');
        $errors = $validator->validate($post, null, array('edit'));

        if(count($errors) > 0){
            $errorsString = (string) $errors;
            return new Response($errorsString);
        }

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
