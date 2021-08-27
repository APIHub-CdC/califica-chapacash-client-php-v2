<?php

namespace chapacash\pe\Client;

use \chapacash\pe\Client\Configuration;
use \chapacash\pe\Client\ObjectSerializer;


use Signer\Manager\ApiException;
use Signer\Manager\Interceptor\MiddlewareEvents;
use Signer\Manager\Interceptor\KeyHandler;

class CalificaApiTest extends \PHPUnit_Framework_TestCase
{
    
    
    
    public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        $this->signer = new KeyHandler(null, null, $password);

        $events = new MiddlewareEvents($this->signer);
        $handler = \GuzzleHttp\HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));
        $config = new \chapacash\pe\Client\Configuration();
        $config->setHost('the_url');
        
        $client = new \GuzzleHttp\Client(['handler' => $handler]);
        $this->apiInstance = new \chapacash\pe\Client\Api\CalificaApi($client, $config);
    }
    
    public function testChapacash()
    {
        
        $x_api_key = "your_api_key";
        $username = "your_username";
        $password = "your_password";
        

        $request = new \chapacash\pe\Client\Model\DatosConsulta();

        $request->setNumeroDocumento("XXXXXX");   
        $request->setTipoDocumento(1);
        $request->setPrimNomRazSoc("");
        $request->setSegundoNombre("");
        $request->setApellidoPaterno("");
        $request->setApellidoMaterno("");
        $request->setTipoProducto("EP");
        $request->setIngresoBruto(0);
        $request->setOtrosIngresos(0);
        $request->setImpuestosGastosVariables(0);
        $request->setOtrosDescuentos(0);
        $request->setGastosFijos(0);
        $request->setDeudasVigentes(0);
        $request->setCuota(0.0);
        $request->setPlazo(0);

        try {
          $result = $this->apiInstance->chapacash($x_api_key, $username, $password, $request);
            $this->assertNotNull($result);
          } catch (Exception $e) {
            echo 'Exception when calling CalificaApi->chapacash: ', $e->getMessage(), PHP_EOL;
        }
    }
}
