<?php

namespace GEPedag\EntidadesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EstudianteControllerTest extends WebTestCase {

    /** @test */
    public function indexOK() {
        $client = static::createClient();
        $client->enableProfiler(); // !!

        $url = $client->getContainer()->get('router')->generate('ge_estudiante_homepage');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isOk(), 'The index page dont work: ' . $url);
        $this->assertGreaterThan(0, $crawler->filter('.tablas_chulas tr')->count());
        $this->assertGreaterThan(1, $crawler->filter('.tablas_chulas td:contains("Cumanayagua")')->count());

        if (FALSE != ($profiler = $client->getProfile())) {
            
            $cant_queries = count($profiler->getCollector('db')->getQueries());
            $this->assertLessThan(3, $cant_queries, 'La portada requiere ' . $cant_queries . ' consultas a la BD');
            $tlim = 2500;
            $tiempo = floor($profiler->getCollector('time')->getDuration()); // es getDuration() !!
            $this->assertLessThan($tlim, $tiempo, 'La portada se genera en: ' . $tiempo . ' ms Sobrepasa: ' . $tlim);
        }
    }

    /** @test */
    public function completeScenario() {
        // Create a new client to browse the application
        $client = static::createClient();

        $url = $client->getContainer()->get('router')->generate('ge_estudiante_homepage');

        $crawlert = $client->request('GET', $url);
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "No pincho la ruta re-conocidisima: GET " . $url);

        $this->assertEquals(1, $crawlert->filter('a:contains("Registrar Estudiante")')->count(), "No tiene el enlace 'Registrar Estudiante' CON a:contains('Registrar Estudiante')");

        $crawlera = $client->click($crawlert->selectLink('Registrar Estudiante')->link());
        $tkn = $crawlera->filter('input[type="hidden"]')->extract(['value']);
        $token = $tkn[0];
        $now = new \DateTime('today');
        $ahora = $now->format('Y-m-d');
        $ci = '18020531489';
        $values = array(
            'gepedag_estudiantebundle_estudiante[ci]' => $ci,
            'gepedag_estudiantebundle_estudiante[nombres]' => 'Test',
            'gepedag_estudiantebundle_estudiante[primerApellido]' => 'Pozo',
            'gepedag_estudiantebundle_estudiante[segundoApellido]' => 'Kastro',
            'gepedag_estudiantebundle_estudiante[anioEstudio]' => 1,
            'gepedag_estudiantebundle_estudiante[fechaIngrEducSup]' => $ahora,
            'gepedag_estudiantebundle_estudiante[fechaIngrIsp]' => $ahora,
            'gepedag_estudiantebundle_estudiante[fechaIngrEsp]' => $ahora,
            'gepedag_estudiantebundle_estudiante[colorPiel]' => "negro",
            'gepedag_estudiantebundle_estudiante[direccion]' => "calle Blanca",
            'gepedag_estudiantebundle_estudiante[orgPolitica]' => "UJC",
            'gepedag_estudiantebundle_estudiante[sede]' => "Unasede",
            //listas:
            'gepedag_estudiantebundle_estudiante[fuenteIngreso]' => 1,
            'gepedag_estudiantebundle_estudiante[procedenciaMadre]' => 1,
            'gepedag_estudiantebundle_estudiante[municipio]' => 1,
            'gepedag_estudiantebundle_estudiante[provincia]' => 1,
            'gepedag_estudiantebundle_estudiante[procedenciaEscolar]' => 1,
            'gepedag_estudiantebundle_estudiante[claseEstudiante]' => 1,
            'gepedag_estudiantebundle_estudiante[codigoBaja]' => 1,
            'gepedag_estudiantebundle_estudiante[procedenciaPapa]' => 1,
            'gepedag_estudiantebundle_estudiante[tipoPlan]' => 1,
            'gepedag_estudiantebundle_estudiante[especialidad]' => 1,
            'gepedag_estudiantebundle_estudiante[asignatura]' => [1],
            'gepedag_estudiantebundle_estudiante[_token]' => $token
        );
        $form = $crawlera->selectButton('Enviar')->form();
        $a = "";
        try {
            $results = $client->submit($form, $values)->filter('.notification-error')
                    ->each(function($nodo, $i) {
                return $nodo->text();
            });
            foreach ($results as $r)
                $a .= (" " . $r);
        } catch (\Exception $exc) {
            
        }
        $this->assertTrue($client->getResponse()->isRedirection(), "[-] Si esta OK debe redireccionarte! " . $a);

        $crawler = $client->followRedirect();
        // Check data in the show view
        $this->assertEquals(1, $crawler->filter('td:contains("' . $ci . '")')->count(), 'No se encontro el est con ese carne td:contains("' . $ci . '")');
        $this->assertEquals(1, $crawler->filter('td:contains("Test")')->count(), 'No se encontro el est con ese carne td:contains("Test")');

        // Editar est
        $this->assertEquals(1, $crawler->filter('.btn-success')->count(), "No tiene el enlace 'Editar' CON a:contains('.btn-success')");
        $crawler = $client->click($crawler->filter('.btn-success')->link());

        $values['gepedag_estudiantebundle_estudiante[nombres]'] = "NombreCambiado";
        $values['gepedag_estudiantebundle_estudiante[anioEstudio]'] = 3;
        $form = $crawler->selectButton('Enviar')->form($values);

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the elements con los valores "NombreCambiado" y 3 año
        $this->assertGreaterThan(0, $crawler->filter('[value="NombreCambiado"]')->count(), 'ERROR Nombres. No se encontro input con nombre: [value="NombreCambiado"]');
        $this->assertGreaterThan(0, $crawler->filter('[value="3"]')->count(), 'ERROR Año. No se encontro input con año de estudio: [value="3"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Eliminar')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertEquals(0, $crawler->filter('td:contains("' . $ci . '")')->count(), 'Aparecio un est con el carne ya borrado: td:contains("' . $ci . '")');
    }

}
