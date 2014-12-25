<?
namespace avbondarev\jsonRpcClient;

/**
 * @author sergey.yusupov, alex.sharov, alex.bondarev
 */
class Client
{
    use traits\Client;

    protected $url;
    protected $contextHeaders = ["Content-Type: application/json"];

    public function __construct($url = null,$contextHeaders = [])
    {
        $this->url = $url;
        $this->contextHeaders = array_merge($this->contextHeaders,$contextHeaders);
    }

    public function __call($name, $arguments)
    {
        return $this->callServer($name, $arguments, $this->url,$this->contextHeaders);
    }
}
