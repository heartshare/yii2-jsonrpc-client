JsonRpc Client for Yii2

##Usage Client

~~~php
//Create client with URL and header options using in context
$client = new \avbondarev\JsonRpcClient\Client('http://url/of/webservice',["Authorization: Basic ########","Content-Encoding: ...."]);

$response = $client->someMethod($arg1, $arg2);
~~~

