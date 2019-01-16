<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\Produit;
use Boutique\ProduitsBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;
use Boutique\ProduitsBundle\Entity\ProduitCommande;
use Boutique\ProduitsBundle\Controller\ProduitController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Commande controller.
 *
 * @Route("commande")
 */
class CommandeController extends Controller
{
    /**
     * Lists all commande entities.
     *
     * @Route("/commande", name="commande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('BoutiqueProduitsBundle:Commande')->findAll();

        return $this->render('commande/index.html.twig', array(
            'commandes' => $commandes,
        ));
    }


    /**
     * Creates a new commande entity.
     *
     * @Route("/checkout", name="checkout")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $this->get('session');
       
        $orders = $session->get('orders');

        $subtotal = 0;

        dump($orders);

        for ($i = 0; $i < count($orders); $i++) {
            $subtotal += $orders[$i]['total'];
        }
        dump($subtotal);

        $commande = new Commande();
        
        $form = $this->createForm('Boutique\ProduitsBundle\Form\CommandeType', $commande);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
           
        for ($i = 0; $i < count($orders); $i++) {
            $produit = $em->getRepository(Produit::class)->find($orders[$i]['productDetails']->getId());
            $produitCommande = new ProduitCommande();
            $produitCommande->setQuantity($orders[$i]['quantity']);
            $produitCommande->setPrice($orders[$i]['productDetails']->getPrice());
            $produitCommande->setProduit($produit);
            $produitCommande->setCommande($commande);
            $em->persist($produitCommande);
            dump($produitCommande);
        }
        
            $em->flush();
            $session->clear();

            
            $message = (new \Swift_Message('Votre commande à bien été validé'))
                ->setFrom('dayaaan.vu@gmail.com')
                ->setTo($commande->getEmail())
                ->setBody(
                    $this->renderView(
                        'email/validateorder.html.twig',
                        [
                            'produitCommande' => $produitCommande,
                            'orders' => $orders,
                            'subtotal' =>$subtotal
                        ]
                    ),
                    'text/html'
            );
            $this->get('mailer')->send($message);

            return $this->render('commande/thankyou.html.twig', array('id' => $commande->getId()));
        }

        return $this->render('commande/new.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView(),
            'orders' => $orders,
            'subtotal' => $subtotal
        ));
    }

    /**
     * Finds and displays a commande entity.
     *
     * @Route("/{id}", name="commande_show")
     * @Method("GET")
     */
    public function showAction(Commande $commande)
    {
        $deleteForm = $this->createDeleteForm($commande);

        return $this->render('commande/show.html.twig', array(
            'commande' => $commande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commande entity.
     *
     * @Route("/{id}/edit", name="commande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commande $commande)
    {
        $deleteForm = $this->createDeleteForm($commande);
        $editForm = $this->createForm('Boutique\ProduitsBundle\Form\CommandeType', $commande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_edit', array('id' => $commande->getId()));
        }

        return $this->render('commande/edit.html.twig', array(
            'commande' => $commande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commande entity.
     *
     * @Route("/{id}", name="commande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Commande $commande)
    {
        $form = $this->createDeleteForm($commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commande);
            $em->flush();
        }

        return $this->redirectToRoute('commande_index');
    }

    /**
     * Creates a form to delete a commande entity.
     *
     * @param Commande $commande The commande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commande $commande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commande_delete', array('id' => $commande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
