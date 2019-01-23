<?php 

namespace Boutique\ProduitsBundle\ServiceHandler;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Error\Base;
use Psr\Log\LoggerInterface;
use Boutique\UserBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Boutique\ProduitsBundle\Entity\Commande;



class StripeClient
{
  private $config;
  private $em;
  private $logger;
  
  public function __construct($secretKey, array $config, EntityManagerInterface $em, LoggerInterface $logger)
  {
    \Stripe\Stripe::setApiKey($secretKey);
    $this->config = $config;
    $this->em = $em;
    $this->logger = $logger;
  }
  public function createPremiumCharge(Commande $commande, $token)
  {
    try {
      $charge = \Stripe\Charge::create([
        'amount' => $commande->getTotalAmount(), //$this->config['decimal'] ? $this->config['premium_amount'] * 100 : $this->config['premium_amount'],
        'currency' => $this->config['currency'],
        'description' => 'Premium blog access',
        'source' => $token,
        'receipt_email' => $commande->getEmail(),
      ]);
    } catch (\Stripe\Error\Base $e) {
      $this->logger->error(sprintf('%s exception encountered when creating a premium payment: "%s"', get_class($e), $e->getMessage()), ['exception' => $e]);
      throw $e;
    }
    $commande->setChargeId($charge->id);
    $commande->setPaiemenStatus(true);
    //$user->setPremium($charge->paid);
    $this->em->flush();
  }
}

