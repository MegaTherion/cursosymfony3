<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormulariosControllerTest extends WebTestCase
{
    public function testMiform()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/miform');
    }

}
