<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\ImagePrincipale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imageprincipale controller.
 *
 * @Route("imageprincipale")
 */
class ImagePrincipaleController extends Controller
{
    /**
     * Lists all imagePrincipale entities.
     *
     * @Route("/", name="imageprincipale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imagePrincipales = $em->getRepository('BoutiqueProduitsBundle:ImagePrincipale')->findAll();

        return $this->render('imageprincipale/index.html.twig', array(
            'imagePrincipales' => $imagePrincipales,
        ));
    }

    /**
     * Creates a new imagePrincipale entity.
     *
     * @Route("/new", name="imageprincipale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imagePrincipale = new Imageprincipale();
        $form = $this->createForm('Boutique\ProduitsBundle\Form\ImagePrincipaleType', $imagePrincipale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imagePrincipale);
            $em->flush();

            return $this->redirectToRoute('imageprincipale_show', array('id' => $imagePrincipale->getId()));
        }

        return $this->render('imageprincipale/new.html.twig', array(
            'imagePrincipale' => $imagePrincipale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imagePrincipale entity.
     *
     * @Route("/{id}", name="imageprincipale_show")
     * @Method("GET")
     */
    public function showAction(ImagePrincipale $imagePrincipale)
    {
        $deleteForm = $this->createDeleteForm($imagePrincipale);

        return $this->render('imageprincipale/show.html.twig', array(
            'imagePrincipale' => $imagePrincipale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imagePrincipale entity.
     *
     * @Route("/{id}/edit", name="imageprincipale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImagePrincipale $imagePrincipale)
    {
        $deleteForm = $this->createDeleteForm($imagePrincipale);
        $editForm = $this->createForm('Boutique\ProduitsBundle\Form\ImagePrincipaleType', $imagePrincipale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('imageprincipale_edit', array('id' => $imagePrincipale->getId()));
        }

        return $this->render('imageprincipale/edit.html.twig', array(
            'imagePrincipale' => $imagePrincipale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imagePrincipale entity.
     *
     * @Route("/{id}", name="imageprincipale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImagePrincipale $imagePrincipale)
    {
        $form = $this->createDeleteForm($imagePrincipale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imagePrincipale);
            $em->flush();
        }

        return $this->redirectToRoute('imageprincipale_index');
    }

    /**
     * Creates a form to delete a imagePrincipale entity.
     *
     * @param ImagePrincipale $imagePrincipale The imagePrincipale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImagePrincipale $imagePrincipale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imageprincipale_delete', array('id' => $imagePrincipale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
