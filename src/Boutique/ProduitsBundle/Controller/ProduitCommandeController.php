<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\ProduitCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Produitcommande controller.
 *
 * @Route("produitcommande")
 */
class ProduitCommandeController extends Controller
{
    /**
     * Lists all produitCommande entities.
     *
     * @Route("/", name="produitcommande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produitCommandes = $em->getRepository('BoutiqueProduitsBundle:ProduitCommande')->findAll();

        return $this->render('produitcommande/index.html.twig', array(
            'produitCommandes' => $produitCommandes,
        ));
    }

    /**
     * Creates a new produitCommande entity.
     *
     * @Route("/new", name="produitcommande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produitCommande = new Produitcommande();
        $form = $this->createForm('Boutique\ProduitsBundle\Form\ProduitCommandeType', $produitCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produitCommande);
            $em->flush();

            return $this->redirectToRoute('produitcommande_show', array('id' => $produitCommande->getId()));
        }

        return $this->render('produitcommande/new.html.twig', array(
            'produitCommande' => $produitCommande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produitCommande entity.
     *
     * @Route("/{id}", name="produitcommande_show")
     * @Method("GET")
     */
    public function showAction(ProduitCommande $produitCommande)
    {
        $deleteForm = $this->createDeleteForm($produitCommande);

        return $this->render('produitcommande/show.html.twig', array(
            'produitCommande' => $produitCommande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produitCommande entity.
     *
     * @Route("/{id}/edit", name="produitcommande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProduitCommande $produitCommande)
    {
        $deleteForm = $this->createDeleteForm($produitCommande);
        $editForm = $this->createForm('Boutique\ProduitsBundle\Form\ProduitCommandeType', $produitCommande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produitcommande_edit', array('id' => $produitCommande->getId()));
        }

        return $this->render('produitcommande/edit.html.twig', array(
            'produitCommande' => $produitCommande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produitCommande entity.
     *
     * @Route("/{id}", name="produitcommande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProduitCommande $produitCommande)
    {
        $form = $this->createDeleteForm($produitCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produitCommande);
            $em->flush();
        }

        return $this->redirectToRoute('produitcommande_index');
    }

    /**
     * Creates a form to delete a produitCommande entity.
     *
     * @param ProduitCommande $produitCommande The produitCommande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProduitCommande $produitCommande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produitcommande_delete', array('id' => $produitCommande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    
}
