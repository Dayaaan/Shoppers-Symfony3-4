<?php

namespace Boutique\ProduitsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
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
       
        $orders = $session->get('orders');
        dump($orders);

        $totalSession = $session->get('totalsession');
        dump($totalSession);



        $form = $this->get('form.factory')
                    ->createNamedBuilder('payment-form')
                    ->add('token', HiddenType::class, [
                        'constraints' => [new NotBlank()],
                    ])
                    ->add('submit', SubmitType::class)
                    ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $this->get('app.client.stripe')->createPremiumCharge($this->getCommande(), $form->get('token')->getData());
                    $redirect = $this->get('session')->get('premium_redirect');
                } catch (\Stripe\Error\Base $e) {
                    $this->addFlash('warning', sprintf('Unable to take payment, %s', $e instanceof \Stripe\Error\Card ? lcfirst($e->getMessage()) : 'please try again.'));
                    $redirect = $this->generateUrl('premium_payment');
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
