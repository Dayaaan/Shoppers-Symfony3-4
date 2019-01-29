<?php

namespace Boutique\ProduitsBundle\EventListener;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class RedirectionSubscriber implements EventSubscriberInterface
{
    private $router;
    private $routeCollection;
    private $supported_languages;
    private $locale;

    public function __construct(RouterInterface $router, array $supported_languages, $locale) {
        $this->router = $router;
        $this->supported_languages = $supported_languages;
        //récupère toutes les routes
        $this->routeCollection = $router->getRouteCollection();
        $this->locale = $locale;
    }
    public function checkLanguage($language) {
        return in_array($language, $this->supported_languages); // true or false
    }


    public function onKernelRequest(GetResponseEvent $event) {
        // pour connaitre son type dump($event) 
        //dump($event->getRequest());
        // step 1 : recuperer le locale
        //dump($event->getRequest()->getLocale()); //fr
        //dump($this->routeCollection);
        $request = $event->getRequest();
        $actualPath = $request->getPathInfo();
        $routeParams = $request->attributes->get('_locale');
        $languageLocale = substr($request->getPreferredLanguage(),0,2);
        dump("language locale : " . $languageLocale);
        dump("routeparams: ".$routeParams);
        if($this->checkLanguage($routeParams) == false) {
            $routeMatch = false;
            foreach($this->routeCollection as $route) {
                if ( "/{_locale}" . $actualPath == $route->getPath() ) {
                    $routeMatch = true;
                    break;                   
                }
            } 
            if ($routeMatch) {
            
                if ($this->checkLanguage($languageLocale) == false || $this->checkLanguage($languageLocale) == "" || ($actualPath == "/" && $this->checkLanguage($languageLocale) == false)) {
                    $languageLocale = $this->locale;
                }
                $event->setResponse(new RedirectResponse("/" . $languageLocale . $actualPath));       
            }       
        }
        
    }
    
    /**
    * Returns an array of event names this subscriber wants to listen to.
    *
    * The array keys are event names and the value can be:
    *
    *  * The method name to call (priority defaults to 0)
    *  * An array composed of the method name to call and the priority
    *  * An array of arrays composed of the method names to call and respective
    *    priorities, or 0 if unset
    *
    * For instance:
    *
    *  * array('eventName' => 'methodName')
    *  * array('eventName' => array('methodName', $priority))
    *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
    *
    * @return array The event names to listen to
    */

    public static function getSubscribedEvents()
    {
        return array(
            'kernel.request' => array(array('onKernelRequest', 17))
        );
        
    }
    
}