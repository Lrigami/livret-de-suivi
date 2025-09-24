<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPageAccessibleWhenNotAuthenticated()
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        $this->assertSelectorTextContains('h1', 'Please sign in');
    }

    public function testLoginWithValidCredentials()
    {
        $client = static::createClient();
        // chemin de la page login
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();

        $csrfToken = $crawler->filter('input[name="_csrf_token"]')->attr('value');

        $client->request('POST', '/login', [
            '_username' => 'admin@admin.fr',
            '_password' => 'password',
            '_csrf_token' => $csrfToken,
        ]);

        $client->followRedirect();
        // route où on est redirigé
        $this->assertRouteSame('app_home');
    }

    public function testLoginWithInvalidCredentials()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form([
            '_username' => 'testuser',
            '_password' => 'wrongpassword'
        ]);
        $client->submit($form);

        $this->assertResponseStatusCodeSame(302);
        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }
}
