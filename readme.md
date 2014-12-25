JsonRpc Client for Yii2


##Usage Server

1) Install with Composer

~~~php
"require": {
    "avbondarev/yii2-jsonrpc-client": "*",
},

php composer.phar update
~~~


##Usage Client

~~~php
//Create client with URL and header options using in context
$client = new \avbondarev\JsonRpcClient\Client('http://url/of/webservice',["Authorization: Basic ########","Content-Encoding: ...."]);

$response = $client->someMethod($arg1, $arg2);
~~~

