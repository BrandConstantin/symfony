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
    public function indexActionOld(Request $request)
    {
        /*$em = $this->getDoctrine()->getEntityManager();
        $entry_repo = $em->getRepository("BlogBundle:Entry");
        $entries = $entry_repo->findAll();

        foreach($entries as $entry){
            echo $entry->getTitle()."<br/>";
            echo $entry->getCategory()->getName()."<br/>";
            echo $entry->getUser()->getName()."<br/>";

            $tags = $entry->getEntryTag();
            foreach($tags as $tag){
                echo $tag->getTag()->getName().", ";
            }

            echo "<hr/>";
        }*/
        
        /*$em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $categories = $category_repo->findAll();

        foreach($categories as $category){
            echo $category->getName()."<br/>";

            $entires = $category->getEntries();
            foreach($entires as $entry){
                echo $entry->getTitle().", ";
            }

            echo "<hr/>";
        }*/

        $em = $this->getDoctrine()->getEntityManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        $tags = $tag_repo->findAll();

        foreach($tags as $tag){
            echo $tag->getName()."<br/>";

            $entryTag = $tag->getEntryTag();
            foreach($entryTag as $entry){
                echo $entry->getEntry()->getTitle().", ";
            }

            echo "<hr/>";
        }

        die();
        // replace this example code with whatever you need
        // return $this->render('default/index.html.twig', array(
        //     'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        // ));
    }

    public function indexAction(){
        return $this->render("BlogBundle:Default:index.html.twig");
    }
}
