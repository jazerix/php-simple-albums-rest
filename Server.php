<?php

include_once "Response.php";

class Server
{
    private array $albums = [];
    private int $albumId = 1;

    public function __construct()
    {
        header("Content-Type: application/json");
    }

    public function response(Swoole\Http\Request $request): Response
    {
        if (strtolower($request->getMethod()) == 'get')
            return $this->handleGet($request);
        else
            return $this->handlePost($request);
    }

    public function handleGet(Swoole\Http\Request $request): Response
    {
        if (empty($request->get['id']))
            return new Response(200, $this->albums);

        $found = array_filter($this->albums, fn($album) => $album['id'] == $request->get['id']);
        if (count($found) == 0)
            return new Response(404, [
                'status' => 'error',
                'message' => 'Could not find the album'
            ]);

        return new Response(200, array_values($found)[0]);
    }

    public function handlePost(Swoole\Http\Request $request): Response
    {
        if (empty($request->post['name'])) {
            return new Response(400, [
                'status' => 'error',
                'message' => 'Missing form parameter "name"',
            ]);
        }

        $this->albums[] = [
            'id' => $this->albumId,
            'name' => $request->post['name']
        ];

        $this->albumId++;

        return new Response(200, [
            'status' => 'success',
            'message' => 'The album was saved.'
        ]);
    }
}
