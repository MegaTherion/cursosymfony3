<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Receta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Recetum controller.
 *
 * @Route("receta")
 */
class RecetaController extends Controller
{
    /**
     * Lists all recetum entities.
     *
     * @Route("/", name="receta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recetas = $em->getRepository('AppBundle:Receta')->findAll();

        return $this->render('receta/index.html.twig', array(
            'recetas' => $recetas,
        ));
    }

    /**
     * Creates a new recetum entity.
     *
     * @Route("/new", name="receta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $recetum = new Receta();
        $form = $this->createForm('AppBundle\Form\RecetaType', $recetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $recetum->getBrochure();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('archivos_upload'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $recetum->setBrochure($fileName);

            // ... persist the $product variable or any other work

            $em = $this->getDoctrine()->getManager();
            $em->persist($recetum);
            $em->flush();

            return $this->redirectToRoute('receta_show', array('id' => $recetum->getId()));
        }

        return $this->render('receta/new.html.twig', array(
            'recetum' => $recetum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recetum entity.
     *
     * @Route("/{id}", name="receta_show")
     * @Method("GET")
     */
    public function showAction(Receta $recetum)
    {
        $deleteForm = $this->createDeleteForm($recetum);

        return $this->render('receta/show.html.twig', array(
            'recetum' => $recetum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recetum entity.
     *
     * @Route("/{id}/edit", name="receta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Receta $recetum)
    {
        $deleteForm = $this->createDeleteForm($recetum);
        $editForm = $this->createForm('AppBundle\Form\RecetaType', $recetum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            

            return $this->redirectToRoute('receta_edit', array('id' => $recetum->getId()));
        }

        return $this->render('receta/edit.html.twig', array(
            'recetum' => $recetum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recetum entity.
     *
     * @Route("/{id}", name="receta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Receta $recetum)
    {
        $form = $this->createDeleteForm($recetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recetum);
            $em->flush();
        }

        return $this->redirectToRoute('receta_index');
    }

    /**
     * Creates a form to delete a recetum entity.
     *
     * @param Receta $recetum The recetum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Receta $recetum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('receta_delete', array('id' => $recetum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
