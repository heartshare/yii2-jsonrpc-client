<?php
namespace avbondarev\jsonRpcClient\traits;

use avbondarev\jsonRpcClient\Exception;

/**
 * Class Client
 * @package avbondarev\jsonRpcClient\traits
 */
trait Client
{
    /**
     * Call server url with params and headers
     * @param $method
     * @param $params
     * @param $url
     * @param $contextHeaders
     * @throws Exception
     */
    public function callServer($method, $params, $url, $contextHeaders)
    {
        $id = $this->newId();
        $request = [
            'jsonrpc' => '2.0',
            'method' => $method,
            'params' => $params,
            'id' => $id
        ];

        $ctx = $this->getHttpStreamContext($request,$contextHeaders);
        $jsonResponse = file_get_contents($url, false, $ctx);

        if ($jsonResponse === '') {
            throw new Exception('fopen failed', Exception::INTERNAL_ERROR);
        }

        $response = json_decode($jsonResponse);

        if ($response === null) {
            throw new Exception('JSON cannot be decoded', Exception::INTERNAL_ERROR);
        }

        if ($response->id != $id) {
            throw new Exception('Mismatched JSON-RPC IDs', Exception::INTERNAL_ERROR);
        }

        if (property_exists($response, 'error')) {
            throw new Exception($response->error->message, $response->error->code);
        } else if (property_exists($response, 'result')) {
            return $response->result;
        } else {
            throw new Exception('Invalid JSON-RPC response', Exception::INTERNAL_ERROR);
        }
    }

    /**
     * Create context for request
     * @param $request
     * @param $contextHeaders
     * @return resource
     */
    public function getHttpStreamContext($request,$contextHeaders)
    {
        $jsonRequest = json_encode($request);

        $ctx = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' =>  $contextHeaders,
                'content' => $jsonRequest
            ]
        ]);

        return $ctx;
    }

    /**
     * Generate unique id for request
     * @return string
     */
    public function newId()
    {
        return md5(microtime());
    }

}
