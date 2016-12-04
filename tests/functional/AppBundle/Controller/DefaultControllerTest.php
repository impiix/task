<?php

namespace Tests\Functional\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCorrectFlow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET',
            '/admin',
            [],
            [],
            ['PHP_AUTH_USER' => 'test', 'PHP_AUTH_PW' => 'test']
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('form[add]')->form();

        $form['form[title]'] = "title";
        $form['form[content]'] = "one two three one two three one two three one two three"
            . "one two three one two three one two three one two three ";

        $crawler = $client->submit($form);

        $this->assertEquals("/list", $client->getResponse()->headers->get('location'));
    }

    public function testContentTooShort()
    {
        $client = static::createClient();

        $crawler = $client->request('GET',
            '/admin',
            [],
            [],
            ['PHP_AUTH_USER' => 'test', 'PHP_AUTH_PW' => 'test']
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('form[add]')->form();

        $form['form[title]'] = "title";
        $form['form[content]'] = "one";

        $crawler = $client->submit($form);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
