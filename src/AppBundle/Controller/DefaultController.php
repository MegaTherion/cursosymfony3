<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Receta;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/crearreceta", name="crear_receta")
     */
    public function crearrecetaAction()
    {
        $receta = new Receta();
        $receta->setNombre("Pollo con champignon");
        $receta->setDificultad("Dificil");
        $receta->setDescripcion("Un buen arroz con pollo");
        $receta->setVisto(0);

        $em = $this->getDoctrine()->getManager();
        $em->persist($receta);
        $em->flush();

        return new Response("entidad guardada");
    }

    /**
     * @Route("/listarecetas", name="listarecetas")
     * @Template()
     */
    public function listarecetasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $recetas = $em->getRepository('AppBundle:Receta')->findAll();
        return array('recetas'=>$recetas);
    }

    /**
     * @Route("/listarecetasdificiles", name="listarecetasdificiles")
     * @Template("AppBundle:Default:listarecetas.html.twig")
     */
    public function listarecetasdificilesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $recetas = $em->getRepository('AppBundle:Receta')->findBy(array('dificultad'=>'Dificil'));
        return array('recetas'=>$recetas);   
    }

    /**
     * @Route("/mostraruna", name="mostraruna")
     * @Template()
     */
    public function mostrarunaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $receta = $em->getRepository('AppBundle:Receta')->findOneBy(array('dificultad' => 'Facil'));
        //$receta->setDificultad('Dificil');

        return array('receta'=>$receta);
    }

}
