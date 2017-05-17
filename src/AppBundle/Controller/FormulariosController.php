<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Autor;
use AppBundle\Form\AutorType;

class FormulariosController extends Controller
{
    /**
     * @Route("/miform")
     * @Template()
     */
    public function miformAction(Request $request)
    {
    	$form = $this->createFormBuilder()
    					->add('nombre', TextType::class, array(
    						'label'=>"Nombre",
    						'attr'=>array(
    							'placeholder'=>'Ingresa aqui tu nombre'
    							)))
    					->add('edad', IntegerType::class, array(
    						'required'=>false,
    						))
    					->add('enviar', SubmitType::class)
    					->getForm();
    	$form->handleRequest($request);



        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/formautor", name="form_autor")
     * @Template()
     */
    public function formautorAction(Request $request)
    {
    	$autor = new Autor();
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);
        if ($form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	$em->persist($autor);
        	$em->flush();
        	return new Response("Gracias");
        }
        return array(
        	'form' => $form->createView()
        	);
    }

    

}
