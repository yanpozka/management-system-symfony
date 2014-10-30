<?php

namespace GEPedag\EntidadesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/usuario/');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), 
                "Unexpected HTTP status code for GET /usuario/");
        $crawler = $client->click($crawler->selectLink('Crear nuevo Usuario')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Crear')->form(array(
            'gepedag_entidadesbundle_user[username]' => 'UsuarioPrueba',
            'gepedag_entidadesbundle_user[password]' => '123',
            'gepedag_entidadesbundle_user[status]'   => 0
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("UsuarioPrueba")')->count(), 
                'No se encontro el elemento td:contains("UsuarioPrueba")');

        // Editar
        // Aqui selecciona el primer link "Editar" por eso si hay otro user lo borra y edita
        $crawler = $client->click($crawler->selectLink('Editar')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'gepedag_entidadesbundle_user[username]' => 'UsuarioFoo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="UsuarioFoo"]')->count(),
                'Missing element [value="UsuarioFoo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/UsuarioFoo/', $client->getResponse()->getContent());
    }
}
