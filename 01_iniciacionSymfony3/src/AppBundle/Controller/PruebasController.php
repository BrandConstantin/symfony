<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Curso;
use AppBundle\Form\CursoType;
use Symfony\Component\Validator\Constraints as Assert;

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
        $curso->setTitulo('Curso de Symfony 3');
        $curso->setDescripcion('Curso básico de Symfony');
        $curso->setPrecio(10);

        //llamamos a entity manager de doctrine
        //$em = $this->getDoctrine()->getEntityManager();
        $em = $this->getDoctrine()->getManager(); //para versiones superiores a 3.0.6
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

    public function readAction(){
        //sacamos entity manager
        $em = $this->getDoctrine()->getManager();
        //sacamos todos los cursos
        $cursos_repository = $em->getRepository("AppBundle:Curso");
        $cursos = $cursos_repository->findAll();

        foreach($cursos as $curso){
            echo $curso->getTitulo()."<hr/>";
            echo $curso->getDescripcion()."<hr/>";
            echo $curso->getPrecio()."<hr/>";
        }

        die();
    }

    public function updateAction($id, $titulo, $descripcion, $precio) {
        //llamamos al entity manager
        $em = $this->getDoctrine()->getManager();
        //sacamos los cursos
        $cursos_repo = $em->getRepository("AppBundle:Curso");

        //buscar un registro por id
        $curso = $cursos_repo->find($id);
        $curso->setTitulo($titulo);
        $curso->setDescripcion($descripcion);
        $curso->setPrecio($precio);
        var_dump($curso);
        //persistimos los datos
        $em->persist($curso);
        //volcamos los datos en la bd
        $flush = $em->flush();

        if ($flush != null) {
            echo "El curso no se ha actualizado bien";
        } else {
            echo "Curso actualizado correctamente";
        }

        die();
    }

    public function deleteAction($id) {
        //llamamos al entity manager
        $em = $this->getDoctrine()->getEntityManager();
        //sacamos los cursos
        $cursos_repo = $em->getRepository("AppBundle:Curso");
        //buscar un registro por id
        $curso = $cursos_repo->find($id);
        $em->remove($curso);
        //volcamos los datos en la bd
        $flush = $em->flush();

        if ($flush != null) {
            echo "El curso no se ha borrado bien";
        } else {
            echo "Curso borrado correctamente";
        }

        die();
    }

    public function nativeSqlAction() {
        //llamamos al entity manager
        $em = $this->getDoctrine()->getEntityManager();
        //conexión a la bd
        $db = $em->getConnection();

        $query = "SELECT * FROM cursos";
        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);

        $cursos = $stmt->fetchAll();

        //mostrar los cursos
        foreach ($cursos as $curso) {
            echo $curso["titulo"] . "<br/><hr/>";
        }
        die();
    }

    public function dqlAction() {
        //llamamos al entity manager
        $em = $this->getDoctrine()->getEntityManager();

        $query = $em->createQuery(""
                        . "SELECT c FROM AppBundle:Curso c "
                        . "WHERE c.precio > :precio "
                        . "")->setParameter("precio", "12");

        $cursos = $query->getResult();

        //mostrar los cursos
        foreach ($cursos as $curso) {
            echo $curso->getTitulo() . "<br/><hr/>";
        }
        die();
    }

    public function queryBuilderAction() {
        //llamamos al entity manager
        $em = $this->getDoctrine()->getEntityManager();
        //sacamos los cursos
        $cursos_repo = $em->getRepository("AppBundle:Curso");

        $query = $cursos_repo->createQueryBuilder("c")
                ->where("c.precio > :precio")
//                ->orderBy("precio asc")
                ->setParameter("precio", "12")
                ->getQuery();
        $cursos = $query->getResult();

        //mostrar los cursos
        foreach ($cursos as $curso) {
            echo $curso->getTitulo() . "<br/>";
            echo $curso->getDescripcion() . "<br/>";
            echo $curso->getPrecio() . "<br/><hr/>";
        }

        die();
    }

	public function formAction(Request $request){
		$curso = new Curso();
		$form = $this->createForm(CursoType::class,$curso);
		
		$form->handleRequest($request);
		
		if($form->isValid()){
			$status = "Formulario válido";
			$data = array(
				"titulo" => $form->get("titulo")->getData(),
				"descripcion" => $form->get("descripcion")->getData(),
				"precio" => $form->get("precio")->getData()
			);
		}else{
			$status = null;
			$data = null;
		}
		
		return $this->render('AppBundle:Pruebas:form.html.twig', array(
            'form' => $form->createView(),
			'status' => $status,
			'data' => $data
        ));
	}

    public function validarEmailAction($email){
		$emailConstraint = new Assert\Email();
		$emailConstraint->message = "Pasame un buen correo";
		
		$error= $this->get("validator")->validate(
				$email,
				$emailConstraint
				);
		if(count($error)==0){
			echo "<h1>Correo valido!!</h1>";
		}else{
			echo $error[0]->getMessage();
		}
		die();
	}
}
