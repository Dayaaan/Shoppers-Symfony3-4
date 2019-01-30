<?php

namespace Tests\Boutique\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/');
      
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
       // $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
