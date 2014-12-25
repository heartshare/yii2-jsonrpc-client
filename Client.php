<?php
namespace avbondarev\jsonRpcClient;

/**
 * @author sergey.yusupov, alex.sharov, alex.bondarev
 */
/**
 * Class Client
 * @package avbondarev\jsonRpcClient
 */
class Client
{
    use traits\Client;

    /**
     * Url of service
     * @var null
     */
    protected $url;
    /**
     * Default header options for context
     * @var array
     */
    protected $contextHeaders = ["Content-Type: application/json"];

    /**
     * @param null $url
     * @param array $contextHeaders
     */
    public function __construct($url = null,$contextHeaders = [])
    {
        $this->url = $url;
        $this->contextHeaders = array_merge($this->contextHeaders,$contextHeaders);
    }

    /**
     * @param $name
     * @param $arguments
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        return $this->callServer($name, $arguments, $this->url,$this->contextHeaders);
    }
}
