<?php
namespace App\Traits;
use GuzzleHttp\Client;

trait ConsumesExternalServices
{
    public function makeRequest($method, $requestUrl, $queryParams=[], 
                                $formParams =[], $headers = [] , $isJSonRequest = false)
    {
        $client = new Client([
            'base_uri'=>$this->baseUri,
        ]);

        if(method_exists($this,'resolveAuthorization')){
            $this->resolveAuthorization($queryParams,$formParams,$headers);
        }    
        
        $response = $client->request($method,$requestUrl,[
            $isJSonRequest ? 'json':'form_params' => $formParams,
            'headers'=> $headers,
            'query'=> $queryParams

        ]);

        $response = $response->getBody()->getContents();
        if(method_exists($this,'decodeResponse')){
            $response = $this->decodeResponse($response);
        }
       
        return $response;

    }
}