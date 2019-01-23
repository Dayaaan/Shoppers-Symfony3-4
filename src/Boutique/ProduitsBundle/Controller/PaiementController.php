<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;
use Boutique\ProduitsBundle\Form\CommandeType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Paiement controller.
 *
 * @Route("paiement")
 */
class PaiementController extends Controller
{
    /**
     * @Route("/", name="paiement_stripe")
     */
    public function paiementAction(Request $request) {
        $session = $this->get('session');
        if (!$session->get('idCommande')){
            throw new \Exception('Something went wrong!');
            exit;
        } else {
            $idCommande = $session->get('idCommande');
        }
        
        dump($idCommande);

        $order = $this->getDoctrine()->getRepository(Commande::class)->find($idCommande);

        dump($order);


        $form = $this->get('form.factory')
                     ->createNamedBuilder('payment-form')
                     ->add('token', HiddenType::class, [
                            'constraints' => [new NotBlank()],
                     ])
                     ->add('submit', SubmitType::class)
                     ->add('commande', CommandeType::class)
                     ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $this->get('app.client.stripe')->createPremiumCharge($order, $form->get('token')->getData());
                    $redirect = $this->get('session')->get('premium_redirect');
                } catch (\Stripe\Error\Base $e) {
                    $this->addFlash('warning', sprintf('Unable to take payment, %s', $e instanceof \Stripe\Error\Card ? lcfirst($e->getMessage()) : 'please try again.'));
                    $redirect = $this->generateUrl('paiement_stripe');
                } finally {
                    //return $this->redirect($redirect);
                }
            }
        }
        return $this->render('commande/paiement.html.twig', [
        'form' => $form->createView(),
        'stripe_public_key' => $this->getParameter('stripe_public_key'),
        ]);

    }
}
