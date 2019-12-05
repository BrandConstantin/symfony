<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Curso;

class PruebasController extends Controller
{
    public function indexAction(Request $request, $name, $surname, $page)
    {
        $productos = array(
            array("producto"=>"consola 1", "precio"=>1),
            array("producto"=>"consola 2", "precio"=>2),
            array("producto"=>"consola 3", "precio"=>3),
            array("producto"=>"consola 4", "precio"=>4),
            array("producto"=>"consola 5", "precio"=>5),
            array("producto"=>"consola 6", "precio"=>6),
            array("producto"=>"consola 7", "precio"=>7)
        );

        $frutas = array("manzana" => "golden", "peras" => "conferencias");
        // replace this example code with whatever you need
        return $this->render('AppBundle:Pruebas:index.html.twig', array(
            'texto' => $name." - ".$surname."/".$page,
            "productos" => $productos,
            "frutas" => $frutas
        ));
    }

    public function createAction(){
        //creamos el objeto curso
        $curso = new Curso();
        $curso->setTitulo("Curso de Symfony 3");
        $curso->setDescripcion("Curso básico de Symfony");
        $curso->setPrecio(10);

        //llamamos a entity manager de doctrine
        $em = $this->getDoctrine()->getEntityManager();
        //$em = $this->getDoctrine()->getManager(); //para versiones superiores a 3.0.6
        //persistimos los datos, guarda los datos dentro de doctrine
        $em->persist($curso);
        //vuelva los datos de la url en la BBDD
        $flush = $em->flush();

        if($flush != null){
            echo "El curso no se ha creado bien!";
        }else{
            echo "El curso se ha creado correctamente!";
        }

        die();
    }
}
