<?php

namespace RestaurationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationsControllerTest extends WebTestCase
{
    public function testAfficherreservation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/afficherReservation');
    }

    public function testAjouterreservation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterReservation');
    }

    public function testSupprimerreservation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimerReservation');
    }

}
