<?php

namespace RestaurationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestaurantsControllerTest extends WebTestCase
{
    public function testAfficher()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/afficher');
    }

    public function testAjouter()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouter');
    }

    public function testSupprimer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimer');
    }

    public function testModifier()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifier');
    }

}
