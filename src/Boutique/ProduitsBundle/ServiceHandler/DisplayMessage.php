<?php 

namespace Boutique\ProduitsBundle\ServiceHandler;


// exemple de service (ressouces - config - services.yml)
//mettre un arguement si ya des parametre dans la function

class displayMessage {

    public function displayMessage() {
        $message = "fefe";
        return $message;
    }

}