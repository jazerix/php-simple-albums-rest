<?php

include_once "Response.php";

class Server
{

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['albums']))
            $_SESSION['albums'] = [];
        if (!isset($_SESSION['album_id']))
            $_SESSION['album_id'] = 1;

        header("Content-Type: application/json");
    }

    public function response(): Response
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            return $this->handleGet();
        else
            return $this->handlePost();
    }

    public function handleGet(): Response
    {
        if (empty($_GET['id']))
            return new Response(200, $_SESSION['albums']);

        $found = array_filter($_SESSION['albums'], fn($album) => $album['id'] == $_GET['id']);
        if (count($found) == 0)
            return new Response(404, [
                'status' => 'error',
                'message' => 'Could not find the album'
            ]);

        return new Response(200, array_values($found)[0]);
    }

    public function handlePost(): Response
    {
        if (empty($_POST['name'])) {
            return new Response(400, [
                'status' => 'error',
                'message' => 'Missing form parameter "name"',
            ]);
        }

        $_SESSION['albums'][] = [
            'id' => $_SESSION['album_id'],
            'name' => $_POST['name']
        ];

        $_SESSION['album_id']++;

        return new Response(200, [
            'status' => 'success',
            'message' => 'The album was saved.'
        ]);
    }
}
