<?php

include_once "Server.php";

$myServer = new Server();
$server = new Swoole\HTTP\Server("0.0.0.0", 8000);
$server->on("start", function (Swoole\Http\Server $server) {
    echo "Swoole http server is started at http://0.0.0.0:8000\n";
});

$server->on("request", function (Swoole\Http\Request $request, Swoole\Http\Response $response) use (&$myServer) {
    $myResponse = $myServer->response($request);
    $response->header("Content-Type", "application/json");
    $response->header("Access-Control-Allow-Origin",  "*");
    $response->end($myResponse);
});

$server->start();