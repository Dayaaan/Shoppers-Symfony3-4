<?php

namespace Boutique\ContactBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ContactController extends Controller
{
    /**
     * @Route("/", name="contact")
     */
    public function indexAction()
    {
        
        return $this->render('contact/contact.html.twig');
        
    }
    /**
    * @Route("/success", name="contact_success")
    */
    public function sendContactAction(Request $request) {

        if($request->isXmlHttpRequest()) {
            
            $firstname = $request->request->get('firstname');
            $lastname = $request->request->get('lastname');
            $email = $request->request->get('email');
            $subject = $request->request->get('subject');
            $message = $request->request->get('message');

            $message = (new \Swift_Message('Votre message à bien été validé'))
                ->setFrom('dayaaan.vu@gmail.com')
                ->setTo($email)
                ->setBody($firstname . $lastname . $email . $subject . $message);
            $this->get('mailer')->send($message);
            return $this->render('contact/contact_success.html.twig');

        }
    }
}
